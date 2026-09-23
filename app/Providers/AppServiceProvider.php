<?php

namespace App\Providers;

use App\Http\Middleware\AuthSession;
use App\Http\Middleware\GuestSession;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::aliasMiddleware('auth.session', AuthSession::class);
        Route::aliasMiddleware('guest.session', GuestSession::class);
    }
}
