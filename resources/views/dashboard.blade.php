@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>Selamat Datang di Dashboard Perpustakaan!</h3>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="row">

                    {{-- Jumlah Buku --}}
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted mb-0">Jumlah Buku</h6>
                                        <h6 class="font-extrabold mb-0">{{ $jumlahBuku }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jumlah Anggota --}}
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted mb-0">Jumlah Anggota</h6>
                                        <h6 class="font-extrabold mb-0">{{ $jumlahAnggota }}</h6>
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
    </div>
@endsection
