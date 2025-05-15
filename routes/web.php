<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AsupanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Auth;


Route::view('/register', 'auth.register-vue')->name('register');
Route::post('/api/register', [RegisterController::class, 'register']);  
Route::get('/login', function() {
    if (Auth::check()) {
        return redirect()->route('profil');
    }
    return view('auth.login-vue');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', function () {
    return view('home');
});

//Google Login
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback/google', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate([
        'email' => $googleUser->getEmail(),
    ], [
        'name' => $googleUser->getName(),
        'google_id' => $googleUser->getId(),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {

    //
    Route::get('/sehat', function () {
        return view('dashboard.pilihansehat');
    });
    Route::get('/sehat/minuman', function () {
        return view('dashboard.pilihansehat.minumansehat');
    });
    Route::get('/sehat/buah', function () {
        return view('dashboard.pilihansehat.buahsehat');
    });
    Route::get('/sehat/sayur', function () {
        return view('dashboard.pilihansehat.sayur');
    });
    Route::get('/sehat/protein', function () {
        return view('dashboard.pilihansehat.minumansehat');
    });
    Route::get('/sehat/karbohidrat', function () {
        return view('dashboard.pilihansehat.proteinsehat');
    });
     Route::get('/dashboard', function () {
        return view('dashboard.index');
    });


    Route::get('/asupan', [AsupanController::class, 'create'])->name('asupan.create');

    // Profile
   Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/password', [ProfilController::class, 'editPassword'])->name('profil.password');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');
    Route::put('/profil', [ProfilController::class, 'update']); 
    Route::delete('/profil/hapus-akun', [ProfilController::class, 'destroy'])->name('profil.destroy');
    
    // Profile API for Vue
    Route::get('/api/user/profile', [ProfilController::class, 'getProfileData']);
    Route::put('/api/user/profile', [ProfilController::class, 'updateProfileApi']);


    // Asupan
    Route::post('/asupan', [AsupanController::class, 'store'])->name('asupan.store'); 

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store'); 

    //konsultasi
  Route::get('/konsultasi', [KonsultasiController::class, 'chooseDoctor'])->name('konsultasi.pilih');
    Route::get('/konsultasi/messages', [KonsultasiController::class, 'messagesForDoctor'])->name('konsultasi.messages');
Route::get('/konsultasi/chat/dokter/{role}', [KonsultasiController::class, 'chatPage'])->name('konsultasi.chat.role');
Route::get('/konsultasi/chat/user/{userId}', [KonsultasiController::class, 'chatPageWithUser'])->name('konsultasi.chat.user');
    Route::post('/konsultasi/send', [KonsultasiController::class, 'sendMessage'])->name('konsultasi.send');

 Route::get('/konsultasi/fetch-messages/{role}', [KonsultasiController::class, 'fetchMessages'])->name('konsultasi.fetch');
 Route::get('/konsultasi/chat/user/{userId}/messages', [KonsultasiController::class, 'fetchMessagesFromUser'])->name('konsultasi.fetch.user');



    //logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});
