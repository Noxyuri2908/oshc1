<?php

namespace App\Providers;

use App\Http\ViewComposers\FrontendViewComposer;
use App\Http\ViewComposers\NavBarViewComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerNavBar extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        view()->composer(
//          'navbar',
//            'App\Http\ViewComposers\NavBarViewComposer'
//        );

//        View::composer('navbar', NavBarViewComposer::class);
    }
}
