<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        $user = auth()->user();

        // // Kalau dia bukan admin, dianggap user biasa
        // if ($user && $user->RecordOwnerID !== '99999') {
        //     return $next($request);
        // }

        // abort(403, 'Unauthorized (User only).');

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($user && $user->RecordOwnerID !== '99999') {
            return $next($request);
        }
        
        // Kalau user login tapi bukan yang diizinkan
        return abort(403, 'Unauthorized');
    }
}
