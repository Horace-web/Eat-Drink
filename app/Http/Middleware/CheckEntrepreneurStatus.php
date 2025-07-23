<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEntrepreneurStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->statut === 'en_attente') {
            return redirect()->route('attente');
        }
        return $next($request);
    }
}
