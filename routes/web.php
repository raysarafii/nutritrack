<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AsupanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PilihanSehatController;


Route::view('/register', 'auth.register-vue')->name('register');
Route::get('/login', function() {
    if (Auth::check()) {
        return redirect()->route('profil');
    }
    return view('auth.login-vue');
})->name('login');
//Google Login
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});
Route::post('/api/login', [LoginController::class, 'login']);

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


// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/api/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/api/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify');
Route::post('/api/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/', function () {
    return view('home');
});


Route::middleware(['auth'])->group(function () {
     Route::get('/dashboard', function () {
        $asupanController = new \App\Http\Controllers\AsupanController();
        $dailyData = $asupanController->getDailyTotals();
        return view('dashboard.index', compact('dailyData'));
    });
     //Pilihan Sehat
        Route::get('/sehat', function () {
            return view('dashboard.pilihansehat');
        });
        Route::get('/sehat/{kategori?}', [PilihanSehatController::class, 'index'])->name('sehat.index');

    //Pilihan Sehat Admin
    Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
        Route::get('pilihan-sehat', [PilihanSehatController::class, 'adminIndex'])->name('pilihan-sehat.index');
        Route::get('pilihan-sehat/create', [PilihanSehatController::class, 'create'])->name('pilihan-sehat.create');
        Route::post('pilihan-sehat', [PilihanSehatController::class, 'store'])->name('pilihan-sehat.store');
        Route::get('pilihan-sehat/{pilihanSehat}/edit', [PilihanSehatController::class, 'edit'])->name('pilihan-sehat.edit');
        Route::put('pilihan-sehat/{pilihanSehat}', [PilihanSehatController::class, 'update'])->name('pilihan-sehat.update');
        Route::delete('pilihan-sehat/{pilihanSehat}', [PilihanSehatController::class, 'destroy'])->name('pilihan-sehat.destroy');
    });
    Route::get('/asupan', [AsupanController::class, 'create'])->name('asupan.create');

    // Profile
   Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/password', [ProfilController::class, 'editPassword'])->name('profil.password');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');
    Route::put('/profil', [ProfilController::class, 'update']); 
    Route::delete('/profil/hapus-akun', [ProfilController::class, 'destroy'])->name('profil.destroy');
    
    // Profile API
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
