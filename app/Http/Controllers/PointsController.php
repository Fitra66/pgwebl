<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsModel;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
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
            'name' => 'required|string|max:255|unique:points,name', // Pastikan 'name' tidak kosong dan unik
            'description' => 'required|string', // 'description' boleh kosong
            'geom_point' => 'required|string', // Pastikan 'geom_point' tidak kosong
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ],
        [
            'name.required' => 'Nama perlu diisi', // Pesan kesalahan jika 'name' tidak diisi
            'name.unique' => 'Nama sudah ada', // Pesan kesalahan jika 'name' sudah ada
            'description.required' => 'Deskripsi perlu diisi',
            'geom_point.required' => 'Geometry perlu diisi' // Pesan kesalahan jika 'geom_point' tidak diisi
        ]);

        // Create image direktory if not exists
        if (!file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0777, true);
        }

        // Upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        // Create data
        $this->points->create($data);

        // Redirect ke peta dengan pesan sukses
        return redirect()->route('map')->with('success', 'Point has been added successfully.');
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
        $data = [
            'title' => 'Edit Point',
            'id' => $id,
        ];

        return view ('edit-point', $data);
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
    $imagefile = $this->points->find($id)->image;

    if (!$this->points->destroy($id)) {
        return redirect()->route('map')->with('error', 'Point failed to delete');
    }

    if ($imagefile != null) {
        $imagePath = public_path('storage/images/' . $imagefile);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    return redirect()->route('map')->with('success', 'Point successfully deleted');
}

}
