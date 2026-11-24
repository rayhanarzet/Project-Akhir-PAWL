<?php

namespace App\Http\Controllers;

use App\Models\SubmissionPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController
{
    public function show(Request $request, SubmissionPhoto $photo)
    {
        $user = $request->user();
        abort_unless($user->role === 'admin' || $photo->submission->participant->user_id === $user->id, 403);

        // Jika foto disimpan sebagai Data URI Base64
        if (str_starts_with($photo->file_path, 'data:image/')) {
            [$meta, $data] = explode(',', $photo->file_path, 2);
            preg_match('/data:(image\/[^;]+);base64/', $meta, $matches);
            $mime = $matches[1] ?? 'image/jpeg';
            $binary = base64_decode($data);

            return response($binary, 200, [
                'Content-Type' => $mime,
                'Cache-Control' => 'private, max-age=86400',
                'X-Content-Type-Options' => 'nosniff',
            ]);
        }

        // Fallback jika masih berupa path file lokal
        return Storage::disk('local')->response($photo->file_path, null, [
            'Cache-Control' => 'private, no-store',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
