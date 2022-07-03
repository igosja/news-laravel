<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 */
class PostController extends AbstractController
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
        $query = Post::query();
        if ($request->query('id')) {
            $query->where('id', $request->query('id'));
        }
        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $posts = $query
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('admin.post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $post = new Post();
        $post->category_id = $data['category_id'];
        $post->created_by = Auth::id();
        $post->name = $data['name'];
        $post->translation_title = $data['translation_title'];
        $post->translation_text = $data['translation_text'];
        $post->is_active = $data['is_active'];
        $post->url = $data['url'];
        $post->updated_by = Auth::id();
        if (!$post->save()) {
            return back();
        }

        if (!$post->url) {
            $post->url = $post->id . '-' . Str::slug($post->name);
            $post->save();
        }

        return redirect()->route('post.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::query()->get();
        $languages = Language::query()->get();

        return view('admin.post.create', [
            'categories' => $categories,
            'languages' => $languages,
        ]);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post): View|Factory|Application
    {
        $languages = Language::query()->get();

        return view('admin.post.show', [
            'post' => $post,
            'languages' => $languages,
        ]);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post): View|Factory|Application
    {
        $categories = Category::query()->get();
        $languages = Language::query()->get();

        return view('admin.post.edit', [
            'categories' => $categories,
            'languages' => $languages,
            'post' => $post,
        ]);
    }

    /**
     * @param \App\Http\Requests\PostUpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        if ($request->file('image')) {
            print '<pre>';
            print_r($request->file('image'));
            exit;
        }

        $post->category_id = $data['category_id'];
        $post->created_by = Auth::id();
        $post->name = $data['name'];
        $post->translation_title = $data['translation_title'];
        $post->translation_text = $data['translation_text'];
        $post->is_active = $data['is_active'];
        $post->url = $data['url'];
        $post->updated_by = Auth::id();
        if (!$post->save()) {
            return back();
        }

        if (!$post->url) {
            $post->url = $post->id . '-' . Str::slug($post->name);
            $post->save();
        }

        return redirect()->route('post.index');
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('post.index');
    }
}
