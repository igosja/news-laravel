<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $languages = Language::query()
            ->where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();
        $availableLanguages = [];
        foreach ($languages as $language) {
            $availableLanguages[] = $language->code;
        }

        View::share('availableLanguages', $availableLanguages);
    }
}
