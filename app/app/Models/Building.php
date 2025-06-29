<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 * @property ?array $organizations
 */
class Building extends Model
{
    use HasUuids, SoftDeletes, HasFactory;
    protected $table = 'buildings';

    protected $fillable = [
        'address',
        'latitude',
        'longitude',
    ];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
