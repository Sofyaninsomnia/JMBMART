@extends('components.layout.admin')

@section('content')
    <x-layout.header/>
    <x-layout.aside/>

    <main id="main" class="main">
      <div class="pagetitle"><h1>Rekap data</h1></div>
      <section class="section">
        <div class="card">
          <div class="card-body">

            <ul class="nav nav-tabs mt-3 mb-3">
              @foreach(['harian'=>'Rekap Harian','bulanan'=>'Rekap Bulanan','tahunan'=>'Rekap Tahunan'] as $key=>$label)
                <li class="nav-item">
                  <a
                    class="nav-link {{ $mode==$key?'active':'' }}"
                    href="{{ route('rekap.index', array_merge(request()->except('page'), ['mode'=>$key])) }}">
                    {{ $label }}
                  </a>
                </li>
              @endforeach
            </ul>

            @if($mode=='harian')
              @include('rekap_data.partials.harian', ['data'=>$rekapHarian])
            @elseif($mode=='bulanan')
              @include('rekap_data.partials.bulanan', [
                'data'=>$rekapBulanan,
                'bulan'=>$bulanParam
              ])
            @else
              @include('rekap_data.partials.tahunan', [
                'data'=>$rekapTahunan,
                'tahun'=>$tahunParam
              ])
            @endif

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
                        text: "Data akan dihapus secara permanen!!",
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
