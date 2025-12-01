<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $level = Auth::user()->level_id;

            if ($level == 1) {
                return redirect()->route('level.index');
            }
            
            $getLinks = Auth::user()->level->menus;
            return redirect()->to($getLinks[0]->link);
        }
        return $next($request);
    }
}
