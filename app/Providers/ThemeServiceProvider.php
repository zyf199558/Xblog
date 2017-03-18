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

    public function getThemes()
    {
        $themes = File::directories(base_path('themes/'));
        foreach ($themes as $theme) {
            $themeObj = json_decode((File::get($theme . '/theme.json')));
            echo $themeObj->name . "\n";
            echo $themeObj->description . "\n";
            echo $themeObj->namespace_suffix . "\n";
        }
    }

    public function map()
    {
        $theme = get_config('theme', 'xblog');
        $themeDir = base_path('themes\\' . $theme);
        $themeObj = json_decode((File::get($themeDir . '/theme.json')));
        $namespace = "Themes\\$themeObj->namespace_suffix\\Controllers";
        $routes = $themeDir . '\\routes.php';
        $views = $themeDir . '\\views';
        View::addNameSpace($theme, $views);
        Route::group([
            'middleware' => 'web',
            'namespace' => $namespace,
        ], function ($router) use ($routes) {
            require $routes;
        });
    }
}
