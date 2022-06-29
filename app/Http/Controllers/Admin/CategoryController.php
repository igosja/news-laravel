<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends AbstractController
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
        $query = Category::query();
        if ($request->query('id')) {
            $query->where('id', $request->query('id'));
        }
        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $categories = $query
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param \App\Http\Requests\CategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $category = new Category();
        if (!$category->create($data)) {
            return back();
        }

        return redirect()->route('category.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): View|Factory|Application
    {
        $languages = Language::query()->get();
        return view('admin.category.create', [
            'languages' => $languages,
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Category $category): View|Factory|Application
    {
        $languages = Language::query()->get();

        return view('admin.category.show', [
            'category' => $category,
            'languages' => $languages,
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category): View|Factory|Application
    {
        $languages = Language::query()->get();

        return view('admin.category.edit', [
            'category' => $category,
            'languages' => $languages,
        ]);
    }

    /**
     * @param \App\Http\Requests\CategoryUpdateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        if (!$category->update($data)) {
            return back();
        }

        return redirect()->route('category.index');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}
