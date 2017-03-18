<?php

namespace App\Providers;

use File;
use Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use View;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
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

    public function map()
    {
        $themeObject = get_current_theme();
        $themeDirection = get_theme_path($themeObject->name);
        $namespace = "Themes\\" . $themeObject->namespace_suffix . '\\Controllers';
        $routes = $themeDirection . DIRECTORY_SEPARATOR . 'routes.php';
        $views = $themeDirection . DIRECTORY_SEPARATOR . 'views';
        View::addNameSpace($themeObject->name, $views);
        Route::group([
            'middleware' => 'web',
            'namespace' => $namespace,
        ], function ($router) use ($routes) {
            require $routes;
        });
    }
}
