<div class="table-responsive">
    <div class="d-flex mb-3 gap-2">
        <form method="GET" action="{{ route('rekap_data.print.harian') }}" target="_blank" class="d-flex">
            <input type="hidden" name="mode" value="harian">
            <input type="date" name="tanggal" class="form-control me-2" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-printer"></i>
            </button>
        </form>

        <form method="POST" action="{{ route('rekap_data.simpan_harian') }}" class="d-flex">
            @csrf
            <input type="date" name="tanggal" class="form-control me-2" value="{{ request('search') }}" required>
            <button type="submit" class="btn btn-success btn-sm">
                <i class="bi bi-save"></i>
            </button>
        </form>

        <form method="GET" action="{{ route('rekap.index') }}" class="ms-auto d-flex">
            <input type="hidden" name="mode" value="harian">
            <input type="date" name="search" class="form-control me-2" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Pembelian</th>
                <th>Untung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $r)
                <tr>
                    <td>{{ $r->tanggal }}</td>
                    <td>{{ number_format($r->penjualan, 0, ',', '.') }}</td>
                    <td>{{ number_format($r->pembelian, 0, ',', '.') }}</td>
                    <td>@rupiah($r->keuntungan)</td>
                    <td>
                        <form class="delete-form"
                            action="{{ route('rekap_data.hapus_harian', ['tanggal' => $r->tanggal]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $data->links() }}
