@extends('layouts.app')
@section('title', 'Profil saya')
@section('content')

@php
    $initials = collect(preg_split('/\s+/u', trim(auth()->user()->name), -1, PREG_SPLIT_NO_EMPTY))
        ->take(2)->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');
@endphp

<x-back-button :fallback="route('user.dashboard')" label="Kembali ke Dashboard" />

<header class="mb-8 anim-fade-up">
    <h1 class="text-heading text-ink">Pengaturan Profil</h1>
    <p class="text-body text-muted mt-1">Kelola informasi akun dan data diri kamu di Plogee.</p>
</header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
    <!-- User Info Summary Card -->
    <section class="bg-white border border-line rounded-container p-6 shadow-[0_6px_0_rgba(38,62,48,0.05)] flex flex-col items-center text-center gap-4 anim-scale">
        <div class="w-20 h-20 rounded-full bg-soft text-forest font-bold text-2xl flex items-center justify-center ring-4 ring-forest/10 shadow-inner">
            {{ $initials }}
        </div>
        <div>
            <h2 class="text-section text-ink font-bold">{{ auth()->user()->name }}</h2>
            <p class="text-body text-muted mt-0.5">{{ auth()->user()->email }}</p>
        </div>

        <div class="w-full pt-4 border-t border-line/60 flex items-center justify-around text-center">
            @php
                $memberLevel = \App\Services\GamificationService::level(auth()->user()->total_xp);
            @endphp
            <div>
                <span class="text-caption text-muted uppercase font-semibold block">Level</span>
                <strong class="text-label text-forest font-bold block mt-0.5">Lv. {{ $memberLevel }}</strong>
            </div>
            <div class="h-8 w-px bg-line"></div>
            <div>
                <span class="text-caption text-muted uppercase font-semibold block">Total XP</span>
                <strong class="text-label text-forest font-bold block mt-0.5">{{ number_format(auth()->user()->total_xp, 0, ',', '.') }} XP</strong>
            </div>
            <div class="h-8 w-px bg-line"></div>
            <div>
                <span class="text-caption text-muted uppercase font-semibold block">Status</span>
                <strong class="text-label text-[#92DEB4] font-bold block mt-0.5">Aktif</strong>
            </div>
        </div>
    </section>

    <!-- Profile Edit Form -->
    <section class="lg:col-span-2 bg-white border border-line rounded-container p-6 lg:p-8 shadow-[0_6px_0_rgba(38,62,48,0.05)] anim-fade-up delay-1">
        <h2 class="text-section text-ink mb-6">Informasi Akun</h2>

        <form class="flex flex-col gap-5" method="POST" action="{{ route('user.profile.update') }}">
            @csrf
            @method('PUT')

            <x-field name="name"
                     label="Nama lengkap"
                     :value="auth()->user()->name"
                     maxlength="80"
                     required
                     hint="Nama yang akan ditampilkan di leaderboard dan dashboard." />

            <x-field name="email"
                     type="email"
                     label="Alamat email"
                     :value="auth()->user()->email"
                     required
                     hint="Email digunakan untuk masuk ke akun kamu." />

            <div class="pt-4 flex items-center justify-between border-t border-line/60">
                <span class="text-caption text-muted">Perubahan data akan langsung disimpan.</span>
                <x-action>Simpan Perubahan</x-action>
            </div>
        </form>
    </section>
</div>

@endsection
