@extends('layouts/template')

@section('styles')
    <style>
        /* Base Styles */
        .card-header h2 {
            margin-bottom: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .img-thumbnail-table {
            max-width: 100px;
            max-height: 60px;
            object-fit: cover;
            border-radius: 0.25rem;
        }

        /* Point Table Styles */
        .point-table {
            --table-color: #4e73df;
            --table-bg-light: #f8f9fc;
        }

        .point-table thead {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
        }

        .point-table tbody tr:nth-child(odd) {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .point-table tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.15);
        }

        .point-table .table-light {
            border-top: 3px solid var(--table-color);
        }

        /* Polyline Table Styles */
        .polyline-table {
            --table-color: #1cc88a;
            --table-bg-light: #f0f9f5;
        }

        .polyline-table thead {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            color: white;
        }

        .polyline-table tbody tr:nth-child(odd) {
            background-color: rgba(28, 200, 138, 0.05);
        }

        .polyline-table tbody tr:hover {
            background-color: rgba(28, 200, 138, 0.15);
        }

        .polyline-table .table-light {
            border-top: 3px solid var(--table-color);
        }

        /* Polygon Table Styles */
        .polygon-table {
            --table-color: #36b9cc;
            --table-bg-light: #eef8fa;
        }

        .polygon-table thead {
            background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
            color: white;
        }

        .polygon-table tbody tr:nth-child(odd) {
            background-color: rgba(54, 185, 204, 0.05);
        }

        .polygon-table tbody tr:hover {
            background-color: rgba(54, 185, 204, 0.15);
        }

        .polygon-table .table-light {
            border-top: 3px solid var(--table-color);
        }

        /* Common Table Enhancements */
        .enhanced-table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 0.35rem;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .enhanced-table th {
            font-weight: 600;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .enhanced-table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            border-top: 1px solid #e3e6f0;
        }

        .enhanced-table tbody tr:last-child td {
            border-bottom: none;
        }

        .no-data-row {
            background-color: #f8f9fc !important;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Pasar Tradisional Di Yogyakarta</h1>

        {{-- Table Point --}}
        <div class="card shadow-sm mb-5 border-0">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h2 class="h5 mb-0 text-primary font-weight-bold">
                    <i class="fas fa-map-marker-alt mr-2"></i> Lokasi
                </h2>
            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive">
                    <table class="table enhanced-table point-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Ayo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($points as $p)
                                <tr>
                                    <td class="font-weight-bold text-primary">{{ $loop->iteration }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ Str::limit($p->description, 100) }}</td>
                                    <td>
                                        @if ($p->image)
                                            <img src="{{ asset('storage/images/' . $p->image) }}" alt="{{ $p->name }}"
                                                class="img-thumbnail-table shadow-sm" title="{{ $p->image }}">
                                        @else
                                            <span class="badge badge-light">No Image</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $p->created_at->format('d M Y, H:i') }}</small></td>
                                    <td><small class="text-muted">{{ $p->updated_at->format('d M Y, H:i') }}</small></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="window.location.href='{{ route('map') }}?type=point&id={{ $p->id }}'">
                                            <i class="fas fa-search-location"></i> Go To
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data-row">
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-database fa-2x mb-2"></i><br>
                                        No point data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Table Polyline
        <div class="card shadow-sm mb-5 border-0">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h2 class="h5 mb-0 text-success font-weight-bold">
                    <i class="fas fa-road mr-2"></i>Polyline Data
                </h2>
            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive">
                    <table class="table enhanced-table polyline-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Go To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polylines as $p)
                                <tr>
                                    <td class="font-weight-bold text-success">{{ $loop->iteration }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ Str::limit($p->description, 100) }}</td>
                                    <td>
                                        @if ($p->image)
                                            <img src="{{ asset('storage/images/' . $p->image) }}"
                                                alt="{{ $p->name }}" class="img-thumbnail-table shadow-sm"
                                                title="{{ $p->image }}">
                                        @else
                                            <span class="badge badge-light">No Image</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $p->created_at->format('d M Y, H:i') }}</small></td>
                                    <td><small class="text-muted">{{ $p->updated_at->format('d M Y, H:i') }}</small></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success"
                                            onclick="window.location.href='{{ route('map') }}?type=polyline&id={{ $p->id }}'">
                                            <i class="fas fa-search-location"></i> Go To
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data-row">
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-database fa-2x mb-2"></i><br>
                                        No polyline data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Table Polygon
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h2 class="h5 mb-0 text-info font-weight-bold">
                    <i class="fas fa-draw-polygon mr-2"></i>Polygon Data
                </h2>
            </div>
            <div class="card-body px-0 pt-0">
                <div class="table-responsive">
                    <table class="table enhanced-table polygon-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Go To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polygons as $p)
                                <tr>
                                    <td class="font-weight-bold text-info">{{ $loop->iteration }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ Str::limit($p->description, 100) }}</td>
                                    <td>
                                        @if ($p->image)
                                            <img src="{{ asset('storage/images/' . $p->image) }}"
                                                alt="{{ $p->name }}" class="img-thumbnail-table shadow-sm"
                                                title="{{ $p->image }}">
                                        @else
                                            <span class="badge badge-light">No Image</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $p->created_at->format('d M Y, H:i') }}</small></td>
                                    <td><small class="text-muted">{{ $p->updated_at->format('d M Y, H:i') }}</small></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info"
                                            onclick="window.location.href='{{ route('map') }}?type=polygon&id={{ $p->id }}'">
                                            <i class="fas fa-search-location"></i> Go To
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data-row">
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-database fa-2x mb-2"></i><br>
                                        No polygon data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

@section('scripts')
    <script>
        // Object untuk menyimpan layer berdasarkan ID
        const featureLayers = {
            point: {},
            polyline: {},
            polygon: {}
        };

        function zoomToFeatureById(id, layerGroup) {
            let targetLayer = null;

            layerGroup.eachLayer(function(layer) {
                const layerId = String(layer.feature?.properties?.id ?? '');
                if (layerId === String(id)) {
                    targetLayer = layer;
                }
            });

            if (targetLayer) {
                let bounds;
                if (typeof targetLayer.getBounds === 'function') {
                    bounds = targetLayer.getBounds();
                } else if (typeof targetLayer.getLatLng === 'function') {
                    bounds = L.latLngBounds([targetLayer.getLatLng()]);
                }

                if (bounds) {
                    map.flyToBounds(bounds, {
                        duration: 5,
                        padding: [50, 50]
                    });
                    targetLayer.openPopup();
                }
            }
        }
    </script>
@endsection
