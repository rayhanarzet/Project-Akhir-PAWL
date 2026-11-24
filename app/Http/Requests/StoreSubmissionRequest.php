<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->id === $this->route('participant')->user_id;
    }

    public function rules(): array
    {
        $draft = $this->routeIs('user.evidence.draft');
        return [
            'description' => [$draft ? 'nullable' : 'required', 'string', 'max:3000'],
            'photos' => ['sometimes', 'array', 'min:1', 'max:3'],
            'photos.*' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'ownership' => $draft ? ['nullable', 'boolean'] : ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'ownership.accepted' => 'Konfirmasikan bahwa foto ini milikmu sebelum mengirim.',
            'description.required' => 'Ceritakan kegiatanmu sebelum mengirim bukti.',
            'photos.max' => 'Pilih paling banyak tiga foto.',
            'photos.*.mimes' => 'Gunakan foto JPG atau PNG.',
            'photos.*.max' => 'Ukuran maksimal setiap foto adalah 5 MB.',
        ];
    }
}
