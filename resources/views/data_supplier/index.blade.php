        @extends('components.layout.admin')

        @section('content')
            <x-layout.header></x-layout.header>

            <x-layout.aside></x-layout.aside>
            <main id="main" class="main">

                <div class="pagetitle">
                    <h1>Data Supplier</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Supplier</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->

                <section class="section dashboard">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Supplier</h5>

                                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal"><i
                                            class="bi bi-plus"></i> Tambah Data Supplier</button>

                                    <div class="table-responsive">
                                        <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Supplier</th>
                                                <th>Alamat</th>
                                                <th>No HP</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @forelse ($data_supplier as $ds)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $ds->nama_supplier }}</td>
                                                    <td>{{ $ds->alamat }}</td>
                                                    <td>{{ $ds->no_telp_supplier }}</td>
                                                    <td class="d-flex m-auto justify-content-center align-items-center gap-2">
                                                        <a href="https://wa.me/+62{{ preg_replace('/[^0-9]/', '', $ds->no_telp_supplier) }}?text={{ urlencode('Halo, saya ingin berbicara tentang nama barang anda yaitu ' . $ds->nama_supplier) }}"
                                                            target="_blank" class="btn btn-sm btn-success"><i
                                                                class="bi bi-whatsapp"></i></a>
                                                        <button class="btn btn-info btn-sm editBtn" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" data-id="{{ $ds->id_supplier }}"
                                                            data-nama="{{ $ds->nama_supplier }}" data-alamat="{{ $ds->alamat }}"
                                                            data-no_telp_supplier="{{ $ds->no_telp_supplier }}"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                        </button>

                                                        <form class="delete-form"
                                                            action="{{ route('data_supplier.destroy', $ds->id_supplier) }}"
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
                                            @endforelse
                                        </tbody>
                                    </table>
                                    </div>

                                </div>
                            </div>

                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('data_supplier.store') }}" method="post" accept-charset="utf-8">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Tambah Data Supplier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="nama_supplier">Nama supplier</label>
                                                    <input type="text" name="nama_supplier" class="form-control"
                                                        placeholder="Masukkan nama supplier" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea type="text" name="alamat" class="form-control" required></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="no_telp_supplier">No Telp Supplier</label>
                                                    <input type="text" name="no_telp_supplier" class="form-control"
                                                        placeholder="Masukkan data supplier" required>
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
                                    <form id="formEdit" action="" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data Supplier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Hidden field untuk ID kategori -->
                                                <input type="hidden" name="id_kategori" id="edit_id">
                                                <div class="form-group">
                                                    <label for="edit_data_supplier">Nama Supplier</label>
                                                    <input type="text" name="nama_supplier" id="edit_nama_supplier"
                                                        class="form-control" placeholder="Masukkan nama data supplier" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_data_supplier">Alamat</label>
                                                    <textarea type="text" name="alamat" id="edit_alamat" class="form-control" required rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_data_supplier">No Telp Supplier</label>
                                                    <input type="text" name="no_telp_supplier" id="edit_no"
                                                        class="form-control" placeholder="Masukkan no telp supplier" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
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

                    document.querySelectorAll('.editBtn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const id = this.dataset.id;
                            const nama = this.dataset.nama;
                            const alamat = this.dataset.alamat;
                            const no_telp_supplier = this.dataset.no_telp_supplier;

                            document.getElementById('formEdit').action =
                                "{{ url('admin/data_supplier/update') }}/" + id;

                            // isi field
                            document.getElementById('edit_id').value = id;
                            document.getElementById('edit_nama_supplier').value = nama;
                            document.getElementById('edit_alamat').value = alamat;
                            document.getElementById('edit_no').value = no_telp_supplier;
                        });
                    });

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
