<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): View|Factory|Application
    {
        $sort = $request->query('sort', 'id');
        $order = 'ASC';
        if ('-' === $sort[0]) {
            $order = 'DESC';
            $sort = substr($sort, 1);
        }
        $query = Language::query();
        if ($request->query('id')) {
            $query->where('id', $request->query('id'));
        }
        if ($request->query('code')) {
            $query->where('code', 'like', '%' . $request->query('code') . '%');
        }
        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $languages = $query
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('admin.language.index', [
            'languages' => $languages,
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
     * @param \App\Http\Requests\LanguageStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LanguageStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

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
     * @param \App\Http\Requests\LanguageUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LanguageUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

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
