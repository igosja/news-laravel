<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property bool $is_active
 * @property string $name
 * @property array $translation
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{
    use HasFactory;

    protected $casts = [
        'translation' => 'array'
    ];

    protected $fillable = ['name', 'translation', 'is_active'];
}
