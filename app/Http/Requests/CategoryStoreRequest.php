<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryStoreRequest
 * @package App\Http\Requests
 */
class CategoryStoreRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:255'],
            'translation' => ['required'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
