<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/18
 * Time: 14:19
 */

namespace App\Providers;

use Illuminate\View\ViewServiceProvider as LaravelViewServiceProvider;
use Lufficc\View\FileViewFinder;

class ViewServiceProvider extends LaravelViewServiceProvider
{
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            return new FileViewFinder($app['files'], $app['config']['view.paths']);
        });
    }
}