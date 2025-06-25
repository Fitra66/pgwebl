@extends('layouts.template')
@section('styles')
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="text-white display-5 fw-light" style="letter-spacing: 2px;">FITUR UNGGULAN APLIKASI</h1>
            <p class="text-white-50 fs-5">Temukan keunggulan aplikasi kami melalui fitur-fitur canggih dan fungsional</p>
        </div>

        <div class="container">
            <h2 class="text-center text-white mb-5">Fitur Aplikasi Kami</h2>
            <div class="row g-4 justify-content-center">
                <!-- Card Template -->
                @php
                    $fitur = [
                        [
                            'img' => 'fitur1.png',
                            'title' => 'Fitur Manajemen',
                            'desc' => 'Mengelola data cetak, fotokopi, dan transaksi dengan efisien dan real-time.',
                        ],
                        [
                            'img' => 'fitur2.png',
                            'title' => 'Integrasi Geo',
                            'desc' => 'Menampilkan lokasi pasar atau layanan dengan peta interaktif berbasis Leaflet.',
                        ],
                        [
                            'img' => 'fitur3.png',
                            'title' => 'Statistik & Voting',
                            'desc' =>
                                'Menampilkan data voting dan grafik statistik interaktif untuk analisis pengguna.',
                        ],
                    ];
                @endphp

                @foreach ($fitur as $item)
                    <div class="col-md-4 col-sm-6">
                        <div class="card card-hover bg-light shadow-lg border-0 rounded-4 h-100">
                            <img src="{{ asset('storage/image/' . $item['img']) }}"
                                class="card-img-top rounded-top-4 img-fluid" alt="{{ $item['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['title'] }}</h5>
                                <p class="card-text text-muted">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
