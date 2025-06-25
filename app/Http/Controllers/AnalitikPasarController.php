<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsModel;
use App\Models\PolylinesModel;
use App\Models\PolygonsModel;
use App\Models\Vote;

class AnalitikPasarController extends Controller
{
    public function index()
    {
        $points = PointsModel::all();
        $polylines = PolylinesModel::all();
        $polygons = PolygonsModel::all();

        $kategoriStats = collect($points)
            ->merge($polylines)
            ->merge($polygons)
            ->groupBy('description')
            ->map->count();

        $rekomendasi = collect($points)
            ->merge($polylines)
            ->merge($polygons)
            ->groupBy('name')
            ->map(function ($items, $key) {
                return ['nama' => $key, 'vote' => $items->count()];
            })->sortByDesc('vote')->values();

        return view('analitik', compact('points', 'polylines', 'polygons', 'kategoriStats', 'rekomendasi'))
            ->with('title', 'Dashboard Analitik Pasar');
    }

    public function voteKategori(Request $request)
    {
        $kategori = $request->input('kategori');
        $nama = $request->input('nama');

        if (!$kategori || !$nama) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap.'
            ]);
        }

        $vote = \App\Models\Vote::firstOrCreate([
            'nama' => $nama,
            'kategori' => $kategori,
        ]);

        $vote->increment('jumlah');

        return response()->json([
            'success' => true,
            'kategori' => $kategori,
            'nama' => $nama,
            'newVoteCount' => $vote->jumlah
        ]);
    }


    public function getRekapPerPasar()
    {
        // Ambil semua nama pasar dari tabel points
        $namaPointTersedia = PointsModel::pluck('name')->toArray();

        // Filter data vote agar hanya yang namanya ada di points
        $rekap = Vote::whereIn('nama', $namaPointTersedia)
            ->select('nama', 'kategori', 'jumlah')
            ->orderBy('nama')
            ->orderByDesc('jumlah')
            ->get()
            ->groupBy('nama');

        return response()->json($rekap);
    }

    public function resetVote(Request $request)
    {
        $nama = $request->input('nama');

        if (!$nama) {
            return response()->json([
                'success' => false,
                'message' => 'Nama pasar tidak valid.'
            ]);
        }

        Vote::where('nama', $nama)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vote untuk pasar direset.',
            'nama' => $nama
        ]);
    }
}
