<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolygonsModel;

class PolygonsController extends Controller
{
    public function __construct()
    {
        $this->polygons = new PolygonsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map',
        ];
        return view('map', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:polygons,name', // Pastikan 'name' tidak kosong dan unik
            'description' => 'required|string', // 'description' boleh kosong
            'geom_polygon' => 'required|string', // Pastikan 'geom_polyline' tidak kosong
        ],
        [
            'name.required' => 'Nama perlu diisi',
            'name.unique' => 'Nama sudah ada',
            'description.required' => 'Deskripsi perlu diisi',
            'geom_polygon.required' => 'Geometry perlu diisi'
        ]);

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Create data
        $this->polygons->create($data);

        // Redirect ke peta dengan pesan sukses
        return redirect()->route('map')->with('success', 'Polygon has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
