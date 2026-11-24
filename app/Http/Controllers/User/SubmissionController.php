<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\MissionParticipant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Throwable;

class SubmissionController
{
    public function index(Request $request)
    {
        $filters = [
            'all' => 'Semua', 'in_progress' => 'Berlangsung',
            'pending_review' => 'Menunggu', 'rejected' => 'Perbaikan', 'completed' => 'Selesai',
        ];
        $request->validate(['status' => ['sometimes', Rule::in(array_keys($filters))]]);
        $selected = $request->query('status', 'all');
        $base = $request->user()->participations();
        $counts = (clone $base)->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $counts->put('all', $counts->sum());
        $participants = $base->with(['mission', 'latestSubmission' => fn ($query) => $query->withCount('photos')])
            ->when($selected !== 'all', fn ($query) => $query->where('status', $selected))
            ->latest('joined_at')->orderByDesc('id')->get();
        return view('user.my-missions.index', compact('filters', 'selected', 'counts', 'participants'));
    }

    public function show(Request $request, MissionParticipant $participant)
    {
        abort_unless($participant->user_id === $request->user()->id, 403);
        $participant->load(['mission', 'submissions' => fn ($q) => $q->latest('attempt_number')->with('photos')]);
        return view('user.submissions.show', compact('participant'));
    }

    public function store(StoreSubmissionRequest $request, MissionParticipant $participant)
    {
        $draft = $request->routeIs('user.evidence.draft');
        $newPaths = [];
        $obsolete = [];
        try {
            DB::transaction(function () use ($request, $participant, $draft, &$newPaths, &$obsolete) {
                $owner = User::lockForUpdate()->findOrFail($participant->user_id);
                abort_unless($owner->is_active && $owner->id === $request->user()->id, 403);
                $participant = MissionParticipant::lockForUpdate()->findOrFail($participant->id);
                if (!in_array($participant->status, ['in_progress', 'rejected'], true)) {
                    throw ValidationException::withMessages(['photos' => 'Misi ini sudah dikirim atau selesai.']);
                }

                $photos = $participant->draft_photos ?? [];
                if ($request->hasFile('photos')) {
                    $photos = [];
                    foreach ($request->file('photos') as $file) {
                        $mime = $file->getMimeType();
                        $base64 = base64_encode(file_get_contents($file->getRealPath()));
                        $dataUri = 'data:' . $mime . ';base64,' . $base64;
                        $photos[] = [
                            'path' => $dataUri,
                            'name' => mb_substr($file->getClientOriginalName(), 0, 180)
                        ];
                    }
                }

                if ($draft) {
                    $participant->draft_description = $request->validated('description');
                    $participant->draft_photos = $photos;
                } else {
                    if (!$photos) {
                        throw ValidationException::withMessages(['photos' => 'Tambahkan minimal satu foto kegiatan.']);
                    }
                    $submission = $participant->submissions()->create([
                        'attempt_number' => $participant->submissions()->max('attempt_number') + 1,
                        'description' => $request->validated('description'),
                        'submitted_at' => now(), 'status' => 'pending',
                    ]);
                    foreach ($photos as $photo) {
                        $submission->photos()->create(['file_path' => $photo['path']]);
                    }
                    $participant->status = 'pending_review';
                    $participant->draft_photos = null;
                    $participant->draft_description = null;
                }
                $participant->save();
            });
        } catch (Throwable $error) {
            throw $error;
        }
        if ($draft) {
            return to_route('user.my-missions')->with('notice', 'Draf bukti berhasil disimpan.');
        }
        return to_route('user.my-missions')->with('notice', 'Bukti berhasil dikirim dan menunggu verifikasi.')->with('evidence_sent', true);
    }
}
