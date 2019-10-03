<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use View;

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
        Schema::defaultStringLength('191');

//        View::share('key','value');
//        View::share('name','Sehab uddin');
        View::composer('front-end.includes.menu', function ($view) {
            $view->with('categorys',Category::where('publication_status', 1)->get() );
        });

    }
}
