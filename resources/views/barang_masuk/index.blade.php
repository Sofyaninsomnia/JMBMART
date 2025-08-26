@extends('components.layout.admin')

@section('content')
    <x-layout.header></x-layout.header>

    <x-layout.aside></x-layout.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pembelian</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Pembelian</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pembelian</h5>

                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal"><i
                                    class="bi bi-plus"></i> Tambah Pembelian</button>

                            <div class="table-responsive">
                                <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($barang_masuk as $bm)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $bm->dataBarang->nama_barang }}</td>
                                            <td>{{ $bm->tanggal_masuk }}</td>
                                            <td>{{ $bm->jumlah_masuk }}</td>
                                            <td>{{ $bm->keterangan }}</td>
                                            <td class="d-flex m-auto justify-content-center align-items-center">
                                                <form class="delete-form" action="{{ route('barang_masuk.destroy', $bm->id_barang_masuk) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            </div>
                            <!-- End Tabel Data Kategori -->

                        </div>
                    </div>

                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('barang_masuk.store') }}" method="post" accept-charset="utf-8">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Pembelian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="data_barang">Nama Barang</label>
                                            <select name="id_barang" class="form-select" required>
                                                <option value="" selected disabled>Pilih Barang</option>
                                                @foreach ($data_barang as $barang)
                                                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_barang">Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk" class="form-control"
                                                placeholder="Masukkan tanggal masuk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_barang">Jumlah Masuk</label>
                                            <input type="number" name="jumlah_masuk" class="form-control"
                                                placeholder="Masukkan jumlah masuk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_barang">Keterangan</label>
                                            <textarea type="text" name="keterangan" class="form-control" rows="3" placeholder="(Opsional)" ></textarea>
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

                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Hidden field untuk ID kategori -->
                                    <input type="hidden" name="id_kategori" id="edit_id">
                                    <div class="form-group">
                                        <label for="edit_data_barang">Nama Kategori</label>
                                        <input type="text" name="data_barang" id="edit_data_barang"
                                            class="form-control" placeholder="Masukkan nama kategori" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
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
                        text: "Data ini  akan dihapus secara permanen!!",
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
