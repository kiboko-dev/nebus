<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int $id
 * @property string $name
 * @property ?array $organizations
 * @property self $parent
 */
class ActivityType extends Model
{
    use SoftDeletes, HasFactory, HasSlug;
    protected $table = 'activity_types';

    protected $fillable = [
        'name', 'slug', 'parent_id', 'level'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(ActivityType::class, 'parent_id');
    }

    public function children(): HasMany {
        return $this->hasMany(ActivityType::class, 'parent_id');
    }
}
