<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolylinesModel extends Model
{
    protected $table = 'polylines';

    protected $guarded = ['id'];

    public function geojson_polylines()
    {
        $polylines = $this
            ->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, ST_Length(geom::geography) as length_m, ST_Length(geom::geography)/1000 as length_km, created_at, updated_at'))
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $polyline) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($polyline->geom),
                'properties' => [
                    'id' => $polyline->id,
                    'name' => $polyline->name,
                    'description' => $polyline->description,
                    'length_m' => $polyline->length_m, // Panjang dalam meter
                    'length_km' => $polyline->length_km, // Panjang dalam kilometer
                    'created_at' => $polyline->created_at,
                    'updated_at' => $polyline->updated_at,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

}
