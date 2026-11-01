
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Invento')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

<div class="min-h-screen md:flex">

    <!-- Sidebar -->
    <aside class="w-full bg-slate-950 text-white md:fixed md:inset-y-0 md:left-0 md:flex md:w-64 md:flex-col">
        <div class="flex items-center gap-3 border-b border-white/10 px-6 py-6">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-500 text-xl font-black shadow-lg shadow-blue-500/20">
                I
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-wide">Invento</h1>
                <p class="text-xs text-slate-400">Inventory Management</p>
            </div>
        </div>

        <div class="px-4 py-5">
            <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-widest text-slate-500">
                Menu Utama
            </p>

            <nav class="space-y-1">
                <a href="{{ route('inventory.dashboard') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('inventory.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>▦</span> Dashboard
                </a>

                <a href="{{ route('items.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('items.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>▤</span> Data Barang
                </a>

                <a href="{{ route('categories.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>▧</span> Kategori
                </a>

                <a href="{{ route('movements.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
                   {{ request()->routeIs('movements.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>⇄</span> Transaksi Stok
                </a>
            </nav>
        </div>

        <div class="mt-auto hidden px-4 pb-5 md:block">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                <p class="text-sm font-semibold">Invento Workspace</p>
                <p class="mt-1 text-xs leading-5 text-slate-400">
                    Kelola barang dan pantau stok dalam satu tempat.
                </p>
            </div>
        </div>
    </aside>

    <!-- Konten utama -->
    <main class="min-w-0 flex-1 md:ml-64">
        <!-- Header -->
        <header class="sticky top-0 z-10 border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="flex items-center justify-between gap-4 px-5 py-4 sm:px-8">
                <div>
                    <p class="text-xs font-medium text-slate-500">INVENTORY SYSTEM</p>
                    <h2 class="mt-1 text-lg font-bold text-slate-900">
                        @yield('heading', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <div class="p-5 sm:p-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <p class="font-semibold">Periksa kembali data yang dimasukkan.</p>
                    <ul class="mt-2 list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

        <footer class="px-5 pb-6 text-center text-xs text-slate-400 sm:px-8">
            © {{ date('Y') }} Invento · Inventory Management System
        </footer>
    </main>
</div>

</body>
</html>
