<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return string
     */
    public function handle(Request $request, Closure $next): string
    {
        if (!Auth::user()?->is_admin) {
            return response()->json(['error' => 'Forbidden'],403);
        }

        return $next($request);
    }
}
