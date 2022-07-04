<?php
declare(strict_types=1);

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Models\Image;
use App\Models\Resize;
use RuntimeException;

/**
 * Class ResizeImageService
 * @package common\services
 */
class ResizeImageService
{
    /**
     * @var int $height
     */
    private int $height;

    /**
     * @var \App\Models\Image|null
     */
    private ?Image $image;

    /**
     * @var \App\Models\Resize|null
     */
    private ?Resize $resize = null;

    /**
     * @var int $width
     */
    private int $width;

    /**
     * @param \App\Models\Image $image
     * @param int $width
     * @param int $height
     * @return string
     */
    public function execute(Image $image, int $width, int $height): string
    {
        $this->image = $image;
        $this->height = $height;
        $this->width = $width;

        $this->loadResize();
        if ($this->resize) {
            return $this->resize->path;
        }

        $size_h = $this->height;
        $size_w = $this->width;

        $image_path = public_path('uploads') . '/' . $this->image->path;
        $image_info = getimagesize($image_path);

        [$image_width, $image_height] = $image_info;

        $h_coefficient = $size_h / $image_height;
        $w_coefficient = $size_w / $image_width;

        if ($h_coefficient > $w_coefficient) {
            $size_w_new = $image_width * $h_coefficient;
            $size_h_new = $size_h;
        } else {
            $size_h_new = $image_height * $w_coefficient;
            $size_w_new = $size_w;
        }

        if ($image_info[2] === IMAGETYPE_JPEG) {
            $src = imagecreatefromjpeg($image_path);
        } elseif ($image_info[2] === IMAGETYPE_GIF) {
            $src = imagecreatefromgif($image_path);
        } else {
            $src = imagecreatefrompng($image_path);
        }

        $im = imagecreatetruecolor($size_w, $size_h);
        $back = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $back);

        $file_name = substr(md5(uniqid('', true)), -20) . '.jpg';

        $path = ImageHelper::generatePath();

        $upload_dir = public_path('uploads') . '/' . implode('/', $path);

        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true) && !is_dir($upload_dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $upload_dir));
        }

        $file_url = $upload_dir . '/' . $file_name;

        $offset_x = ($size_w_new - $size_w) / $h_coefficient / 2;

        if (0 > $offset_x) {
            $offset_x = -$offset_x;
        }

        $offset_y = ($size_h_new - $size_h) / $w_coefficient / 2;

        if (0 > $offset_y) {
            $offset_y = -$offset_y;
        }

        imagecopyresampled($im, $src, 0, 0, (int)$offset_x, (int)$offset_y, (int)$size_w_new, (int)$size_h_new, imagesx($src), imagesy($src));

        if (imagejpeg($im, $file_url, 100)) {
            chmod($file_url, 0777);
        }

        imagedestroy($im);

        $file_path = str_replace(public_path('uploads') . '/', '', $file_url);
        $this->saveResize($file_path);

        return $file_path;
    }

    /**
     * @return void
     */
    private function loadResize(): void
    {
        $this->resize = Resize::query()
            ->where('height', $this->height)
            ->where('image_id', $this->image->id)
            ->where('width', $this->width)
            ->first();
    }

    /**
     * @param string $file_url
     * @return void
     */
    private function saveResize(string $file_url): void
    {
        $this->resize = new Resize();
        $this->resize->height = $this->height;
        $this->resize->image_id = $this->image->id;
        $this->resize->path = $file_url;
        $this->resize->width = $this->width;
        $this->resize->save();
    }
}