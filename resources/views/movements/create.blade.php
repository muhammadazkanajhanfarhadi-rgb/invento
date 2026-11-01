@extends('layouts.inventory')

@section('title', 'Transaksi Stok - Invento')

@section('content')
<div class="mx-auto max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="mb-6 text-2xl font-bold">Transaksi Stok</h1>

    <form method="POST" action="{{ route('movements.store') }}"
          class="space-y-5">
        @csrf

        <div>
            <label for="item_id" class="mb-1 block text-sm font-medium">
                Barang
            </label>
            <select name="item_id" id="item_id" required
                    class="w-full rounded-lg border px-3 py-2">
                <option value="">Pilih barang</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}"
                        @selected(old('item_id') == $item->id)>
                        {{ $item->code }} — {{ $item->name }}
                        (Stok: {{ $item->stock }})
                    </option>
                @endforeach
            </select>
            @error('item_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="type" class="mb-1 block text-sm font-medium">
                Jenis transaksi
            </label>
            <select name="type" id="type" required
                    class="w-full rounded-lg border px-3 py-2">
                <option value="in" @selected(old('type') === 'in')>
                    Barang masuk
                </option>
                <option value="out" @selected(old('type') === 'out')>
                    Barang keluar
                </option>
            </select>
            @error('type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="quantity" class="mb-1 block text-sm font-medium">
                Jumlah
            </label>
            <input type="number" id="quantity" name="quantity" min="1"
                   value="{{ old('quantity', 1) }}" required
                   class="w-full rounded-lg border px-3 py-2">
            @error('quantity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="notes" class="mb-1 block text-sm font-medium">
                Keterangan
            </label>
            <textarea id="notes" name="notes" rows="3"
                      class="w-full rounded-lg border px-3 py-2">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button class="rounded-lg bg-blue-600 px-5 py-2 text-white">
            Simpan transaksi
        </button>
    </form>
</div>
@endsection