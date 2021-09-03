<?php

namespace App\Providers;
use App\Http\ViewComposers\MovieComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
// use App\Http\Controllers\UserController;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('Pos.index', MovieComposer::class);
        //  View::composer(
        //     'Pos.index',
        //     'App\Http\ViewComposers\MovieComposer'
        // );
    }
}
