@extends('dashboard.sidebar')

@section('title', 'Konsultasi')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Pesan yang Dikirim ke Dokter {{ ucfirst(str_replace('_', ' ', $role)) }}</h2>
    
    @if($users->isEmpty())
        <p>Tidak ada pesan yang diterima dari pengguna.</p>
    @else
        <ul class="space-y-4">
            @foreach($users as $user)
                <li>
                    <a href="{{ route('konsultasi.chat.user', $user->id) }}" class="flex items-center gap-4 p-4 border rounded-lg hover:bg-gray-100">
                        <span>{{ $user->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
