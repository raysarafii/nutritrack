@extends('dashboard.sidebar')

@section('title', 'Pilihan Sehat')

@section('content')
<h1 class="text-3xl sm:text-4xl text-center font-bold bg-gradient-to-r from-[#007AFF] to-[#00D26A] bg-clip-text text-transparent mb-6 font-['Poppins']">
    Minuman Sehat
</h1>

<div class="space-y-6">
    <!-- Air Putih -->
    <div class="bg-blue-100 p-6 rounded-xl shadow-md flex flex-col md:flex-row gap-4 md:gap-6 items-center">
        <img src="{{ asset('images/air.jpg') }}" alt="Air Putih"
             class="rounded-lg w-full sm:w-64 h-40 object-cover md:h-28" />
        <div class="text-center md:text-left">
            <h3 class="font-semibold text-xl sm:text-2xl font-['Poppins']">Air Putih</h3>
            <p class="text-base sm:text-lg text-gray-700 mt-2">
                Tidak mengandung kalori dan gula sehingga aman bagi penderita diabetes dan untuk diet.
                Membantu mengeluarkan kelebihan gula darah melalui urine dan menjaga hidrasi tubuh.
            </p>
        </div>
    </div>

    <!-- Teh Hijau -->
    <div class="bg-blue-100 p-6 rounded-xl shadow-md flex flex-col md:flex-row gap-4 md:gap-6 items-center">
        <img src="{{ asset('images/teh.jpg') }}" alt="Teh Hijau"
             class="rounded-lg w-full sm:w-64 h-40 object-cover md:h-28" />
        <div class="text-center md:text-left">
            <h3 class="font-semibold text-xl sm:text-2xl font-['Poppins']">Teh Hijau</h3>
            <p class="text-base sm:text-lg text-gray-700 mt-2">
                Mengandung katekin yang membantu meningkatkan sensitivitas insulin dan mengurangi kadar gula darah.
                Rendah kalori jika dikonsumsi tanpa gula. Dapat membantu menurunkan berat badan dan mengurangi risiko obesitas.
            </p>
        </div>
    </div>

    <!-- Jus Tanpa Gula -->
    <div class="bg-blue-100 p-6 rounded-xl shadow-md flex flex-col md:flex-row gap-4 md:gap-6 items-center">
        <img src="{{ asset('images/jus.jpg') }}" alt="Jus Tanpa Gula"
             class="rounded-lg w-full sm:w-64 h-40 object-cover md:h-28" />
        <div class="text-center md:text-left">
            <h3 class="font-semibold text-xl sm:text-2xl font-['Poppins']">Jus Tanpa Gula</h3>
            <p class="text-base sm:text-lg text-gray-700 mt-2">
                Jus dari buah rendah gula seperti lemon, apel hijau, atau stroberi dapat menjadi pilihan sehat.
                Membantu memenuhi kebutuhan vitamin dan mineral tanpa meningkatkan kadar gula darah secara berlebihan.
            </p>
        </div>
    </div>
</div>
@endsection
