<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostStoreRequest
 * @package App\Http\Requests
 */
class PostUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        /**
         * @var \Illuminate\Routing\Route $route
         */
        $route = $this->route();
        return [
            'name' => ['required', 'max:255'],
            'url' => ['unique:posts,url,' . $route->parameter('post')->id, 'max:255'],
            'category_id' => ['required'],
            'translation_text' => ['required'],
            'translation_title' => ['required'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
