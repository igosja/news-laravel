<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Language;

/**
 * Class LanguagesController
 * @package App\Http\Controllers\Admin
 */
class LanguageController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Language::query()
            ->paginate(10);
    }

    /**
     * @param \App\Models\Language $language
     * @return \App\Models\Language
     */
    public function show(Language $language): Language
    {
        return $language;
    }
}
