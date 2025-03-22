<?php

namespace App\Providers;

use App\Observers\PaymentObserver;
use App\Models\PaymentConfirmation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MemberMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrapFive();
        Route::middlewareGroup('admin', [AdminMiddleware::class]);
        Route::middlewareGroup('member', [MemberMiddleware::class]);
        PaymentConfirmation::observe(PaymentObserver::class);
        Paginator::useBootstrap();
    }
}
