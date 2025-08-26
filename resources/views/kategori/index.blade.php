@extends('components.layout.admin')

@section('content')
    <x-layout.header></x-layout.header>
    <x-layout.aside></x-layout.aside>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kategori</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kategori</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Kategori</h5>

                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus"></i> Tambah Kategori
                            </button>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kategori as $kategori)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kategori->nama_kategori }}</td>
                                            <td class="d-flex m-auto justify-content-center align-items-center gap-4">
                                                <button class="btn btn-success btn-sm editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" data-id="{{ $kategori->id_kategori }}"
                                                    data-nama="{{ $kategori->nama_kategori }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <form class="delete-form"
                                                    action="{{ route('Kategori.destroy', $kategori->id_kategori) }}"
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
                                            <td colspan="3" class="text-center">Tidak ada data kategori.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('kategori.store') }}" method="post" accept-charset="utf-8">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama-kategori">Nama Kategori</label>
                                            <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                                placeholder="Masukkan nama kategori" required>
                                            @error('nama_kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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

                    <div class="modal fade" id="editModal" tabindex="-1" aria-label="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="editForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_kategori" id="edit_id">
                                        <div class="form-group">
                                            <label for="edit_nama_kategori">Nama Kategori</label>
                                            <input type="text" name="nama_kategori" id="edit_nama_kategori"
                                                class="form-control" placeholder="Masukkan nama kategori" required>
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
            </div>
        </section>

    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editBtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const nama = this.dataset.nama;

                    // Set action dan isi form seperti biasa
                    document.getElementById('editForm').action =
                        "{{ url('admin/kategori/update') }}/" + id;

                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_nama_kategori').value = nama;
                });

                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        Swal.fire({
                            title: "Yakin ingin dihapus?",
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
        });
    </script>
@endpush
