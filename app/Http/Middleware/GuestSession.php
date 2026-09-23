<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('user_id')) {
            return to_route('tasks.index');
        }

        return $next($request);
    }
}
