<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LanguagesController
 * @package App\Http\Controllers\Admin
 */
class LanguageController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
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
