<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Ruang hijau') · Plogee</title>
    <!-- Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ivory text-ink font-sans min-h-screen antialiased">
@auth
    @php
        $account = auth()->user();
        $admin = $account->role === 'admin';
        $initials = collect(preg_split('/\s+/u', trim($account->name), -1, PREG_SPLIT_NO_EMPTY))
            ->take(2)->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');
    @endphp
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        @include('components.sidebar')

        <!-- Main Workspace -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar Header -->
            <header class="h-20 bg-white border-b border-line px-8 flex items-center justify-between gap-4">
                <div class="text-label text-muted">
                    <span>{{ $admin ? 'Ruang admin' : 'Ruang hijau' }}</span>
                    <span class="mx-1 text-line">/</span>
                    <span class="text-ink font-semibold">@yield('title', 'Dashboard')</span>
                </div>
                <div class="flex items-center gap-3">
                    <time class="text-caption text-muted font-medium" datetime="{{ now('Asia/Jakarta')->toDateString() }}">
                        {{ now('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMM YYYY') }}
                    </time>
                    <a class="w-11 h-11 rounded-full flex items-center justify-center hover:bg-soft text-forest transition-colors"
                       aria-label="{{ $admin ? 'Buka antrean bukti' : 'Lihat misi yang perlu perbaikan' }}"
                       href="{{ $admin ? route('admin.submissions.index') : route('user.my-missions', ['status' => 'rejected']) }}">
                        <i class="glyph bell" aria-hidden="true"></i>
                    </a>
                    <details class="relative">
                        <summary class="w-11 h-11 flex items-center justify-center cursor-pointer list-none" aria-label="Menu akun {{ $account->name }}">
                            <span class="w-10 h-10 rounded-full bg-soft text-forest font-semibold text-label flex items-center justify-center ring-2 ring-transparent hover:ring-forest transition-all">
                                {{ $initials }}
                            </span>
                        </summary>
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-line rounded-2xl p-4 shadow-lg z-50 flex flex-col gap-2">
                            <strong class="text-label text-ink block border-b border-line pb-2 truncate">{{ $account->name }}</strong>
                            @unless($admin)
                                <a href="{{ route('user.profile') }}" class="text-body text-ink hover:text-forest py-1">Profil saya</a>
                            @endunless
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-body text-[#903E35] hover:underline py-1 w-full text-left font-medium">Keluar</button>
                            </form>
                        </div>
                    </details>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-8 lg:p-10 flex-1 max-w-7xl w-full" id="content">
                @include('components.alert')
                @yield('content')
            </main>
        </div>
    </div>
@else
    <!-- Public Header (Guest) -->
    <header class="h-20 bg-white border-b border-line px-6 lg:px-12 flex items-center justify-between">
        <a class="inline-flex items-center" href="{{ route('landing') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Plogee" class="h-12 w-auto object-contain">
        </a>
        <nav class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-label text-forest hover:text-forest-hover px-4 py-2">Masuk</a>
            <x-action :href="route('register')" onclick="window.location='{{ route('register') }}'">Daftar</x-action>
        </nav>
    </header>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10 min-h-[76vh]">
        <main>
            @include('components.alert')
            @yield('content')
        </main>
    </div>

    <footer class="py-6 px-12 text-caption text-muted border-t border-line text-center">
        Plogee · Ruang aksi hijau berkelanjutan
    </footer>
@endauth

@stack('scripts')
</body>
</html>
