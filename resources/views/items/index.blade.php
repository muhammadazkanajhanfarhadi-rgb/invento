
@extends('layouts.inventory')

@section('title', 'Data Barang - Invento')
@section('heading', 'Data Barang')

@section('content')

    {{-- Header Halaman --}}
    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('inventory.dashboard') }}" class="transition hover:text-blue-600">
                    Dashboard
                </a>
                <span>/</span>
                <span class="font-medium text-slate-700">Data Barang</span>
            </div>

            <h1 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">
                Data Barang
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola, cari, dan pantau seluruh barang inventaris kamu.
            </p>
        </div>

        <a href="{{ route('items.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700">
            <span class="text-xl">+</span>
            Tambah Barang
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
            <span class="font-bold">✓</span>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <span class="font-bold">!</span>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="font-semibold">Data belum dapat diproses.</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Kartu Statistik --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Jenis Barang</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">
                        {{ number_format($items->total(), 0, ',', '.') }}
                    </p>
                    <p class="mt-2 text-xs text-slate-400">Barang yang terdaftar di inventaris</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-2xl text-blue-600">
                    ▤
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Stok Menipis</p>
                    <p class="mt-3 text-3xl font-bold text-amber-600">
                        {{ number_format(\App\Models\Item::whereColumn('stock', '<=', 'minimum_stock')->count(), 0, ',', '.') }}
                    </p>
                    <p class="mt-2 text-xs text-slate-400">Termasuk barang yang stoknya kosong</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-2xl text-amber-600">
                    ⚠
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Stok Kosong</p>
                    <p class="mt-3 text-3xl font-bold text-red-600">
                        {{ number_format(\App\Models\Item::where('stock', 0)->count(), 0, ',', '.') }}
                    </p>
                    <p class="mt-2 text-xs text-slate-400">Barang yang perlu diisi ulang</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50 text-2xl text-red-600">
                    !
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel Inventaris --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Pencarian dan Filter --}}
        <div class="border-b border-slate-100 p-5 sm:p-6">
            <div class="mb-4">
                <h2 class="font-bold text-slate-900">Daftar Inventaris</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Menampilkan data barang, kategori, harga, dan kondisi stok.
                </p>
            </div>

            <form action="{{ route('items.index') }}" method="GET"
                  class="flex flex-col gap-3 lg:flex-row">

                <div class="relative min-w-0 flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau kode barang..."
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                </div>

                <select
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 lg:w-56">

                    <option value="">Semua Kategori</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected((string) request('category_id') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Cari Barang
                </button>

                @if (request()->filled('search') || request()->filled('category_id'))
                    <a href="{{ route('items.index') }}"
                       class="rounded-xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                        Reset
                    </a>
                @endif
            </form>

            @if (request()->filled('search') || request()->filled('category_id'))
                <p class="mt-3 text-xs text-slate-500">
                    Ditemukan {{ $items->total() }} barang yang sesuai dengan pencarian.
                </p>
            @endif
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] text-left text-sm">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Informasi Barang</th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Harga</th>
                        <th class="px-6 py-4 font-semibold">Stok</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($items as $item)
                        <tr class="transition hover:bg-slate-50/80">

                            {{-- Informasi Barang --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 text-lg font-bold text-blue-700">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            {{ $item->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Kode: {{ $item->code }}
                                        </p>

                                        @if ($item->location)
                                            <p class="mt-1 text-xs text-slate-400">
                                                Lokasi: {{ $item->location }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-lg bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700">
                                    {{ $item->category->name ?? 'Tanpa kategori' }}
                                </span>
                            </td>

                            {{-- Harga --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="font-semibold text-slate-700">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- Stok --}}
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">
                                    {{ number_format($item->stock, 0, ',', '.') }}
                                    <span class="text-xs font-normal text-slate-400">unit</span>
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    Minimum: {{ number_format($item->minimum_stock, 0, ',', '.') }}
                                </p>
                            </td>

                            {{-- Status Stok --}}
                            <td class="px-6 py-4">
                                @if ($item->stock <= 0)
                                    <span class="inline-flex items-center gap-2 whitespace-nowrap rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">
                                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                        Stok Kosong
                                    </span>
                                @elseif ($item->stock <= $item->minimum_stock)
                                    <span class="inline-flex items-center gap-2 whitespace-nowrap rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                                        Stok Menipis
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 whitespace-nowrap rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                        Stok Aman
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route('items.edit', $item) }}"
                                       class="rounded-lg border border-blue-100 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:border-blue-200 hover:bg-blue-50">
                                        Edit
                                    </a>

                                    <form action="{{ route('items.destroy', $item) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah kamu yakin ingin menghapus barang {{ addslashes($item->name) }}?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg border border-red-100 px-3 py-2 text-xs font-semibold text-red-600 transition hover:border-red-200 hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl text-slate-400">
                                    ▤
                                </div>

                                <h3 class="mt-4 font-bold text-slate-800">
                                    @if (request()->filled('search') || request()->filled('category_id'))
                                        Barang tidak ditemukan
                                    @else
                                        Belum ada data barang
                                    @endif
                                </h3>

                                <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">
                                    @if (request()->filled('search') || request()->filled('category_id'))
                                        Coba ubah kata kunci atau pilih kategori lainnya.
                                    @else
                                        Mulai dengan menambahkan barang pertama ke sistem inventaris Invento.
                                    @endif
                                </p>

                                @if (request()->filled('search') || request()->filled('category_id'))
                                    <a href="{{ route('items.index') }}"
                                       class="mt-5 inline-flex rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                                        Reset Pencarian
                                    </a>
                                @else
                                    <a href="{{ route('items.create') }}"
                                       class="mt-5 inline-flex rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                                        + Tambah Barang
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($items->hasPages())
            <div class="flex flex-col gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-500">
                    Menampilkan
                    <span class="font-semibold text-slate-700">{{ $items->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-semibold text-slate-700">{{ $items->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-semibold text-slate-700">{{ $items->total() }}</span>
                    barang
                </p>

                <div>
                    {{ $items->withQueryString()->links() }}
                </div>
            </div>
        @else
            @if ($items->total() > 0)
                <div class="border-t border-slate-100 px-5 py-4">
                    <p class="text-sm text-slate-500">
                        Menampilkan {{ $items->total() }} barang.
                    </p>
                </div>
            @endif
        @endif

    </div>

@endsection
