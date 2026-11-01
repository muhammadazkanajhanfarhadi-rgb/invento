@extends('layouts.inventory')

@section('title', 'Tambah Barang - Invento')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="mb-6 text-2xl font-bold">Tambah Barang</h1>

    @if ($errors->any())
        <div class="mb-5 rounded-lg bg-red-50 p-4 text-sm text-red-700">
            Periksa kembali data yang kamu masukkan.
        </div>
    @endif

    @php($item = null)

    <form method="POST" action="{{ route('items.store') }}">
        @csrf
        @include('items._form')
    </form>
</div>
@endsection