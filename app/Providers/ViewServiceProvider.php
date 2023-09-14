<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Page;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        if (request()->is('admin') || request()->is('admin/*')) {
            view()->composer('*', function ($view) {
                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Link::whereStatus(true)->get());
                }
                $admin_side_menu = Cache::get('admin_side_menu');

                $routes_name = [];
                foreach (Route::getRoutes()->getRoutes() as $route) {
                    $action = $route->getAction();
                    if (array_key_exists('as', $action)) {
                        $routes_name[] = $action['as'];
                    }
                }

                $view->with([
                    'admin_side_menu' => $admin_side_menu,
                    'routes_name' => $routes_name
                ]);
            });
        }

        if (!request()->is('admin/*')) {
            view()->composer('*', function ($view) {
        

                $view->with([
                  
                ]);
            });
        }
    }
}
