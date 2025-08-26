@extends('components.layout.admin')

@section('content')
    <x-layout.header></x-layout.header>

    <x-layout.aside></x-layout.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Penjualan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penjualan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penjualan</h5>

                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal"><i
                                    class="bi bi-plus"></i> Tambah Penjualan</button>

                            <div class="table-responsive">
                                <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penjualan</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Nota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($barang_keluar as $bk)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $bk->dataBarang->nama_barang }}</td>
                                            <td>{{ $bk->tanggal_keluar }}</td>
                                            <td>{{ $bk->jumlah_keluar }}</td>
                                            <td>{{ $bk->keterangan }}</td>
                                            <td class="d-flex m-auto justify-content-center align-items-center">
                                                <form class="delete-form"
                                                    action="{{ route('barang_keluar.destroy', $bk->id_barang_keluar) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('barang_keluar.store') }}" method="post" accept-charset="utf-8">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="data_barang">Nama Penjualan</label>
                                            <select name="id_barang" class="form-select" required>
                                                <option value="" selected disabled>Pilih Penjualan</option>
                                                @foreach ($data_barang as $barang)
                                                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_barang">Tanggal Keluar</label>
                                            <input type="date" name="tanggal_keluar" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_barang">Jumlah Keluar</label>
                                            <input type="number" name="jumlah_keluar" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_barang">Nota</label>
                                            <input type="text" name="nota" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div><!-- End Row -->
        </section>

    </main><!-- End #main -->
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "Apa kamu yakin?",
                        text: "Data ini akan dihapus secara permanen!!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, saya yakin!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
