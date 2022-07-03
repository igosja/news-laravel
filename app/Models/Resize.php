<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resize
 * @package App\Models
 *
 * @property int $id
 * @property int $height
 * @property int $image_id
 * @property string $path
 * @property int $width
 * @property string $created_at
 * @property string $updated_at
 */
class Resize extends Model
{
    use HasFactory;
}
