<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Post
 * @package App\Models
 *
 * @property int $id
 * @property int $category_id
 * @property int $created_by
 * @property int $image_id
 * @property bool $is_active
 * @property string $name
 * @property array $translation_text
 * @property array $translation_title
 * @property int $updated_by
 * @property int $url
 * @property int $views
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'translation_text' => 'array',
        'translation_title' => 'array',
    ];

    /**
     * @return int
     */
    public function totalRating(): int
    {
        $result = 0;
        foreach ($this->rating()->get() as $rating) {
            $result += $rating->value;
        }
        return $result;
    }

    /**
     * @return bool|null
     */
    public function delete(): ?bool
    {
        if ($this->image_id) {
            $this->image()->first()?->delete();
        }
        return parent::delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rating(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
