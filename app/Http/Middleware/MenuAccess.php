<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // AMBIL USER
        $user = auth()->user();

        // KALO BELOM LOGIN, SILAHKAN LOGIN
        if (! $user) {
            return redirect()->route('login');
        }

        // KALO ADMIN, NEXT AJA, DIBAWAH INI BRATI BUKAN ADMIN
        if ($user->level_id !== 1) {

            // AMBIL PATH SEKARANG
            $currentPath = trim($request->path(), '/');

            // SPLIT BERDASARKAN SLASH
            $getBasepath = explode('/', $currentPath)[0];

            // KUMPULIN SEMUA MENU BERDASARKAN LEVEL, JADIIN ARRAY
            $allowedLinks = $user->level->menus->pluck('link')->map(function ($link) {
                return trim($link, '/');
            });

            // KALO GA ADA, JANGAN KASIH
            if (! $allowedLinks->contains($getBasepath)) {
                abort(403, 'Anda bukan admin, hubungi admin hehe');
            }

            // KALO ADA NEXT
            return $next($request);
        }

        // INI KALO ADMIN
        return $next($request);
    }
}
