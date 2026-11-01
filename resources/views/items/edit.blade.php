@extends('layouts.inventory')

@section('title', 'Edit Barang - Invento')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    <h1 class="mb-6 text-2xl font-bold">Edit Barang</h1>

    <form method="POST" action="{{ route('items.update', $item) }}">
        @csrf
        @method('PUT')
        @include('items._form')
    </form>
</div>
@endsection