@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>Selamat Datang di Dashboard Perpustakaan!</h3>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="row">

                {{-- Jumlah Buku --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div class="stats-icon purple me-3">
                                    <i class="iconly-boldShow"></i>
                                </div>

                                <div>
                                    <h6 class="text-muted mb-1">Jumlah Buku</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahBuku }}</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div class="stats-icon blue me-3">
                                    <i class="iconly-boldProfile"></i>
                                </div>

                                <div>
                                    <h6 class="text-muted mb-1">Jumlah Anggota</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahAnggota }}</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div class="stats-icon blue me-3">
                                    <i class="iconly-boldProfile"></i>
                                </div>

                                <div>
                                    <h6 class="text-muted mb-1">Jumlah Peminjaman</h6>
                                    <h6 class="font-extrabold mb-0">000</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div class="stats-icon blue me-3">
                                    <i class="iconly-boldProfile"></i>
                                </div>

                                <div>
                                    <h6 class="text-muted mb-1">Jumlah Dikembalikan</h6>
                                    <h6 class="font-extrabold mb-0">000</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grafik --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Statistik Perpustakaan</h4>
                </div>

                <div class="card-body">
                    <canvas id="dashboardChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
