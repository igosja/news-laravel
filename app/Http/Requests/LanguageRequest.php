<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LanguageRequest
 * @package App\Http\Requests
 */
class LanguageRequest extends FormRequest
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
            'code' => ['required', 'unique:languages,code,' . $this->route()->parameter('language'), 'max:255'],
            'name' => ['required', 'unique:languages,name,' . $this->route()->parameter('language'), 'max:255'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
