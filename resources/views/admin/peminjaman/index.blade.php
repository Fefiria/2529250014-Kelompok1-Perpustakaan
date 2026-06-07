@extends('admin.layouts.main')

@section('content')
<div class="page-heading">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card">
                        @if($peminjamans->isEmpty())
                            <div class="card-header">
                                <p>Belum ada peminjaman yang ditambahkan</p>
                                <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary align-items-center gap-2">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    <span>Tambah Peminjaman</span>
                                </a>
                            </div>
                        @else
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Daftar Transaksi Peminjaman</h4>
                                <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Tambah Peminjaman
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" id="table-peminjaman">
                                        <thead class="table-light border-bottom border-secondary-subtle">
                                            <tr>
                                                <th style="width: 5%" class="py-3 text-center">NO</th>
                                                <th style="width: 25%" class="py-3">PEMINJAM</th>
                                                <th style="width: 35%" class="py-3">BUKU YANG DIPINJAM</th>
                                                <th style="width: 15%" class="py-3">PERIODE PINJAM</th>
                                                <th style="width: 10%" class="py-3 text-center">STATUS</th>
                                                <th style="width: 10%" class="py-3 text-center">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($peminjamans as $index => $pinjam)
                                            <tr class="border-bottom border-light-subtle">
                                                <td class="text-center fw-semibold text-secondary">{{ $index + 1 }}</td>
                                                
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="avatar avatar-md {{ $pinjam->user->photoUrl ? 'bg-transparent' : 'bg-light-primary text-primary' }} rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 40px; height: 40px; overflow: hidden; border: none;">
                                                            @if($pinjam->user->photoUrl)
                                                                <img src="{{ $pinjam->user->photoUrl }}" alt="Profile {{ $pinjam->user->nama }}" style="width: 100%; height: 100%; object-fit: cover; display: block; border: none;">
                                                            @else
                                                                <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Profile {{ $pinjam->user->nama }}" style="width: 100%; height: 100%; object-fit: cover; display: block; border: none;">
                                                            @endif
                                                        </div>
                                                        <div style="min-width: 0;">
                                                            <h6 class="mb-0 fw-bold text-truncate" style="font-size: 0.95rem;">{{ $pinjam->user->nama }}</h6>
                                                            <small class="text-body-secondary d-block text-truncate">@​{{ $pinjam->user->username }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <ul class="list-group list-group-flush mb-0 bg-transparent">
                                                        @foreach($pinjam->details as $detail)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center p-1 bg-transparent border-0">
                                                            <div class="text-truncate me-3 fw-medium" style="font-size: 0.88rem;" title="{{ $detail->buku->judul }}">
                                                                <i class="bi bi-book me-1 text-primary-emphasis small"></i> {{ $detail->buku->judul }}
                                                            </div>
                                                            
                                                            @if($detail->status == 'dipinjam')
                                                                <span class="badge bg-light-warning text-warning fw-semibold px-2 py-1" style="font-size: 0.72rem;">Dipinjam</span>
                                                            @else
                                                                <span class="badge bg-light-success text-success fw-semibold px-2 py-1" style="font-size: 0.72rem;">Dikembalikan</span>
                                                            @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                
                                                <td>
                                                    <div style="font-size: 0.85rem;" class="lh-sm">
                                                        <span class="d-block fw-semibold text-success-emphasis"><i class="bi bi-calendar-plus me-1"></i> {{ \Carbon\Carbon::parse($pinjam->tanggalPeminjaman)->format('d M Y') }}</span>
                                                        <span class="d-block mt-1 fw-semibold text-danger-emphasis"><i class="bi bi-calendar-minus me-1"></i> {{ \Carbon\Carbon::parse($pinjam->tanggalKembali)->format('d M Y') }}</span>
                                                        <span class="badge bg-secondary-subtle text-secondary-emphasis mt-2 fw-medium px-2 py-1">{{ $pinjam->lamaPinjam }} Hari</span>
                                                    </div>
                                                </td>
                                                
                                                <td class="text-center">
                                                    @if($pinjam->status == 'Aktif')
                                                        <span class="badge bg-danger text-dark fw-bold px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">Aktif</span>
                                                    @elseif($pinjam->status == 'Dikembalikan Sebagian')
                                                        <span class="badge bg-warning text-white fw-bold px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">Dikembalikan Sebagian</span>
                                                    @else
                                                        <span class="badge bg-success text-white fw-bold px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">Telah Dikembalikan</span>
                                                    @endif
                                                </td>
                                                
                                                <td class="text-center">
                                                    <div class="btn-group gap-2" role="group">
                                                        <a href="{{ route('admin.peminjaman.edit', $pinjam->idPeminjaman) }}" class="btn btn-outline-success btn-sm rounded d-flex align-items-center justify-content-center p-2" data-bs-toggle="tooltip" title="Kelola Peminjaman">
                                                            <i class="bi bi-gear-fill lh-1"></i>
                                                        </a>
                                                        
                                                        <form action="{{ route('admin.peminjaman.destroy', $pinjam->idPeminjaman) }}" method="POST" class="d-inline" onsubmit="displayAlert(event, this, 'Apakah anda ingin menghapus peminjaman ini?', 'warning')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded d-flex align-items-center justify-content-center p-2" data-bs-toggle="tooltip" title="Hapus Peminjaman">
                                                                <i class="bi bi-trash3-fill lh-1"></i>
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
