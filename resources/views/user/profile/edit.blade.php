@extends('layouts.app')
@section('title', 'Profil saya')
@section('content')

<div class="max-w-xl anim-scale">
    <div class="mb-6 anim-fade-up">
        <h1 class="text-heading text-ink">Profil saya</h1>
        <p class="text-body text-muted mt-1">Perbarui informasi nama dan alamat email akunmu.</p>
    </div>

    <form class="bg-white border border-line rounded-container p-8 shadow-[0_6px_0_rgba(38,62,48,0.05)] flex flex-col gap-6"
          method="POST"
          action="{{ route('user.profile.update') }}">
        @csrf
        @method('PUT')

        {{-- Nama lengkap --}}
        <div class="flex flex-col gap-1.5 anim-fade-up delay-1">
            <label class="text-label text-ink" for="name">Nama lengkap</label>
            <input id="name" name="name" type="text" required maxlength="80"
                   value="{{ old('name', auth()->user()->name) }}"
                   class="w-full bg-ivory border border-line text-ink rounded-btn px-4 py-2.5 text-body
                          focus:outline-none focus:ring-2 focus:ring-forest transition-all">
            @error('name')
                <span class="text-caption text-[#903E35]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="flex flex-col gap-1.5 anim-fade-up delay-2">
            <label class="text-label text-ink" for="email">Email</label>
            <input id="email" name="email" type="email" required
                   value="{{ old('email', auth()->user()->email) }}"
                   class="w-full bg-ivory border border-line text-ink rounded-btn px-4 py-2.5 text-body
                          focus:outline-none focus:ring-2 focus:ring-forest transition-all">
            @error('email')
                <span class="text-caption text-[#903E35]">{{ $message }}</span>
            @enderror
        </div>

        {{-- Action button --}}
        <div class="pt-2 border-t border-line/60 flex items-center justify-between anim-fade-up delay-3">
            <x-action>Simpan profil</x-action>
            <a href="{{ route('home') }}" class="text-label text-muted hover:text-ink transition-colors">
                Kembali ke dashboard
            </a>
        </div>
    </form>
</div>
@endsection
