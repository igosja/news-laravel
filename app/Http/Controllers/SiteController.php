<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class SiteController extends AbstractController
{
    /**
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function index(): Redirector|Application|RedirectResponse
    {
        return redirect('post');
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request): Redirector|RedirectResponse|Application
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('home');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage(Request $request): RedirectResponse
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
