<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * Class SiteController
 * @package App\Http\Controllers\Admin
 */
class SiteController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View|Factory|Application
    {
        return view('admin.site.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage(Request $request)
    {
        if ($request->get('language')) {
            $requestLanguage = $request->get('language');

            $language = Language::query()
                ->where('is_active', true)
                ->where('code', $requestLanguage)
                ->first();
            if ($language) {
                App::setLocale($language->code);
                Session::put('locale', $language->code);
            }
        }
        return redirect()->back();
    }
}
