<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/18
 * Time: 14:17
 */

namespace Lufficc\View;

use Illuminate\View\FileViewFinder as LaravelFileViewFinder;

class FileViewFinder extends LaravelFileViewFinder
{
    public function find($name)
    {
        if (isset($this->views[$name])) {
            return $this->views[$name];
        }

        if ($this->hasHintInformation($name = trim($name))) {
            return $this->views[$name] = $this->findNamespacedView($name);
        }

        if (!starts_with($name, 'admin')) {
            $themeNamespace = get_config('theme', 'xblog');
            if ($themeNamespace) {
                foreach ($this->hints[$themeNamespace] as $path) {
                    foreach ($this->getPossibleViewFiles($name) as $file) {
                        if ($this->files->exists($viewPath = $path . '/' . $file)) {
                            return $this->views[$name] = $viewPath;
                        }
                    }
                }
            }
        }
        return $this->views[$name] = $this->findInPaths($name, $this->paths);
    }
}