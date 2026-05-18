@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Buku</h3>
                <p class="text-subtitle text-muted">Gunakan halaman ini untuk menambahkan buku.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section id="multiple-column-form">
        <div class="row match-height justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row gap-2">
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="judul-buku-column">Judul Buku</label>
                                            <div class="position-relative">
                                                <input type="text" id="judul-buku-column" class="form-control mt-1" placeholder="Masukkan judul buku..." name="judul-buku-column">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-journal-bookmark"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="pengarang-column">Pengarang</label>
                                            <div class="position-relative">
                                                <input type="text" id="pengarang-column" class="form-control mt-1" placeholder="Masukkan pengarang buku..." name="pengarang-column">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person-lines-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-icon-left">
                                            <label for="pengarang-column">Pengarang</label>
                                            <div class="position-relative">
                                                <input type="text" id="pengarang-column" class="form-control mt-1" placeholder="Masukkan pengarang buku..." name="pengarang-column">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person-lines-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Country</label>
                                            <input type="text" id="country-floating" class="form-control"
                                                name="country-floating" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="company-column">Company</label>
                                            <input type="text" id="company-column" class="form-control"
                                                name="company-column" placeholder="Company">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Email</label>
                                            <input type="email" id="email-id-column" class="form-control"
                                                name="email-id-column" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
@endsection