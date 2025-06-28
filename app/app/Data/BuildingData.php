<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class BuildingData extends Data
{
    public function __construct(
        public string $id,
        public string $address,
        public float $latitude,
        public float $longitude,
    ) {}
}
