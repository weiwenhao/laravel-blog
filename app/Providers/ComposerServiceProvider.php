<?php

namespace App\Providers;

use App\Http\ViewComposers\HomeComposer;
use App\Http\ViewComposers\RightNavComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //类的方式
        view()->composer('layouts.app', HomeComposer::class);
        view()->composer('layouts.rightNav', RightNavComposer::class);
       /* //闭包方式
        view()->composer('layouts.app',function ($view){
            return $view->with('category','123');
        });*/
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
