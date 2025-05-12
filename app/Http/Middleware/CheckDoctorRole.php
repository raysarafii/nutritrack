<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDoctorRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->role == 'dokter_pencegahan' || auth()->user()->role == 'dokter_pengobatan')) {
            return redirect()->route('konsultasi.messages');
        }

        return $next($request);
    }
}
