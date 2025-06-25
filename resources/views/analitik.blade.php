@extends('layouts/template')

@section('styles')
    <style>
        .stats-box {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .stats-box h2 {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .btn-vote {
            cursor: pointer;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 0.5rem;
            border: none;
            background-color: #ffffff;
            color: #224abe;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-vote:hover {
            background-color: #d6d8db;
            transform: translateY(-2px);
        }

        canvas {
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.5));
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="stats-box mb-5">
            <h2 class="text-center">Statistik & Rekomendasi Pasar</h2>

            <!-- Diagram -->
            <div class="mt-5">
                <h4 class="text-white mb-3">Kategori untuk Masing-masing Pasar:</h4>
                <div class="chart-container">
                    <canvas id="chartPerPasar"></canvas>
                </div>
            </div>

            <!-- Voting -->
            <div class="mt-5">
                <h4 class="text-white mb-2">Kategori untuk Masing-masing Pasar:</h4>
                <ul class="text-white list-unstyled">
                    @foreach ($rekomendasi as $pasar)
                        <li class="mb-4">
                            <strong>{{ $pasar['nama'] }}</strong>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <button class="btn-vote" data-nama="{{ $pasar['nama'] }}" data-kategori="Paling Ramai">🔥
                                    Ramai</button>
                                <button class="btn-vote" data-nama="{{ $pasar['nama'] }}" data-kategori="Paling Murah">💸
                                    Murah</button>
                                <button class="btn-vote" data-nama="{{ $pasar['nama'] }}"
                                    data-kategori="Paling Sering Dikunjungi">👣 Dikunjungi</button>
                                <button class="btn-vote" data-nama="{{ $pasar['nama'] }}" data-kategori="Paling Besar">🏢
                                    Besar</button>
                                <button class="btn-vote" data-nama="{{ $pasar['nama'] }}" data-kategori="Paling Kecil">🧺
                                    Kecil</button>
                                <button class="btn btn-sm btn-danger ms-3 btn-reset-vote"
                                    data-nama="{{ $pasar['nama'] }}">Ulangi dari awal</button>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="text-end mb-3">
                <button class="btn btn-success fw-bold me-2" id="btnExportChartPNG">📸 Cetak Gambar Statistik</button>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        let chartPerPasarInstance = null;

        $(document).on('click', '.btn-vote', function() {
            const namaPasar = $(this).data('nama');
            const kategori = $(this).data('kategori');

            $.ajax({
                url: '{{ route('vote.kategori') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama: namaPasar,
                    kategori: kategori
                },
                success: function(response) {
                    if (response.success) {
                        fetchRekapPerPasar();
                    } else {
                        alert('Vote gagal: ' + response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan koneksi saat voting.');
                }
            });
        });

        function fetchRekapPerPasar() {
            $.get('{{ route('rekap.perpasar') }}', function(data) {
                const kategoriList = [...new Set(Object.values(data).flatMap(item => item.map(v => v.kategori)))];
                const pasarLabels = Object.keys(data);

                const colorPalette = [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                    '#858796', '#20c997', '#fd7e14', '#6f42c1', '#d63384'
                ];

                const datasets = kategoriList.map((kategori, i) => ({
                    label: kategori,
                    data: pasarLabels.map(pasar => {
                        const found = data[pasar].find(v => v.kategori === kategori);
                        return found ? found.jumlah : 0;
                    }),
                    backgroundColor: colorPalette[i % colorPalette.length],
                    borderRadius: 10,
                    barThickness: 25,
                    maxBarThickness: 40
                }));

                const ctx2 = document.getElementById('chartPerPasar').getContext('2d');

                if (chartPerPasarInstance) {
                    chartPerPasarInstance.destroy();
                }

                chartPerPasarInstance = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: pasarLabels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 800,
                            easing: 'easeOutQuart'
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Perbandingan Kategori Untuk Setiap Pasar',
                                color: '#ffffff',
                                font: {
                                    size: 20,
                                    weight: 'bold'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 20
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: '#333',
                                titleColor: '#fff',
                                bodyColor: '#fff'
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#ffffff',
                                    boxWidth: 12,
                                    padding: 12,
                                    font: {
                                        size: 12,
                                        weight: '500'
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                ticks: {
                                    color: '#ffffff',
                                    font: {
                                        weight: 'bold'
                                    }
                                },
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                ticks: {
                                    color: '#ffffff',
                                    stepSize: 1
                                },
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                }
                            }
                        }
                    }
                });
            });
        }

        $(document).on('click', '.btn-reset-vote', function() {
            const namaPasar = $(this).data('nama');
            if (!confirm(`Reset semua vote untuk pasar "${namaPasar}"?`)) return;

            $.ajax({
                url: '{{ route('vote.reset') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama: namaPasar
                },
                success: function(response) {
                    if (response.success) {
                        fetchRekapPerPasar();
                    } else {
                        alert('Reset gagal: ' + response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mereset vote.');
                }
            });
        });


        // Load pertama kali
        fetchRekapPerPasar();

        document.getElementById('btnExportChartPNG').addEventListener('click', () => {
            const canvas = document.getElementById('chartPerPasar');
            const image = canvas.toDataURL('image/png');

            const link = document.createElement('a');
            link.href = image;
            link.download = 'diagram_pasar.png';
            link.click();
        });
    </script>
@endsection
