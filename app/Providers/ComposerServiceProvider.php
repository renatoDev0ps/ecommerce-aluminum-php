<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose');
        // $categories = \App\Category::all();
        // view()->share("categories", $categories);
        // view()->composer('*', function ($view) use ($categories){
        //     $view->with('categories', $categories);
        // });
    }
}
