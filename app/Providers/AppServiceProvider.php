<?php

namespace App\Providers;

use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Http\View\Composers\RegionComposer;

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
        View::composer('*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        Paginator::useBootstrapFive();

        View::composer('*', RegionComposer::class);
    }
}
