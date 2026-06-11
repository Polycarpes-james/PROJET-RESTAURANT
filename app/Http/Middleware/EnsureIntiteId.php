<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class EnsureIntiteId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Si utilisateur connecté, on ne fait rien
        if (auth()->check()) {
            return $next($request);
        }

        $inviteId = Cookie::get('invite_id');

        if (!$inviteId) {
            $inviteId = (string) Str::uuid();

            Cookie::queue('invite_id',$inviteId, 60 * 24 * 1);
        }
        // rendre disponible dans la requête
        $request->attributes->set('invite_id', $inviteId);

        return $next($request);
    }
}
