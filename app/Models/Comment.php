<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App\Models
 *
 * @property int $id
 * @property int $created_by
 * @property int $language_id
 * @property int $post_id
 * @property string $text
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends Model
{
    use HasFactory;
}
