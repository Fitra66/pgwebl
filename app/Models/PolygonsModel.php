<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['id'];

    public function geojson_polygons()
    {
            $polygons = $this
                ->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, ST_Area(geom::geography) as luas_m2, ST_Area(geom::geography)/10000 as luas_hektar, name, description, created_at, updated_at'))
                ->get();

            $geojson = [
                'type' => 'FeatureCollection',
                'features' => [],
            ];

            foreach ($polygons as $polygon) {
                $feature = [
                    'type' => 'Feature',
                    'geometry' => json_decode($polygon->geom),
                    'properties' => [
                        'id' => $polygon->id,
                        'name' => $polygon->name,
                        'description' => $polygon->description,
                        'luas_m2' => $polygon->luas_m2, // Luas dalam meter persegi
                        'luas_hektar' => $polygon->luas_hektar, // Luas dalam hektar
                        'created_at' => $polygon->created_at,
                        'updated_at' => $polygon->updated_at,
                    ],
                ];

                array_push($geojson['features'], $feature);
            }

            return $geojson;
        }
    }
