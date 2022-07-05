<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Post;

/**
 * Class PostsController
 * @package App\Http\Controllers\Admin
 */
class PostController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Post::query()
            ->with(['image'])
            ->paginate(10);
    }

    /**
     * @param \App\Models\Post $post
     * @return \App\Models\Post
     */
    public function show(Post $post): Post
    {
        return $post;
    }
}
