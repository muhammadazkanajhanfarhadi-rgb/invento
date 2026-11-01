
@extends('layouts.inventory')

@section('title', 'Data Kategori')

@section('content')
<div class="space-y-6">

    {{-- Header halaman --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-medium text-blue-600">
                Manajemen Inventaris
            </p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-800">
                Data Kategori
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola kategori untuk mengelompokkan barang inventaris.
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <span class="text-lg">+</span>
            Tambah Kategori
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

    {{-- Statistik --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                    🗂️
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Kategori</p>
                    <p class="mt-1 text-2xl font-bold text-slate-800">
                        {{ $categories->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-2xl">
                    📦
                </div>
                <div>
                    <p class="text-sm text-slate-500">Kategori Terdaftar</p>
                    <p class="mt-1 text-2xl font-bold text-slate-800">
                        {{ $categories->count() }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">
                        Kategori yang tersedia di sistem
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel kategori --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col justify-between gap-2 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="font-semibold text-slate-800">
                    Daftar Kategori
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Informasi kategori barang inventaris.
                </p>
            </div>

            <span class="w-fit rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                {{ $categories->count() }} kategori
            </span>
        </div>

        @if ($categories->isEmpty())
            <div class="px-5 py-16 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                    🗂️
                </div>
                <h3 class="mt-4 font-semibold text-slate-800">
                    Belum ada kategori
                </h3>
                <p class="mx-auto mt-2 max-w-sm text-sm text-slate-500">
                    Tambahkan kategori pertama agar barang inventaris dapat dikelompokkan dengan rapi.
                </p>
                <a href="{{ route('categories.create') }}"
                   class="mt-5 inline-flex rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    + Tambah Kategori
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-5 py-4 font-semibold">No.</th>
                            <th class="px-5 py-4 font-semibold">Nama Kategori</th>
                            <th class="px-5 py-4 font-semibold">Deskripsi</th>
                            <th class="px-5 py-4 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach ($categories as $category)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 font-bold text-blue-700">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                {{ $category->name }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-400">
                                                Kategori inventaris
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $category->description ?: 'Tidak ada deskripsi' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100">
                                            Edit
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="border-t border-slate-100 bg-slate-50 px-5 py-3">
            <p class="text-xs text-slate-500">
                Data kategori inventaris Invento
            </p>
        </div>
    </div>

</div>
@endsection
