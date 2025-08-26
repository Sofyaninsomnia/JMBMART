@extends('components.layout.admin')

@section('content')
    <x-layout.header />
    <x-layout.aside />

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail Data Barang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data_barang.index') }}">Data Barang</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-box-seam"></i> Informasi Barang</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-muted fw-semibold">Kode Barang</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">{{ $data_barang->kode_barang }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Nama Barang</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">{{ $data_barang->nama_barang }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Package</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">{{ $data_barang->package }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Supplier</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">{{ optional($data_barang->data_supplier)->nama_supplier ?? '-' }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Kategori</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">{{ optional($data_barang->kategori)->nama_kategori ?? '-' }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Harga Beli</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">Rp {{ number_format($data_barang->harga_beli, 0, ',', '.') }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Harga Jual</div>
                                <div class="col-sm-8 border-bottom pb-2 mb-2">Rp {{ number_format($data_barang->harga_jual, 0, ',', '.') }}</div>

                                <div class="col-sm-4 text-muted fw-semibold">Stok</div>
                                <div class="col-sm-8">{{ $data_barang->stok ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="card-footer text-end bg-white border-0">
                            <a href="{{ route('data_barang.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
