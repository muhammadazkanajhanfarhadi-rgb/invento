<div class="space-y-5">
    <div>
        <label for="name" class="mb-1 block text-sm font-medium">
            Nama kategori
        </label>
        <input id="name" name="name" required maxlength="100"
               value="{{ old('name', $category?->name) }}"
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="mb-1 block text-sm font-medium">
            Deskripsi
        </label>
        <textarea id="description" name="description" rows="3"
                  class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('description', $category?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3">
        <button class="rounded-lg bg-blue-600 px-5 py-2 text-white">
            Simpan
        </button>
        <a href="{{ route('categories.index') }}"
           class="rounded-lg border border-slate-300 px-5 py-2">
            Batal
        </a>
    </div>
</div>