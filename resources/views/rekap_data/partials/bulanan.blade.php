<div class="d-flex mb-3 gap-2">
  <form action="{{ route('rekap.cetak_bulanan') }}" target="_blank" method="GET" class="d-flex gap-1">
    <input type="month" name="bulan" class="form-control me-2" value="{{ $bulan }}">
    <button type="submit" class="btn btn-sm btn-primary">
      <i class="bi bi-printer"></i>
    </button>
  </form>
  
  <form class="d-flex ms-auto " method="GET" action="{{ route('rekap.index') }}">
      <input type="hidden" name="mode" value="bulanan">
      <input type="month" name="bulan" class="form-control me-2" value="{{ $bulan }}">
      <button class="btn btn-outline-primary">
        <i class="bi bi-search"></i>
      </button>
  </form>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Untung</th>
            <th>Modal Akhir</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $b)
            <tr>
                <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}</td>
                <td>@rupiah($b->keuntungan)</td>
                <td>@rupiah($b->modal_per_akhir)</td>
                <td>@rupiah($b->sub_total)</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada data.</td>
            </tr>
        @endforelse
    </tbody>
</table>
