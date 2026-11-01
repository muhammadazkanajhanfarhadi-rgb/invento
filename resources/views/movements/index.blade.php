
@extends('layouts.inventory')

@section('title', 'Transaksi Stok')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-medium text-blue-600">
                Manajemen Inventaris
            </p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-800">
                Transaksi Stok
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Pantau setiap barang masuk dan keluar dari inventaris.
            </p>
        </div>

        <a href="{{ route('movements.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <span class="text-lg">+</span>
            Tambah Transaksi
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-semibold">Terjadi kesalahan:</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                    📋
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Transaksi</p>
                    <p class="mt-1 text-2xl font-bold text-slate-800">
                        {{ $movements->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-2xl">
                    ↗️
                </div>
                <div>
                    <p class="text-sm text-slate-500">Barang Masuk</p>
                    <p class="mt-1 text-2xl font-bold text-emerald-600">
                        {{ $movements->where('type', 'in')->count() }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Transaksi masuk</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-2xl">
                    ↘️
                </div>
                <div>
                    <p class="text-sm text-slate-500">Barang Keluar</p>
                    <p class="mt-1 text-2xl font-bold text-rose-600">
                        {{ $movements->where('type', 'out')->count() }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">Transaksi keluar</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel transaksi --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col justify-between gap-2 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="font-semibold text-slate-800">
                    Riwayat Transaksi
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Daftar pergerakan stok barang.
                </p>
            </div>

            <span class="w-fit rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                {{ $movements->count() }} transaksi
            </span>
        </div>

        @if ($movements->isEmpty())
            <div class="px-5 py-16 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                    📦
                </div>
                <h3 class="mt-4 font-semibold text-slate-800">
                    Belum ada transaksi stok
                </h3>
                <p class="mx-auto mt-2 max-w-sm text-sm text-slate-500">
                    Mulai catat barang masuk atau keluar untuk memantau perubahan stok inventaris.
                </p>
                <a href="{{ route('movements.create') }}"
                   class="mt-5 inline-flex rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    + Tambah Transaksi
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">No.</th>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Informasi Barang</th>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Jenis Transaksi</th>
                            <th class="whitespace-nowrap px-5 py-4 text-right font-semibold">Jumlah</th>
                            <th class="whitespace-nowrap px-5 py-4 font-semibold">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach ($movements as $movement)
                            <tr class="transition hover:bg-slate-50">

                                <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-xl">
                                            📦
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                {{ $movement->item->name ?? 'Barang tidak ditemukan' }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $movement->item->code ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($movement->type === 'in')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                            <span>↗</span>
                                            Barang Masuk
                                        </span>
                                    @elseif ($movement->type === 'out')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">
                                            <span>↘</span>
                                            Barang Keluar
                                        </span>
                                    @else
                                        <span class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                                            {{ ucfirst($movement->type) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-right">
                                    <span class="font-bold {{ $movement->type === 'in' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $movement->type === 'in' ? '+' : '-' }}{{ number_format($movement->quantity ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="ml-1 text-xs text-slate-400">unit</span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <p class="font-medium text-slate-700">
                                        {{ $movement->created_at?->format('d M Y') ?? '-' }}
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $movement->created_at?->format('H:i') ?? '' }}
                                    </p>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="border-t border-slate-100 bg-slate-50 px-5 py-3">
            <p class="text-xs text-slate-500">
                Riwayat transaksi stok Invento
            </p>
        </div>
    </div>

</div>
@endsection
