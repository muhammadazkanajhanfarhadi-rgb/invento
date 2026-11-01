<div class="space-y-5">
    <div>
        <label for="category_id" class="mb-1 block text-sm font-medium">
            Kategori
        </label>
        <select id="category_id" name="category_id" required
                class="w-full rounded-lg border border-slate-300 px-3 py-2">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $item?->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="code" class="mb-1 block text-sm font-medium">Kode barang</label>
        <input id="code" name="code" required maxlength="50"
               value="{{ old('code', $item?->code) }}"
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @error('code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="name" class="mb-1 block text-sm font-medium">Nama barang</label>
        <input id="name" name="name" required maxlength="150"
               value="{{ old('name', $item?->name) }}"
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="stock" class="mb-1 block text-sm font-medium">Stok</label>
            <input id="stock" type="number" name="stock" min="0" required
                   value="{{ old('stock', $item?->stock ?? 0) }}"
                   class="w-full rounded-lg border border-slate-300 px-3 py-2">
            @error('stock')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="minimum_stock" class="mb-1 block text-sm font-medium">
                Batas stok minimum
            </label>
            <input id="minimum_stock" type="number" name="minimum_stock"
                   min="0" required
                   value="{{ old('minimum_stock', $item?->minimum_stock ?? 0) }}"
                   class="w-full rounded-lg border border-slate-300 px-3 py-2">
            @error('minimum_stock')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="price" class="mb-1 block text-sm font-medium">
            Harga satuan (Rp)
        </label>
        <input id="price" type="number" name="price" min="0" step="0.01"
               required value="{{ old('price', $item?->price ?? 0) }}"
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @error('price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="location" class="mb-1 block text-sm font-medium">
            Lokasi penyimpanan
        </label>
        <input id="location" name="location" maxlength="100"
               value="{{ old('location', $item?->location) }}"
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @error('location')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3">
        <button class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
            Simpan
        </button>
        <a href="{{ route('items.index') }}"
           class="rounded-lg border border-slate-300 px-5 py-2 hover:bg-slate-50">
            Batal
        </a>
    </div>
</div>