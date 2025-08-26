@extends('components.layout.admin')

@section('content')
    <x-layout.header></x-layout.header>

    <x-layout.aside></x-layout.aside>


    <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    @php $current_keluar = request('filter_keluar', 'semua'); @endphp
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_masuk' => 'semua', 'filter_keluar' => $current_keluar]) }}">Semua</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_masuk' => 'hari', 'filter_keluar' => $current_keluar]) }}">Hari Ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_masuk' => 'bulan', 'filter_keluar' => $current_keluar]) }}">Bulan Ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_masuk' => 'tahun', 'filter_keluar' => $current_keluar]) }}">Tahun Ini</a></li>

                  </ul>
                </div>

                <div class="card-body">
                  @php
                    $label = [
                      'semua' => 'Semua',
                      'hari' => 'Hari Ini',
                      'bulan' => 'Bulan Ini',
                      'tahun' => 'Tahun Ini'
                    ];
                  @endphp
                  <h5 class="card-title">Pembelian <span>| {{ $label[$filter_masuk] ?? 'Semua' }}</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-arrow-in-down"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $barang_masuk->total_masuk ?? 0 }}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    @php $current_masuk = request('filter_masuk', 'semua'); @endphp
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_keluar' => 'semua', 'filter_masuk' => $current_masuk]) }}">Semua</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_keluar' => 'hari', 'filter_masuk' => $current_masuk]) }}">Hari Ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_keluar' => 'bulan', 'filter_masuk' => $current_masuk]) }}">Bulan Ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['filter_keluar' => 'tahun', 'filter_masuk' => $current_masuk]) }}">Tahun Ini</a></li>

                  </ul>
                </div>

                <div class="card-body">
                  @php
                    $label = [
                      'semua' => 'Semua',
                      'hari' => 'Hari Ini',
                      'bulan' => 'Bulan Ini',
                      'tahun' => 'Tahun Ini'
                    ];
                  @endphp
                  <h5 class="card-title">Penjualan <span>| {{ $label[$filter_keluar] ?? 'Semua' }}</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-arrow-in-up"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $barang_keluar->total_keluar ?? 0 }}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Data Barang</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-seam"></i>
                    </div>
                      <div class="ps-3">
                      <h6>{{ $data_barang }}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <div class="col-xxl-4 col-xl-12">
          <div class="card">

            <div class="card-body pb-0">
              <h5 class="card-title">Website Traffic</h5>

              <div id="trafficChart" style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;" class="echart" _echarts_instance_="ec_1752036605111"><div style="position: relative; width: 712px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="712" height="400" style="position: absolute; left: 0px; top: 0px; width: 712px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div class="" style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; box-shadow: rgba(0, 0, 0, 0.2) 1px 2px 10px; transition: opacity 0.2s cubic-bezier(0.23, 1, 0.32, 1), visibility 0.2s cubic-bezier(0.23, 1, 0.32, 1), transform 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgb(255, 255, 255); border-width: 1px; border-radius: 4px; color: rgb(102, 102, 102); font: 14px / 21px &quot;Microsoft YaHei&quot;; padding: 10px; top: 0px; left: 0px; transform: translate3d(78px, 265px, 0px); border-color: rgb(250, 200, 88); pointer-events: none; visibility: hidden; opacity: 0;"><div style="margin: 0px 0 0;line-height:1;"><div style="font-size:14px;color:#666;font-weight:400;line-height:1;">Access From</div><div style="margin: 10px 0 0;line-height:1;"><div style="margin: 0px 0 0;line-height:1;"><span style="display:inline-block;margin-right:4px;border-radius:10px;width:10px;height:10px;background-color:#fac858;"></span><span style="font-size:14px;color:#666;font-weight:400;margin-left:2px">Email</span><span style="float:right;margin-left:20px;font-size:14px;color:#666;font-weight:900">580</span><div style="clear:both"></div></div><div style="clear:both"></div></div><div style="clear:both"></div></div></div></div>

              @php
                $chartData = $stokBarang->map(function($b) {
                  return [
                    'value' => $b->stok,
                    'name'  => $b->nama_barang
                ];
                });  
              @endphp

              <script>
              document.addEventListener("DOMContentLoaded", () => {
                const chartData = 
                  {!! json_encode($chartData) !!};
                console.log(chartData);

                echarts.init(document.querySelector("#trafficChart")).setOption({
                  tooltip: { trigger: 'item' },
                  legend: { top: '5%', left: 'center' },
                  series: [{
                    name: 'Stok Barang',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: { show: false, position: 'center' },
                    emphasis: {
                      label: { show: true, fontSize: '18', fontWeight: 'bold' }
                    },
                    labelLine: { show: false },
                    data: chartData
                  }]
                });
              });
              </script>


            </div>
          </div><!-- End Website Traffic -->
            </div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

  </main>
@endsection
