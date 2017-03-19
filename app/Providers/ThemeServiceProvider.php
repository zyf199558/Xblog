<?php

namespace App\Providers;

use File;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Lang;
use Route;
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
        $routes_exists = File::exists($routes);
        $use_default_route = isset($themeObject->use_default_route) && $themeObject->use_default_route;
        if (!$routes_exists || $use_default_route) {
            $this->mapDefault();
        }
        if ($routes_exists) {
            $this->mapTheme($namespace, $routes);
        }
        $views = $themeDirection . DIRECTORY_SEPARATOR . 'views';
        View::addNameSpace($themeObject->name, $views);
        Lang::addNamespace($themeObject->name, $themeDirection . 'lang');

    }

    public function mapDefault()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => 'App\Http\Controllers',
        ], function ($router) {
            require base_path('routes/xblog.php');
        });
    }

    public function mapTheme($namespace, $routes)
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $namespace,
        ], function ($router) use ($routes) {
            require $routes;
        });
    }
}
