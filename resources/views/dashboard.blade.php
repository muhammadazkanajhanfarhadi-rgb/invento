
@extends('layouts.inventory')

@section('title', 'Dashboard - Invento')
@section('heading', 'Dashboard')

@section('content')

    <!-- Sambutan -->
    <section class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-600 p-6 text-white shadow-xl shadow-blue-900/10 sm:p-8">
        <div class="relative z-10 max-w-2xl">
            <p class="text-sm font-medium text-blue-100">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>

            <h1 class="mt-3 text-2xl font-bold sm:text-3xl">
                Selamat datang, {{ auth()->user()->name }}!
            </h1>

            <p class="mt-3 max-w-lg text-sm leading-6 text-blue-100 sm:text-base">
                Pantau kondisi inventaris, kelola barang, dan pastikan stok selalu terkendali melalui Invento.
            </p>

            <a href="{{ route('items.index') }}"
               class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">
                Lihat Data Barang <span>→</span>
            </a>
        </div>

        <div class="pointer-events-none absolute -right-10 -top-16 h-64 w-64 rounded-full border-[32px] border-white/10"></div>
        <div class="pointer-events-none absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-white/10"></div>
    </section>

    <!-- Statistik -->
    <section class="mb-8">
        <div class="mb-4">
            <h2 class="text-lg font-bold text-slate-900">Ringkasan Inventaris</h2>
            <p class="mt-1 text-sm text-slate-500">Informasi utama kondisi inventaris saat ini.</p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-xl text-blue-600">▤</div>
                    <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">Barang</span>
                </div>
                <p class="mt-5 text-sm font-medium text-slate-500">Total Jenis Barang</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($totalItems) }}</p>
                <p class="mt-2 text-xs text-slate-400">Jumlah data barang terdaftar</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-xl text-violet-600">▧</div>
                    <span class="rounded-full bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-700">Kategori</span>
                </div>
                <p class="mt-5 text-sm font-medium text-slate-500">Total Kategori</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($totalCategories) }}</p>
                <p class="mt-2 text-xs text-slate-400">Kategori barang yang tersedia</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-xl text-amber-600">⚠</div>
                    <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Perhatian</span>
                </div>
                <p class="mt-5 text-sm font-medium text-slate-500">Stok Menipis</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($lowStock) }}</p>
                <p class="mt-2 text-xs text-slate-400">Barang pada batas stok minimum</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-xl text-emerald-600">⇄</div>
                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Hari ini</span>
                </div>
                <p class="mt-5 text-sm font-medium text-slate-500">Transaksi Hari Ini</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($todayMovements) }}</p>
                <p class="mt-2 text-xs text-slate-400">Aktivitas stok tercatat hari ini</p>
            </div>

        </div>
    </section>

    <!-- Akses cepat -->
    <section>
        <div class="mb-4">
            <h2 class="text-lg font-bold text-slate-900">Akses Cepat</h2>
            <p class="mt-1 text-sm text-slate-500">Pilih menu untuk mulai mengelola inventaris.</p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <a href="{{ route('items.index') }}"
               class="group rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-blue-300 hover:shadow-lg hover:shadow-blue-900/5">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-xl text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">＋</div>
                <h3 class="mt-4 font-bold text-slate-900">Kelola Barang</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Lihat, tambah, dan perbarui data barang inventaris.</p>
                <p class="mt-4 text-sm font-semibold text-blue-600">Buka data barang →</p>
            </a>

            <a href="{{ route('categories.index') }}"
               class="group rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-violet-300 hover:shadow-lg hover:shadow-violet-900/5">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-xl text-violet-600 transition group-hover:bg-violet-600 group-hover:text-white">▧</div>
                <h3 class="mt-4 font-bold text-slate-900">Kelola Kategori</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Kelompokkan barang agar data lebih teratur.</p>
                <p class="mt-4 text-sm font-semibold text-violet-600">Buka kategori →</p>
            </a>

            <a href="{{ route('movements.create') }}"
               class="group rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-900/5">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xl text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">⇄</div>
                <h3 class="mt-4 font-bold text-slate-900">Catat Transaksi Stok</h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">Catat barang masuk atau keluar dari inventaris.</p>
                <p class="mt-4 text-sm font-semibold text-emerald-600">Buat transaksi →</p>
            </a>

        </div>
    </section>

@endsection
