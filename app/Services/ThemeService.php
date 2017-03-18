<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/18
 * Time: 15:14
 */

namespace App\Services;


use App\Facades\XblogConfig;
use File;
use Illuminate\Support\Collection;

class ThemeService
{
    protected $themes = null;
    protected $currentTheme = null;

    /**
     * @return Collection
     */
    public function getThemes()
    {
        if ($this->themes != null)
            return $this->themes;
        $this->themes = new Collection();
        $themeDirections = File::directories(base_path('themes' . DIRECTORY_SEPARATOR));
        foreach ($themeDirections as $themeDirection) {
            $theme = json_decode((File::get($themeDirection . DIRECTORY_SEPARATOR . 'theme.json')));
            $this->themes->push($theme);
        }
        return $this->themes;
    }

    public function getCurrentTheme()
    {
        if ($this->currentTheme != null)
            return $this->currentTheme;
        $themeDirection = $this->getThemePath(get_config('theme', 'xblog'));
        return $this->currentTheme = json_decode((File::get($themeDirection . DIRECTORY_SEPARATOR . 'theme.json')));
    }

    private function getThemePath($themeName = null)
    {
        if ($themeName == null)
            $themeName = $this->getCurrentTheme()->name;
        return base_path('themes' . DIRECTORY_SEPARATOR . $themeName . DIRECTORY_SEPARATOR);
    }

    public function getThemeResourcesPath($themeName)
    {
        return $this->getThemePath($themeName) . 'resources';
    }

    public function getThemePublicPath($path = '', $themeName = null)
    {
        if ($themeName == null)
            $themeName = $this->getCurrentTheme()->name;
        return public_path($themeName . DIRECTORY_SEPARATOR . $path);
    }

    public function deleteThemePublicPath($themeName = null)
    {
        if ($themeName == null)
            $themeName = $this->getCurrentTheme()->name;
        $path = $this->getThemePublicPath('', $themeName);
        return !File::exists($path) || File::deleteDirectory($path);
    }

    public function exists($themeName)
    {
        return File::exists($this->getThemePath($themeName));
    }

    public function delete($themeName)
    {
        if ($themeName == 'xblog' || $this->getCurrentTheme()->name == $themeName || !$this->exists($themeName))
            return false;
        $path = $this->getThemePath($themeName);
        return $this->deleteThemePublicPath($themeName) && File::deleteDirectory($path);
    }

    public function setTheme($themeName)
    {
        if (!$this->exists($themeName))
            return false;
        $result = true;
        if (File::exists($this->getThemeResourcesPath($themeName))) {
            $result = $this->deleteThemePublicPath() && File::copyDirectory(
                    $this->getThemeResourcesPath($themeName),
                    $this->getThemePublicPath('', $themeName));
        }
        return $result && (bool)XblogConfig::saveSetting('theme', $themeName);
    }
}