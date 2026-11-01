@extends('layouts.inventory')

@section('title', 'Tambah Kategori - Invento')

@section('content')
<div class="mx-auto max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="mb-6 text-2xl font-bold">Tambah Kategori</h1>

    @php($category = null)

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        @include('categories._form')
    </form>
</div>
@endsection