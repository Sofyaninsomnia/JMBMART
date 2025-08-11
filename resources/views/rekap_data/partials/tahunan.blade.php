<div class="d-flex mb-3">
  <form class="d-flex gap-1" action="{{ route('rekap.cetak_tahunan') }}" target="_blank" method="GET">
    <input type="number" name="tahun" class="form-control me-2" min="2000" max="{{ date('Y') }}"
          value="{{ $tahun }}">
    <button class="btn btn-primary"><i class="bi bi-printer"></i></button>
  </form>
  
  <form class="d-flex ms-auto" method="GET" action="{{ route('rekap.index') }}">
      <input type="hidden" name="mode" value="tahunan">
      <input type="number" name="tahun" class="form-control me-2" min="2000" max="{{ date('Y') }}"
          value="{{ $tahun }}">
      <button class="btn btn-outline-primary">Filter</button>
  </form>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Untung</th>
            <th>Modal Akhir</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $t)
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($t->bulan)->locale('id')->translatedFormat('F') }}</td>
                <td>@rupiah($t->keuntungan)</td>
                <td>@rupiah($t->modal_per_akhir)</td>
                <td>@rupiah($t->sub_total)</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada data.</td>
            </tr>
        @endforelse
    </tbody>
</table>
