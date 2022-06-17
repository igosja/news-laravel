<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

/**
 * Class SiteController
 * @package App\Http\Controllers\Admin
 */
class SiteController extends AbstractController
{
    /**
     * @return string
     */
    public function index(): string
    {
        return 'Admin';
    }
}
