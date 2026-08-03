<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $roleMap = [
            'admin' => 1,
            'donor' => 2,
            'receiver' => 3,
            'volunteer' => 4,
        ];

        if (!isset($roleMap[$role])) {
            abort(403);
        }

        if (auth()->user()->role_id != $roleMap[$role]) {
            abort(403);
        }

        return $next($request);
    }
}