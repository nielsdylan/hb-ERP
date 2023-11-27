<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // if ($_SERVER["HTTP_HOST"]=='hbgroup.pe') {
            $this->app->bind('path.public',function(){
                return '/home/hbgroup/public_html';
            });
        // }


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
