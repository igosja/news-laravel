<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return Category::query()
            ->where('is_active', true)
            ->paginate(10);
    }

    /**
     * @param \App\Models\Category $category
     * @return \App\Models\Category
     */
    public function show(Category $category): Category
    {
        return $category;
    }
}
