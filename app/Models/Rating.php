<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rating
 * @package App\Models
 *
 * @property int $id
 * @property int $created_by
 * @property int $post_id
 * @property int $updated_by
 * @property int $value
 * @property string $created_at
 * @property string $updated_at
 */
class Rating extends Model
{
    use HasFactory;
}
