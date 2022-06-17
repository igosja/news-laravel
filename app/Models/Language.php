<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 * @package App\Models
 *
 * @property int $id
 * @property string $code
 * @property bool $is_active
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Language extends Model
{
    use HasFactory;
}
