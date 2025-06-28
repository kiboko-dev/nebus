<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BuildingData extends Data
{
    public function __construct(
        public string $address,
        public float $latitude,
        public float $longitude,
    ) {}
}
