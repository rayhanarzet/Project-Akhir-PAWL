@extends('layouts.app')
@section('title', 'Aksi lingkungan di kampus')
@section('content')

<!-- Background Glow Ambience Dekoratif -->
<div class="relative overflow-hidden">
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-lime/25 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute top-1/2 -right-32 w-[32rem] h-[32rem] bg-soft rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- Hero Card Utama (Kontras & Berkelas) -->
    <section class="bg-gradient-to-br from-white via-soft/40 to-soft/80 border border-line rounded-container overflow-visible grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 lg:p-14 shadow-[0_12px_32px_rgba(24,63,50,0.06)] relative group">
        <!-- Floating Subtle Pattern Accent -->
        <div class="absolute inset-0 bg-eco-pattern opacity-40 pointer-events-none"></div>

        <!-- Kolom Kiri: Headline & Value Proposition -->
        <div class="lg:col-span-7 flex flex-col gap-6 relative z-10">
            <!-- Chip Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-forest text-lime text-caption font-semibold w-fit shadow-sm">
                <span class="w-2 h-2 rounded-full bg-lime animate-ping"></span>
                <span>Gerakan Mahasiswa Peduli Lingkungan</span>
            </div>

            <!-- Big Impact Title -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-ink tracking-tight leading-[1.1]">
                Mulai dari satu <span class="text-forest underline decoration-lime decoration-4 underline-offset-8">aksi kecil</span> untuk bumi.
            </h1>

            <p class="text-body sm:text-base text-muted max-w-xl leading-relaxed">
                Pilih misi ramah lingkungan di kampus, rekam jejak aksimu dengan foto bukti, kumpulkan XP, dan raih badge apresiasi bersama mahasiswa lainnya.
            </p>

            <!-- CTA Action Buttons -->
            <div class="flex flex-wrap items-center gap-4 pt-2">
                @if(auth()->check())
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center justify-center gap-2.5 min-h-[48px] px-8 rounded-btn bg-forest text-white text-label font-bold shadow-[0_6px_0_rgba(24,63,50,0.25)] hover:bg-forest-hover hover:scale-[1.02] active:translate-y-1 active:shadow-none transition-all">
                        <span>Buka Dashboard Saya</span>
                        <span class="text-lime text-lg transition-transform group-hover:translate-x-1">→</span>
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center justify-center gap-2.5 min-h-[48px] px-8 rounded-btn bg-forest text-white text-label font-bold shadow-[0_6px_0_rgba(24,63,50,0.25)] hover:bg-forest-hover hover:scale-[1.02] active:translate-y-1 active:shadow-none transition-all">
                        <span>Mulai Misi Pertamaku</span>
                        <span class="text-lime text-lg">→</span>
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center min-h-[48px] px-6 rounded-btn bg-white border border-line text-forest text-label font-semibold hover:bg-soft hover:border-forest/40 transition-all shadow-sm">
                        Masuk ke Akun
                    </a>
                @endif
            </div>

            <!-- Mini Trust Stats -->
            <div class="pt-4 border-t border-line/60 flex items-center gap-6 sm:gap-10 text-caption font-semibold text-muted">
                <div class="flex items-center gap-2">
                    <span class="text-forest text-base font-extrabold">18+</span>
                    <span>Misi Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-forest text-base font-extrabold">5</span>
                    <span>Tingkatan Level</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-forest text-base font-extrabold">100%</span>
                    <span>Aksi Nyata Kampus</span>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Interactive Visual Showcase -->
        <div class="lg:col-span-5 relative flex items-center justify-center">
            <!-- Decorative Back Glow -->
            <div class="absolute inset-4 bg-gradient-to-tr from-lime/40 to-forest/20 rounded-container blur-xl -z-10 group-hover:blur-2xl transition-all"></div>

            <!-- Main Visual Container -->
            <div class="w-full max-w-sm rounded-container overflow-hidden border-2 border-white bg-white shadow-[0_16px_36px_rgba(24,63,50,0.12)] relative transition-transform duration-500 hover:scale-[1.03]">
                <img class="w-full h-72 object-cover" src="{{ asset('images/komunitas.png') }}" alt="Ilustrasi mahasiswa peduli lingkungan">
                <div class="p-4 bg-white/90 backdrop-blur border-t border-line flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-full bg-soft text-forest flex items-center justify-center font-bold text-xs">🌱</span>
                        <div>
                            <span class="text-label text-ink font-bold block leading-tight">Eco Beginner</span>
                            <span class="text-caption text-muted block">Misi awal ramah lingkungan</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-lime text-forest text-caption font-extrabold">Tersedia</span>
                </div>
            </div>

            <!-- Floating Motion Badge 1: Top Right (+50 XP) -->
            <div class="absolute -top-3 -right-2 sm:-right-4 bg-white/95 backdrop-blur border border-line rounded-2xl px-4 py-2.5 shadow-lg flex items-center gap-2.5 animate-float z-20">
                <span class="w-7 h-7 rounded-xl bg-forest text-lime flex items-center justify-center text-xs font-black">XP</span>
                <div>
                    <span class="text-label font-black text-forest block leading-none">+50 XP</span>
                    <span class="text-[10px] text-muted block mt-0.5">Bring Your Tumbler</span>
                </div>
            </div>

            <!-- Floating Motion Badge 2: Mid-Left Illustration Area (First Step) -->
            <div class="absolute bottom-24 -left-3 sm:-left-6 bg-white/95 backdrop-blur border border-line rounded-2xl px-4 py-2.5 shadow-lg flex items-center gap-2.5 animate-float-delayed z-20">
                <span class="text-2xl" aria-hidden="true">🌿</span>
                <div>
                    <span class="text-label font-bold text-ink block leading-none">First Step</span>
                    <span class="text-[10px] text-[#92DEB4] font-semibold block mt-0.5 bg-black/80 px-2 py-0.5 rounded-full w-fit">Badge Terbuka</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Langkah Sederhana (Dengan Motion Hover yang Halus) -->
    <section class="mt-14">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-caption font-bold text-forest uppercase tracking-widest bg-soft px-3.5 py-1 rounded-full border border-line">Cara Kerja</span>
            <h2 class="text-3xl font-extrabold text-ink mt-3 tracking-tight">Tiga langkah mudah membuat dampak</h2>
            <p class="text-body text-muted mt-2">Semua tercatat transparan, mulai dari aksi harian hingga reward pencapaian.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 01 -->
            <article class="bg-white border border-line rounded-container p-8 shadow-[0_6px_0_rgba(38,62,48,0.05)] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_16px_30px_rgba(24,63,50,0.10)] hover:border-forest group">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-4xl font-black text-line group-hover:text-forest transition-colors">01</span>
                    <div class="w-12 h-12 rounded-2xl bg-soft text-forest flex items-center justify-center text-xl group-hover:bg-forest group-hover:text-lime transition-all">
                        <i class="glyph flag" aria-hidden="true"></i>
                    </div>
                </div>
                <h3 class="text-section text-ink font-bold mb-2 group-hover:text-forest transition-colors">Pilih Misi</h3>
                <p class="text-body text-muted leading-relaxed">
                    Mulai dari level Eco Beginner. Bawa tumbler sendiri, pilah sampah di kamar kost, atau bawa tas belanja tanpa plastik.
                </p>
            </article>

            <!-- Card 02 -->
            <article class="bg-white border border-line rounded-container p-8 shadow-[0_6px_0_rgba(38,62,48,0.05)] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_16px_30px_rgba(24,63,50,0.10)] hover:border-forest group">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-4xl font-black text-line group-hover:text-forest transition-colors">02</span>
                    <div class="w-12 h-12 rounded-2xl bg-soft text-forest flex items-center justify-center text-xl group-hover:bg-forest group-hover:text-lime transition-all">
                        <i class="glyph upload" aria-hidden="true"></i>
                    </div>
                </div>
                <h3 class="text-section text-ink font-bold mb-2 group-hover:text-forest transition-colors">Kirim Bukti</h3>
                <p class="text-body text-muted leading-relaxed">
                    Unggah 1–3 foto dokumentasi kegiatanmu beserta cerita singkat. Kamu juga bisa menyimpan draf sebelum dikirimkan.
                </p>
            </article>

            <!-- Card 03 -->
            <article class="bg-white border border-line rounded-container p-8 shadow-[0_6px_0_rgba(38,62,48,0.05)] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_16px_30px_rgba(24,63,50,0.10)] hover:border-forest group">
                <div class="flex items-center justify-between mb-6">
                    <span class="text-4xl font-black text-line group-hover:text-forest transition-colors">03</span>
                    <div class="w-12 h-12 rounded-2xl bg-soft text-forest flex items-center justify-center text-xl group-hover:bg-forest group-hover:text-lime transition-all">
                        <i class="glyph cup" aria-hidden="true"></i>
                    </div>
                </div>
                <h3 class="text-section text-ink font-bold mb-2 group-hover:text-forest transition-colors">Raih XP & Badge</h3>
                <p class="text-body text-muted leading-relaxed">
                    Begitu bukti disetujui admin, XP langsung masuk secara instan, membuka level baru dan menumbuhkan badge di Kebunku.
                </p>
            </article>
        </div>
    </section>

    <!-- Section Preview Misi Populer -->
    <section class="mt-16 bg-white border border-line rounded-container p-8 lg:p-10 shadow-[0_8px_24px_rgba(38,62,48,0.04)]">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-caption font-bold text-forest uppercase tracking-wider">Katalog Awal</span>
                <h2 class="text-section text-ink font-bold mt-1">Misi favorit untuk memulai langkahmu</h2>
            </div>
            @if(auth()->check())
                <a href="{{ route('user.missions.index') }}" class="text-label text-forest font-semibold hover:underline inline-flex items-center gap-1">
                    Jelajahi semua misi →
                </a>
            @else
                <a href="{{ route('register') }}" class="text-label text-forest font-semibold hover:underline inline-flex items-center gap-1">
                    Daftar untuk melihat 18 misi →
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Preview Misi 1 -->
            <div class="border border-line rounded-2xl p-5 hover:border-forest transition-all hover:shadow-md bg-ivory/30 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-caption font-bold text-forest bg-soft px-2.5 py-1 rounded-full">Level 1 · Kebiasaan</span>
                        <span class="text-caption font-bold text-forest bg-lime px-2 py-0.5 rounded-full">+50 XP</span>
                    </div>
                    <h3 class="text-label font-bold text-ink text-base mb-1.5">Bawa tumbler sendiri</h3>
                    <p class="text-caption text-muted line-clamp-2">Gunakan botol minum isi ulang untuk mengganti satu minuman kemasan sekali pakai.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between">
                    <span class="text-caption text-muted">Syarat: 1 Foto</span>
                    <span class="text-caption font-semibold text-forest">Tersedia</span>
                </div>
            </div>

            <!-- Preview Misi 2 -->
            <div class="border border-line rounded-2xl p-5 hover:border-forest transition-all hover:shadow-md bg-ivory/30 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-caption font-bold text-forest bg-soft px-2.5 py-1 rounded-full">Level 1 · Daur ulang</span>
                        <span class="text-caption font-bold text-forest bg-lime px-2 py-0.5 rounded-full">+75 XP</span>
                    </div>
                    <h3 class="text-label font-bold text-ink text-base mb-1.5">Belanja tanpa plastik</h3>
                    <p class="text-caption text-muted line-clamp-2">Gunakan tas belanja ramah lingkungan atau wadah sendiri saat berbelanja.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between">
                    <span class="text-caption text-muted">Syarat: 1 Foto</span>
                    <span class="text-caption font-semibold text-forest">Tersedia</span>
                </div>
            </div>

            <!-- Preview Misi 3 -->
            <div class="border border-line rounded-2xl p-5 hover:border-forest transition-all hover:shadow-md bg-ivory/30 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-caption font-bold text-forest bg-soft px-2.5 py-1 rounded-full">Level 1 · Kebiasaan</span>
                        <span class="text-caption font-bold text-forest bg-lime px-2 py-0.5 rounded-full">+75 XP</span>
                    </div>
                    <h3 class="text-label font-bold text-ink text-base mb-1.5">Pilah sampah di rumah</h3>
                    <p class="text-caption text-muted line-clamp-2">Pilah sampah yang kamu hasilkan antara organik, anorganik, dan residu.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-line/60 flex items-center justify-between">
                    <span class="text-caption text-muted">Syarat: 1 Foto</span>
                    <span class="text-caption font-semibold text-forest">Tersedia</span>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
