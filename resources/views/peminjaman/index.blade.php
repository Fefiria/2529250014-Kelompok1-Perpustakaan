@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Buku</h3>
                <p class="text-subtitle text-muted">Gunakan halaman ini untuk melihat daftar buku.</p>
            </div>
            
            <div class="col-12 col-md-6 order-md-2 order-first d-flex flex-column align-items-start align-items-md-end justify-content-between">
                
                <nav aria-label="breadcrumb" class="breadcrumb-header mb-3 mb-md-0">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card">
                        @if($peminjamans->isEmpty())
                            <p>Belum ada peminjaman yang ditambahkan</p>
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary align-items-center gap-2">
                                <i class="bi bi-plus-circle-fill"></i>
                                <span>Tambah Peminjaman</span>
                            </a>
                        @else
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Daftar Transaksi Peminjaman</h4>
                                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg align-middle" id="table-peminjaman">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th style="width: 20%">Peminjam</th>
                                                <th style="width: 35%">Buku yang Dipinjam</th>
                                                <th style="width: 15%">Periode Pinjam</th>
                                                <th style="width: 10%">Status</th>
                                                <th style="width: 15%" class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($peminjamans as $index => $pinjam)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar avatar-md bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">
                                                            {{ strtoupper(substr($pinjam->user->nama, 0, 1)) }}
                                                        </div>
                                                        <div style="min-width: 0;">
                                                            <h6 class="mb-0 text-white text-truncate" style="font-size: 0.95rem;">{{ $pinjam->user->nama }}</h6>
                                                            <small style="color: #a0aec0;">@</small><small style="color: #a0aec0;" class="text-truncate">{{ $pinjam->user->username }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <ul class="list-group list-group-flush mb-0" style="background: transparent;">
                                                        @foreach($pinjam->details as $detail)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center p-1 bg-transparent border-0">
                                                            <div class="text-truncate me-2" style="font-size: 0.9rem;" title="{{ $detail->buku->judul }}">
                                                                <i class="bi bi-book text-secondary me-1"></i> {{ $detail->buku->judul }}
                                                            </div>
                                                            @if($detail->status == 'dipinjam')
                                                                <span class="badge bg-light-warning text-warning fw-normal" style="font-size: 0.75rem;">Dipinjam</span>
                                                            @else
                                                                <span class="badge bg-light-success text-success fw-normal" style="font-size: 0.75rem;">Kembali</span>
                                                            @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                
                                                <td>
                                                    <div style="font-size: 0.85rem;">
                                                        <span class="d-block text-white fw-bold"><i class="bi bi-calendar-check me-1 text-success"></i> {{ \Carbon\Carbon::parse($pinjam->tanggalPeminjaman)->format('d M Y') }}</span>
                                                        <span class="d-block mt-1" style="color: #e2e8f0;"><i class="bi bi-hourglass-split me-1 text-danger"></i> S/d {{ \Carbon\Carbon::parse($pinjam->tanggalKembali)->format('d M Y') }}</span>
                                                        <small class="badge bg-light-secondary text-secondary mt-1 fw-normal">{{ $pinjam->lamaPinjam }} Hari</small>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    @if($pinjam->status == 'dipinjam')
                                                        <span class="badge bg-warning p-2">Aktif</span>
                                                    @elseif($pinjam->status == 'selesai')
                                                        <span class="badge bg-success p-2">Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger p-2">Terlambat</span>
                                                    @endif
                                                </td>
                                                
                                                <td class="text-end">
                                                    <div class="btn-group gap-1" role="group">
                                                        <button type="button" class="btn btn-light-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Catatan: {{ $pinjam->catatan ?? '-' }}">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        
                                                        @if($pinjam->status == 'dipinjam')
                                                        <form action="{{ route('peminjaman.edit', $pinjam->idPeminjaman) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-light-success btn-sm" onclick="return confirm('Proses pengembalian seluruh buku untuk transaksi ini?')" data-bs-toggle="tooltip" title="Kembalikan Buku">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                        
                                                        <form action="{{ route('peminjaman.destroy', $pinjam->idPeminjaman) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-light-danger btn-sm" onclick="return confirm('Yakin ingin menghapus riwayat transaksi ini?')" data-bs-toggle="tooltip" title="Hapus Riwayat">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
