@extends('dashboard.sidebar')

@section('title', 'Pilih Dokter')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Pilih Jenis Dokter:</h2>
    <div class="flex gap-6">
        <a href="{{ route('konsultasi.chat.role', 'dokter_pencegahan') }}">
    <button class="bg-green-500 text-white px-6 py-3 rounded-full">Dokter Pencegahan</button>
</a>
<a href="{{ route('konsultasi.chat.role', 'dokter_pengobatan') }}">
    <button class="bg-green-500 text-white px-6 py-3 rounded-full">Dokter Pengobatan</button>
</a>

    </div>
</div>
@endsection
