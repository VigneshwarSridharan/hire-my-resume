<?php

namespace App\Providers;

use TCG\Voyager\Models\Menu;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        
        $menu = Menu::display('site', 'layout.menu');
        view()->share('menu', $menu);

        Voyager::addAction(\App\Actions\ReviewsAction::class);
    }
}
