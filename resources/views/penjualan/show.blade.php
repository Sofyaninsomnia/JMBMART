@extends('components.layout.admin')

@section('content')
    <x-layout.header></x-layout.header>

    <x-layout.aside></x-layout.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Penjualan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('penjualan.index') }}">Penjualan</a></li>
                    <li class="breadcrumb-item active">Detail Penjualan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nota Penjualan</h5>

                            <button class="btn btn-primary mb-3 gap-2" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Barang Penjualan</button>
                            <a href="{{ route('cetak_nota', $detail_penjualan->id) }}" class="bi bi-printer btn btn-success mb-3"> Cetak Nota</a>

                            <div class="table-responsive">
                                <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($detail as $dp)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dp->dataBarang->nama_barang }}</td>
                                            <td>{{ $dp->jumlah_keluar }}</td>
                                            <td>@rupiah($dp->dataBarang->harga_jual)</td>
                                            <td>@rupiah(($dp->dataBarang->harga_jual ?? 0) * $dp->jumlah_keluar)
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <form class="delete-form" action="{{ route('barang_keluar.destroy', $dp->id_barang_keluar) }}" method="POST">
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

                    <!-- Modal Tambah Detail Penjualan -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('detail_penjualan.store', $detail_penjualan->id) }}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Detail Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_penjualan" value="{{ $detail_penjualan->id }}">
                                        <div class="form-group mb-2">
                                            <label>Barang</label>
                                            <select name="id_barang" class="form-select" required>
                                                <option value="" selected disabled>Pilih Barang</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Jumlah</label>
                                            <input type="number" name="jumlah_keluar" class="form-control" required>
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
            </div>
        </section>

    </main>
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
                        text: "Data akan dihapus secara permanen!",
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cek jika ada pesan sukses dari sesi
        @if(session('swal_success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('swal_success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        // Cek jika ada pesan error dari sesi
        @if(session('swal_error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('swal_error') }}',
                showConfirmButton: true, // Biarkan tombol konfirmasi agar user bisa membaca pesan error
            });
        @endif
    });
</script>
@endpush
