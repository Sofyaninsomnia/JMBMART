@extends('components.layout.admin')

@section('content')
    <x-layout.header></x-layout.header>

    <x-layout.aside></x-layout.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Barang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Barang</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Barang</h5>

                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal"><i
                                    class="bi bi-plus"></i> Tambah Data Barang</button>

                            <div class="table-responsive">
                                <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($data_barang as $db)
                                        <tr>
                                            <td>{{ '00' . $no++ }}</td>
                                            <td>{{ $db->kode_barang }}</td>
                                            <td>{{ $db->nama_barang }}</td>
                                            <td>{{ $db->stok ?? 0 }}</td>
                                            <td>Rp {{ number_format($db->harga_beli, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($db->harga_jual, 0, ',', '.') }}</td>
                                            <td class="d-flex m-auto justify-content-center align-items-center gap-2">
                                                <button class="btn btn-sm btn-primary btn-edit"
                                                    data-id="{{ $db->id_barang }}" 
                                                    data-kode="{{ $db->kode_barang }}"
                                                    data-nama="{{ $db->nama_barang }}"
                                                    data-package="{{ $db->package }}"
                                                    data-harga_beli="{{ $db->harga_beli }}"
                                                    data-harga_jual="{{ $db->harga_jual }}"
                                                    data-supplier="{{ $db->id_supplier }}"
                                                    data-kategori="{{ $db->id_kategori }}"
                                                    data-stok="{{ $db->stok }}" data-bs-toggle="modal"
                                                    data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></button>
                                                <a href="{{ route('data_barang.show', $db->id_barang) }}"
                                                    class="btn btn-sm btn-warning"><i class="bi bi-info-circle"
                                                        style="color: white"></i></a>
                                                <form class="delete-form"
                                                    action="{{ route('data_barang.destroy', $db->id_barang) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Tidak ada data barang.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('data_barang.store') }}" method="post" accept-charset="utf-8">
                                @csrf

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Data Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="nama_barang">Nama Data Barang</label>
                                            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                                                class="form-control" placeholder="Masukkan nama barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="package">Package</label>
                                            <input type="text" name="package" value="{{ old('package') }}"
                                                class="form-control" placeholder="Jenis Kemasan" required>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="harga_beli">Harga beli</label>
                                                <input type="number" name="harga_beli" value="{{ old('harga_beli') }}"
                                                    class="form-control" placeholder="Harga satuan beli" required>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="harga_jual">Harga jual</label>
                                                <input type="number" name="harga_jual" value="{{ old('harga_jual') }}"
                                                    class="form-control" placeholder="Harga satuan jual" required>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="id_supplier">Supplier</label>
                                                <select name="id_supplier" class="form-select" required>
                                                    <option value="" selected disabled>Nama Supplier</option>
                                                    @foreach ($supplier as $supp)
                                                        <option value="{{ $supp->id_supplier }}"
                                                            {{ old('id_supplier') == $supp->id_supplier }}>
                                                            {{ $supp->nama_supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col mb-0">
                                                <label for="id_kategori">Kategori</label>
                                                <select name="id_kategori" class="form-select" required>
                                                    <option value="" selected disabled>Kategori barang</option>
                                                    @foreach ($kategori as $kat)
                                                        <option value="{{ $kat->id_kategori }}"
                                                            {{ old('id_kategori') == $kat->id_kategori }}>
                                                            {{ $kat->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" name="stok" value="{{ old('stok', 0) }}"
                                                class="form-control" placeholder="(Opsional)" >
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
                            <form id="formEdit" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <input type="hidden" name="id_barang" id="edit_id">
                                        <input type="hidden" name="kode_barang" id="edit_kode_barang">

                                        <div class="mb-3">
                                            <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                                            <input type="text" name="nama_barang" id="edit_nama_barang"
                                                class="form-control" placeholder="Masukkan nama barang" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_package" class="form-label">Package</label>
                                            <input type="text" name="package" id="edit_package" class="form-control"
                                                placeholder="Jenis Kemasan" required>
                                        </div>

                                        <div class="row g-2 mb-3">
                                            <div class="col">
                                                <label for="edit_harga_beli" class="form-label">Harga Beli</label>
                                                <input type="number" name="harga_beli" id="edit_harga_beli"
                                                    class="form-control" placeholder="Harga satuan beli" required>
                                            </div>
                                            <div class="col">
                                                <label for="edit_harga_jual" class="form-label">Harga Jual</label>
                                                <input type="number" name="harga_jual" id="edit_harga_jual"
                                                    class="form-control" placeholder="Harga satuan jual" required>
                                            </div>
                                        </div>

                                        <div class="row g-2 mb-3">
                                            <div class="col">
                                                <label for="edit_id_supplier" class="form-label">Supplier</label>
                                                <select name="id_supplier" id="edit_id_supplier" class="form-select"
                                                    required>
                                                    <option value="" disabled>-- Pilih Supplier --</option>
                                                    @foreach ($supplier as $supp)
                                                        <option value="{{ $supp->id_supplier }}">
                                                            {{ $supp->nama_supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="edit_id_kategori" class="form-label">Kategori</label>
                                                <select name="id_kategori" id="edit_id_kategori" class="form-select"
                                                    required>
                                                    <option value="" disabled>-- Pilih Kategori --</option>
                                                    @foreach ($kategori as $kat)
                                                        <option value="{{ $kat->id_kategori }}">
                                                            {{ $kat->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_stok" class="form-label">Stok</label>
                                            <input type="number" name="stok" id="edit_stok" class="form-control"
                                                placeholder="0" disabled>
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
            </div><!-- End Row -->
        </section>

    </main><!-- End #main -->
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const kode = this.dataset.kode;
                const nama = this.dataset.nama;
                const packageBarang = this.dataset.package;
                const hargaBeli = this.dataset.harga_beli;
                const hargaJual = this.dataset.harga_jual;
                const idSupplier = this.dataset.supplier;
                const idKategori = this.dataset.kategori;
                const stok = this.dataset.stok;

                // set form action
                document.getElementById('formEdit').action =
                    "{{ url('admin/data_barang/update') }}/" + id;

                // isi semua field form edit
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_kode_barang').value = kode;
                document.getElementById('edit_nama_barang').value = nama;
                document.getElementById('edit_package').value = packageBarang;
                document.getElementById('edit_harga_beli').value = hargaBeli;
                document.getElementById('edit_harga_jual').value = hargaJual;
                document.getElementById('edit_stok').value = stok;

                // set selected option untuk dropdown Supplier
                let supplierSelect = document.getElementById('edit_id_supplier');
                [...supplierSelect.options].forEach(opt => {
                    opt.selected = opt.value === idSupplier;
                });

                // set selected option untuk dropdown Kategori
                let kategoriSelect = document.getElementById('edit_id_kategori');
                [...kategoriSelect.options].forEach(opt => {
                    opt.selected = opt.value === idKategori;
                });
            });
        });

        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
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
