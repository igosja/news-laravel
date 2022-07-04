<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Language;
use App\Models\Post;
use App\Models\Rating;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends AbstractController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): View|Factory|Application
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->get();

        $language = Language::query()
            ->where('code', App::getLocale())
            ->first();

        $query = Post::query()
            ->with(['createdBy', 'image', 'comment' => function ($query) use ($language) {
                $query->where('language_id', $language->id);
            }])
            ->where('is_active', true);
        if ($request->get('category')) {
            $query->where('category_id', $request->get('category'));
        }
        $posts = $query->orderBy('id', 'DESC')
            ->get();

        return view('post.index', [
            'categories' => $categories,
            'language' => $language,
            'posts' => $posts,
        ]);
    }

    /**
     * @param string $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $url): View|Factory|Application
    {
        $post = Post::query()
            ->where('url', $url)
            ->first();

        $post->increment('views');

        $language = Language::query()
            ->where('code', App::getLocale())
            ->first();
        $comments = Comment::query()
            ->where('post_id', $post->id)
            ->where('language_id', $language->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('post.show', [
            'comments' => $comments,
            'language' => $language,
            'post' => $post,
        ]);
    }

    /**
     * @param \App\Models\Post $post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rating(Post $post, Request $request)
    {
        $value = (int)$request->get('value');
        if (!in_array($value, [1, -1], true)) {
            return back();
        }

        $rating = Rating::query()
            ->where('post_id', $post->id)
            ->where('created_by', Auth::id())
            ->first();
        if (!$rating) {
            $rating = new Rating();
            $rating->created_by = Auth::id();
            $rating->post_id = $post->id;
        }
        $rating->updated_by = Auth::id();
        $rating->value = $value;
        $rating->save();

        return back();
    }

    /**
     * @param \App\Models\Post $post
     * @param \App\Http\Requests\CommentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(Post $post, CommentStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $language = Language::query()
            ->where('code', App::getLocale())
            ->first();

        $comment = new Comment();
        $comment->text = $data['text'];
        $comment->created_by = Auth::id();
        $comment->updated_by = Auth::id();
        $comment->post_id = $post->id;
        $comment->language_id = $language->id;
        $comment->save();

        return back();
    }
}
