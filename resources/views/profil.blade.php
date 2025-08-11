@extends('components.layout.admin')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pengaturan Akun</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengaturan Akun</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile ">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Profile" class="rounded-circle"
                                style="width: 100px;
                                        height: 100px;
                                        object-fit: cover;
                                        object-position: center;">
                            <div class="input-group m-3 justify-content-center align-items-center d-flex gap-1">
                                <form action="{{ route('ubah-profil') }}" method="POST" enctype="multipart/form-data"
                                    id="uploadPhotoForm">
                                    @csrf
                                    <input type="file" name="foto" class="custom-file-input" id="uploadButtonFile"
                                        style="
                                            visibility: hidden;
                                            width: 0.1px;
                                            height: 0.1px;
                                            opacity: 0; 
                                            overflow: hidden;
                                            position: absolute;
                                            z-index: -1; 
                                        "
                                        onchange="document.getElementById('uploadPhotoForm').submit();">

                                    <label class="btn btn-secondary text-center" style="border-radius: 20px"
                                        for="uploadButtonFile">Upload foto</label>
                                </form>
                                <form class="delete-form" action="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="border-radius: 20px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <h2>{{ Auth::user()->name }}</h2>
                            <h3>{{ Auth::user()->email }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Profil</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#norek">No
                                        Rekening</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profil</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#change-password">Ganti
                                        Password</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Detail Akun</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nama</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade norek pt-3" id="norek">
                                    @foreach ($norek as $ds)
                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label">Nomor Rekening</div>
                                            <div class="col-lg-9 col-md-8">{{ $ds->nomor }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label">Atas Nama</div>
                                            <div class="col-lg-9 col-md-8">{{ $ds->nama }}</div>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-primary editBtn" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $ds->id }}"
                                                data-nomor="{{ $ds->nomor }}" data-nama="{{ $ds->nama }}">Ubah
                                                Norek</button>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-pane
                                            fade profile-edit pt-3"
                                    id="profile-edit">
                                    <!-- Profile Edit Form -->
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade pt-3" id="change-password">
                                    <!-- Change Password Form -->
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="current_password"
                                                class="col-md-4 col-lg-3 col-form-label">Password
                                                Lama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="new_password" class="col-md-4 col-lg-3 col-form-label">Password
                                                Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password" type="password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Ulangi
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password_confirmation" type="password"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="text-center gap-2">
                                            <button type="submit" class="btn btn-primary">Ganti Password</button>
                                            <a href="/forgot" class="btn btn-outline-secondary">Lupa Password</a>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>

                    <div class="text-left">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali</a>
                    </div>

                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="formEdit" action="" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Ubah Norek</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Hidden field untuk ID kategori -->
                                        <input type="hidden" name="id_kategori" id="edit_id">
                                        <div class="form-group">
                                            <label for="edit_data_supplier">Nomor Rekening</label>
                                            <input type="text" name="nomor" id="edit_nomor"
                                                class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_data_supplier">Atas Nama</label>
                                            <input type="text" name="nama" id="edit_nama"
                                                class="form-control" required>
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
                    const nomor = this.dataset.nomor;
                    const nama = this.dataset.nama;

                    document.getElementById('formEdit').action =
                        "{{ url('/admin/change-norek') }}/" + id;

                    // isi field
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_nomor').value = nomor;
                    document.getElementById('edit_nama').value = nama;
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
