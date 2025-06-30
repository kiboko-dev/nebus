<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property string $id
 * @property mixed $name
 * @property mixed $phone
 * @property mixed $building
 * @property mixed $activityType
 */
class Organization extends Model
{
    use HasUuids, HasFactory, SoftDeletes, HasSlug;
    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'slug',
        'building_id',
        'phone',
        'activity_type_id',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function activityType(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class);
    }
}
