<?php

namespace App\Http\Repositories;

use App\Data\BuildingData;
use App\Models\Building;
use Illuminate\Support\Collection;

class BuildingRepository
{
    public function index(): Collection|array
    {
        return BuildingData::collect(Building::all()->toArray());
    }

    public function getWithOrganizations(string $buildingId): BuildingData
    {
        return BuildingData::fromModel(
            building: Building::query()->with('organizations')->findOrFail($buildingId),
            with: ['organizations']
        );
    }

    public function geoSearch(array $query): ?array
    {
        if ($query['type'] === 'point') {
            $lat = (float)$query['point']['lat'];
            $lng = (float)$query['point']['lng'];
            $radius = (float)$query['radius'] / 1000;


            $buildings = Building::withinApproximateDistance($lat, $lng, $radius)
                ->get()
                ->map(function ($building) use ($lat, $lng) {
                    $building->distance = $this->calculateDistance(
                        $lat, $lng,
                        $building->latitude, $building->longitude
                    );
                    return $building;
                })
                ->filter(function ($building) use ($radius) {
                    return $building->distance <= $radius;
                })
                ->sortBy('distance')
                ->values();

            return [
                'search_center' => ['lat' => $lat, 'lng' => $lng],
                'search_radius_m' => $radius,
                'found_count' => $buildings->count(),
                'buildings' => $buildings->map(function ($building) {
                    return [
                        'id' => $building->id,
                        'address' => $building->address,
                        'latitude' => $building->latitude,
                        'longitude' => $building->longitude,
                        'distance_km' => round($building->distance, 3),
                        'distance_m' => round($building->distance * 1000),
                    ];
                })
            ];
        } elseif ($query['type'] === 'polygon') {

            $polygonPoints = $query['polygon'];

            if ($polygonPoints[0] != end($polygonPoints)) {
                $polygonPoints[] = $polygonPoints[0];
            }

            $wktPoints = array_map(function ($point) {
                return $point['lng'] . ' ' . $point['lat'];
            }, $polygonPoints);

            $wkt = 'POLYGON((' . implode(', ', $wktPoints) . '))';

            $buildings = Building::whereRaw(
                "ST_Within(POINT(longitude, latitude), ST_GeomFromText(?))",
                [$wkt]
            )->get();

            return [
                'entered_points' => $polygonPoints,
                'found_count' => $buildings->count(),
                'buildings' => BuildingData::collect($buildings)
            ];
        } else {
            $rectangle = $query['rectangle'];
            $ltpLat = $rectangle['ltp']['lat'];
            $ltpLng = $rectangle['ltp']['lng'];
            $rbpLat = $rectangle['rbp']['lat'];
            $rbpLng = $rectangle['rbp']['lng'];

            if ($ltpLat <= $rbpLat) {
                return [
                    'error' => 'Invalid coordinates',
                    'message' => 'Top-left latitude must be greater than bottom-right latitude'
                ];
            }

            if ($ltpLng >= $rbpLng) {
                return [
                    'error' => 'Invalid coordinates',
                    'message' => 'Top-left longitude must be less than bottom-right longitude'
                ];
            }

            $buildings = Building::whereBetween('latitude', [$rbpLat, $ltpLat])
                ->whereBetween('longitude', [$ltpLng, $rbpLng])
                ->get();

            return [
                'entered_points' => [
                    $rectangle['ltp'],
                    $rectangle['rbp'],
                ],
                'found_count' => $buildings->count(),
                'buildings' => BuildingData::collect($buildings)
            ];
        }
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2): float
    {
        $earthRadius = 6371; // Радиус Земли в км

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
