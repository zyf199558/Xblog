<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/18
 * Time: 15:52
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\ThemeService;
use Chumper\Zipper\Facades\Zipper;
use File;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    protected $themeService;

    /**
     * ThemeController constructor.
     * @param ThemeService $themeService
     */
    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    public function destroy($name)
    {
        if (!$this->themeService->exists($name)) {
            return back()->withErrors("Theme $name not exists!");
        }
        if (!$this->themeService->delete($name))
            return back()->withErrors('Delete failed');
        return back()->with('success', 'Delete successfully');
    }

    public function change($name)
    {
        if (!$this->themeService->exists($name)) {
            return back()->withErrors("Theme $name not exists!");
        }
        if (!$this->themeService->setTheme($name))
            return back()->withErrors('Change failed');
        return back()->with('success', 'Changed successfully');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'theme' => 'required|file '
        ]);
        $themeFile = $request->file('theme');
        $zipper = Zipper::make($themeFile->getRealPath());
        foreach ($zipper->listFiles('/\.json/i') as $path) {
            $content = $zipper->getFileContent($path);
            if ($content) {
                $theme = json_decode($content);
                if ($theme && $theme->name) {
                    if (!starts_with($path, $theme->name)) {
                        return back()->withErrors('Theme folder name must be same as theme name');
                    }
                }
                break;
            }
        }
        if (isset($theme) && !$theme) {
            return back()->withErrors('Invalid theme');
        }

        if (File::exists(base_path('themes/' . $theme->name))) {
            return back()->withErrors(" $theme->display_name already existed!");
        }

        Zipper::make($themeFile->getRealPath())->extractTo(base_path('themes'));
        return back()->with('success', "Upload $theme->display_name successfully!");
    }

}