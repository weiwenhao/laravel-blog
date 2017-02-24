<?php

namespace App\Providers;

use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * 任何应用程序都会经过
     *
     * @return void
     */
    public function boot()
    {
        //设置Carbon的语言
        Carbon::setLocale('zh');

        //设置ModelFactory语言
        $this->app->singleton(Generator::class,function (){
            return Factory::create('zh_CN');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
