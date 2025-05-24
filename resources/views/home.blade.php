@extends('layouts.template')
@section('content')
    <div class="container-fluid px-0">
        <!-- Luxury Background Section -->
        <div class="position-relative" style="height: 100vh; min-height: 800px;">
            <!-- Elegant Background Pattern -->
            <div class="position-absolute w-100 h-100" style="background: radial-gradient(circle at 10% 20%, rgba(15, 23, 42, 0.98) 0%, rgba(2, 6, 23, 0.99) 90%); z-index: -2;"></div>

            <!-- Glowing Particles Effect -->
            <div class="position-absolute w-100 h-100" style="background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxyYWRpYWxHcmFkaWVudCBpZD0iZ3JhZCIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNTAwJSI+PHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIvPjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0icmdiYSgyNTUsMjU1LDI1NSwwKSIvPjwvcmFkaWFsR3JhZGllbnQ+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4='); z-index: -1;"></div>

            <!-- Main Content Container -->
            <div class="container h-100 d-flex align-items-center justify-content-center">
                <!-- Luxury Card -->
                <div class="card border-0 shadow-xxl" style="width: 90%; max-width: 1200px; border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <div class="row g-0 h-100">
                        <!-- Left Column - Photo Section -->
                        <div class="col-lg-5 position-relative">
                            <div class="h-100 w-100 position-relative overflow-hidden">
                                <img src="{{ asset('images/akame.png') }}" class="img-fluid w-100 h-100"
                                     style="object-fit: cover; min-height: 600px; filter: brightness(0.95);"
                                     alt="Profile">
                                     class="w-100 h-100"
                                     style="object-fit: cover; min-height: 600px; filter: brightness(0.95);"
                                     alt="Profile">
                                <div class="position-absolute bottom-0 start-0 p-5 text-white w-100" style="background: linear-gradient(transparent, rgba(0,0,0,0.8))">
                                    <h2 class="mb-2 display-5 fw-light" style="letter-spacing: 2px;">ANOMALI</h2>
                                    <p class="mb-0 opacity-75 fs-4" style="letter-spacing: 1px;">NIM: 1122334455</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Info Section -->
                        <div class="col-lg-7 d-flex flex-column">
                            <!-- Luxury Card Header -->
                            <div class="card-header bg-transparent border-bottom border-secondary py-4 px-5">
                                <h3 class="card-title mb-0 text-white fs-2 fw-light" style="letter-spacing: 3px;">
                                    <i class="bi bi-gem me-3"></i>PROFIL MAHASISWA
                                </h3>
                            </div>

                            <!-- Luxury Card Body -->
                            <div class="card-body p-5 flex-grow-1">
                                <div class="row g-4">
                                    <!-- Info Block 1 -->
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center bg-dark-soft p-4 rounded-3 h-100" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(5px);">
                                            <span class="badge bg-primary bg-opacity-15 text-primary me-4 p-3 rounded-circle" style="border: 1px solid rgba(100, 200, 255, 0.3);">
                                                <i class="bi bi-calendar fs-1"></i>
                                            </span>
                                            <div>
                                                <p class="mb-1 text-white-50 small">UMUR</p>
                                                <p class="mb-0 text-white fs-4 fw-light">20 TAHUN</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Block 2 -->
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center bg-dark-soft p-4 rounded-3 h-100" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(5px);">
                                            <span class="badge bg-success bg-opacity-15 text-success me-4 p-3 rounded-circle" style="border: 1px solid rgba(100, 255, 200, 0.3);">
                                                <i class="bi bi-book fs-1"></i>
                                            </span>
                                            <div>
                                                <p class="mb-1 text-white-50 small">PROGRAM STUDI</p>
                                                <p class="mb-0 text-white fs-4 fw-light">SIG</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Block 3 -->
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center bg-dark-soft p-4 rounded-3 h-100" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(5px);">
                                            <span class="badge bg-info bg-opacity-15 text-info me-4 p-3 rounded-circle" style="border: 1px solid rgba(100, 200, 255, 0.3);">
                                                <i class="bi bi-building fs-1"></i>
                                            </span>
                                            <div>
                                                <p class="mb-1 text-white-50 small">UNIVERSITAS</p>
                                                <p class="mb-0 text-white fs-4 fw-light">HARVARD UNIVERSITY</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Block 4 -->
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center bg-dark-soft p-4 rounded-3 h-100" style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(5px);">
                                            <span class="badge bg-purple bg-opacity-15 text-purple me-4 p-3 rounded-circle" style="border: 1px solid rgba(200, 150, 255, 0.3);">
                                                <i class="bi bi-award fs-1"></i>
                                            </span>
                                            <div>
                                                <p class="mb-1 text-white-50 small">SEMESTER</p>
                                                <p class="mb-0 text-white fs-4 fw-light">V</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Luxury Card Footer -->
                            <div class="card-footer bg-transparent border-0 py-4 px-5 d-flex justify-content-center">
                                <a href="#" class="btn btn-outline-light btn-lg rounded-pill mx-3 px-5 py-3" style="border-width: 2px; backdrop-filter: blur(5px); min-width: 180px;">
                                    <i class="bi bi-linkedin me-2"></i>CONNECT
                                </a>
                                <a href="#" class="btn btn-primary btn-lg rounded-pill mx-3 px-5 py-3" style="background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%); border: none; min-width: 180px;">
                                    <i class="bi bi-envelope me-2"></i>CONTACT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
