<?php

namespace App\Providers;

use App\Helpers\MenuHelper;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();
        View::share('g_categories', Category::getGlobalCategories());
        View::share('g_pages', Page::getGlobalPages());
        View::share('g_menuHelper', new MenuHelper());
    }
}
