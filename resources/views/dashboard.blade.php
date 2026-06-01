@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <h3>Selamat Datang di Dashboard Perpustakaan</h3>
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

                {{-- Jumlah Anggota --}}
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

                {{-- Jumlah Peminjaman --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div class="stats-icon blue me-3">
                                    <i class="iconly-boldProfile"></i>
                                </div>

                                <div>
                                    <h6 class="text-muted mb-1">Jumlah Peminjaman</h6>
                                    <h6 class="font-extrabold mb-0">{{ $jumlahPeminjaman }}</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Pengembalian --}}
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

            {{-- Grafik Bar --}}
            <div class="row">
                <div class="col-12 col-lg-6 col-md-6">
                    <div class="card p-3" style="height: 520px !important;">
                        <div class="card-header text-center">
                            <h4>Statistik Perpustakaan</h4>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center" style="height: calc(100% - 60px);">
                            <!-- 🚀 PERBAIKAN CANVAS: Set height HTML-nya ke 100% biar dia melar penuh ke bawah -->
                            <canvas id="mainDashboardChart" style="width: 100% !important; height: 100% !important; max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-md-6">
                    <div class="card" style="height: 520px !important; overflow: hidden;">
                        <div class="card-header text-center mb-0">
                            <h4>Top 5 Buku Populer Sering Dipinjam</h4>
                        </div>
                        <div class="card-body" style="overflow-y: auto; height: calc(100% - 60px);">
                            <div class="table-responsive">
                                <table class="table table-lg align-middle text-white">
                                    <thead>
                                        <tr class="text-muted" style="border-bottom: 2px solid #4f5d73;">
                                            <th style="width: 10%" class="text-center">RANK</th>
                                            <th style="width: 70%">JUDUL BUKU</th>
                                            <th style="width: 20%" class="text-center">TOTAL DIPINJAM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Kita pakai @foreach biasa, tapi manfaatin $loop->iteration buat nomor urut --}}
                                        @forelse($labelBukuPopuler as $index => $judul)
                                            <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                                
                                                <td class="text-center fw-bold fs-5">
                                                    @if($loop->iteration == 1)
                                                        <span data-bs-toggle="tooltip" title="Juara 1 Bestseller">🥇</span>
                                                    @elseif($loop->iteration == 2)
                                                        <span data-bs-toggle="tooltip" title="Juara 2 Bestseller">🥈</span>
                                                    @elseif($loop->iteration == 3)
                                                        <span data-bs-toggle="tooltip" title="Juara 3 Bestseller">🥉</span>
                                                    @else
                                                        <span class="text-muted fs-6" style="padding-left: 6px;">{{ $loop->iteration }}</span>
                                                    @endif
                                                </td>

                                                <td class="fw-semibold text-wrap">
                                                    @if($loop->iteration == 1)
                                                        <span class="text-warning">{{ $judul }}</span>
                                                    @elseif($loop->iteration == 2)
                                                        <span class="text-secondary">{{ $judul }}</span>
                                                    @elseif($loop->iteration == 3)
                                                        <span style="color: #CD7F32;">{{ $judul }}</span>
                                                    @else
                                                        <span>{{ $judul }}</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge bg-light-primary text-primary fw-bold px-3 py-2" style="font-size: 0.9rem;">
                                                        {{ $jumlahBukuPopuler[$index] }} Kali
                                                    </span>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">
                                                    <i class="bi bi-book-half d-block mb-2" style="font-size: 2rem;"></i>
                                                    Belum ada data  peminjaman.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('mainDashboardChart').getContext('2d');
            
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Anggota', 'Total Genre', 'Total Buku', 'Total Peminjaman'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: [
                        {{ $jumlahAnggota }}, 
                        {{ $jumlahGenre }}, 
                        {{ $jumlahBuku }}, 
                        {{ $jumlahPeminjaman }}
                    ],
                    backgroundColor: [
                        '#435ebe',
                        '#198754',
                        '#ffc107',
                        '#dc3545'
                    ],
                    borderRadius: 3,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#b0b0bf'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#ffffff',
                            font: {
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
