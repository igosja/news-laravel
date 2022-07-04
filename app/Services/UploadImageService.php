<?php
declare(strict_types=1);

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use RuntimeException;

/**
 * Class UploadImageService
 * @package App\Services
 */
class UploadImageService
{
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return \App\Models\Image
     */
    public static function upload(UploadedFile $file, string $directory): Image
    {
        $file_name = substr(md5(uniqid('', true)), -20) . '.' . $file->guessExtension();
        $path = ImageHelper::generatePath();
        $upload_dir = $directory . '/' . implode('/', $path);
        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true) && !is_dir($upload_dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $upload_dir));
        }

        $upload_url = $upload_dir . '/' . $file_name;
        $file_url = implode('/', $path) . '/' . $file_name;
        if ($file->move($upload_dir, $file_name)) {
            chmod($upload_url, 0777);
        }

        $image = new Image();
        $image->path = $file_url;
        $image->save();

        return $image;
    }
}