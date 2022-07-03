<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App\Models
 *
 * @property int $id
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 */
class Image extends Model
{
    use HasFactory;
}
