<?php
declare(strict_types=1);

namespace App\Helpers;

use App\Models\Image;
use App\Services\ResizeImageService;

/**
 * Class ImageHelper
 * @package common\helpers
 */
class ImageHelper
{
    /**
     * <img src="<?= ImageHelper()::resize($image, $width, $height); ?>">
     *
     * @param int $width
     * @param int $height
     * @return string
     */
    public static function resize(Image $image, int $width, int $height): string
    {
        return (new ResizeImageService)->execute($image, $width, $height);
    }

    /**
     * @return array
     */
    public static function generatePath(): array
    {
        $path = [];
        $path[] = substr(md5(uniqid((string)mt_rand(), true)), -10);
        $path[] = substr(md5(uniqid((string)mt_rand(), true)), -10);
        $path[] = substr(md5(uniqid((string)mt_rand(), true)), -10);

        return $path;
    }
}
