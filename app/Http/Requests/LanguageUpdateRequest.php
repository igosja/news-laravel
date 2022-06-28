<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LanguageUpdateRequest
 * @package App\Http\Requests
 */
class LanguageUpdateRequest extends FormRequest
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
            'code' => ['required', 'unique:languages,code,' . $route->parameter('language'), 'max:255'],
            'name' => ['required', 'unique:languages,name,' . $route->parameter('language'), 'max:255'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
