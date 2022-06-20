<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class LanguagesController
 * @package App\Http\Controllers\Admin
 */
class LanguageController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.language.index', [
            'languages' => Language::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.language.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'is_active' => ['required'],
        ]);

        $language = new Language();
        $language->code = $data['code'];
        $language->name = $data['name'];
        $language->is_active = $data['is_active'];
        if (!$language->save()) {
            return back();
        }

        return redirect()->route('language.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id): View|Factory|Application
    {
        $language = Language::find($id);

        return view('admin.language.show', [
            'language' => $language,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id): View|Factory|Application
    {
        $language = Language::find($id);

        return view('admin.language.edit', [
            'language' => $language,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'is_active' => ['required'],
        ]);

        $language = Language::find($id);
        $language->code = $data['code'];
        $language->name = $data['name'];
        $language->is_active = $data['is_active'];
        if (!$language->save()) {
            return back();
        }

        return redirect()->route('language.index');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        /**
         * @var Language $language
         */
        $language = Language::find($id);
        $language->delete();

        return redirect()->route('language.index');
    }
}
