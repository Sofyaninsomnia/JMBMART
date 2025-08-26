<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekap Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .page-container {
            padding: 10mm;
        }

        /* Override default Bootstrap table border untuk konsistensi */
        table.table-bordered { /* Target spesifik table-bordered Bootstrap */
            border: 1px solid #000; /* Garis luar tabel utama */
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000; /* Garis sel tetap hitam */
            padding: 4px 6px; /* Sedikit tambah padding horizontal untuk ruang bernafas */
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
            vertical-align: middle; /* Menjaga teks di tengah vertikal */
        }

        /* Styling untuk bagian info Hari/Tanggal */
        .info-section {
            margin-bottom: 15px;
            /* border-bottom: 1px dashed #ccc; */
            padding-bottom: 10px;
        }

        .info-section table {
            width: auto;
            border-collapse: collapse;
            font-size: 11px;
            margin-left: 0 !important; /* Pastikan rata kiri penuh */
        }

        .info-section table td {
            padding: 2px 0;
            vertical-align: top;
            border: none !important;
        }

        .info-label {
            width: 80px;
        }

        /* Penyesuaian untuk tabel data utama */
        .table-data thead th {
            text-align: center;
        }

        /* Penjajaran untuk kolom teks 'NAMA BARANG' */
        .table-data td:nth-child(2) { /* NAMA BARANG adalah kolom ke-2 */
            text-align: left !important;
        }

        /* Penjajaran untuk kolom angka (numerik) */
        .table-data td:nth-child(1), /* NO */
        .table-data td:nth-child(4), /* Stok Awal */
        .table-data td:nth-child(5), /* Pembelian */
        .table-data td:nth-child(6), /* Penjualan */
        .table-data td:nth-child(7), /* Stok Akhir */
        .table-data td:nth-child(8), /* Harga Beli */
        .table-data td:nth-child(9), /* Harga Jual */
        .table-data td:nth-child(10), /* KEUNTUNGAN */
        .table-data td:nth-child(11), /* Modal Per Akhir */
        .table-data td:nth-child(12) /* SUB TOTAL */
        {
            text-align: right !important;
            padding-right: 8px; /* Tambahkan padding kanan untuk angka */
        }

        /* Penjajaran khusus untuk header angka (Harga, Keuntungan, Modal, Sub Total) */
        .table-data th:nth-child(8), /* Harga Beli (di baris kedua) */
        .table-data th:nth-child(9), /* Harga Jual (di baris kedua) */
        .table-data th:nth-child(10), /* KEUNTUNGAN */
        .table-data th:nth-child(11), /* Modal Per Akhir */
        .table-data th:nth-child(12) /* SUB TOTAL */
        {
            text-align: right !important;
            padding-right: 8px; /* Sesuaikan dengan padding angka */
        }

        /* Untuk baris "Total" di bagian bawah */
        .table-data tbody tr:last-child th {
            font-weight: bold;
            background-color: #f0f0f0;
            border-top: 2px solid #000;
        }

        .table-data tbody tr:last-child th:first-child {
            text-align: center !important;
            padding-left: 6px; /* Pastikan tidak terlalu mepet ke kiri */
        }

        .table-data tbody tr:last-child th:not(:first-child) {
            text-align: right !important;
            padding-right: 8px;
        }

        /* Custom margin/padding for the colon in the info table */
        .info-colon {
            padding-right: 3px !important;
            padding-left: 3px !important;
        }

        /* Media Print Specific - untuk memastikan di cetak tetap rapi */
        @media print {
            .page-container {
                padding: 10mm;
            }
            .info-section table {
                margin-left: 0 !important; /* Penting untuk print */
            }
            .table-data {
                margin-top: 15px !important;
            }
        }

    </style>
</head>

<body onload="window.print()">

    <div class="page-container">
        <div class="info-section">
            <table class="table no-border m-0 p-0">
                <tr>
                    <td class="no-border text-bold info-label text-start">HARI</td>
                    <td class="no-border info-colon">:</td>
                    <td class="no-border info-value text-start">{{ \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('l') }}</td>
                </tr>
                <tr>
                    <td class="no-border text-bold info-label text-start">TANGGAL</td>
                    <td class="no-border info-colon">:</td>
                    <td class="no-border info-value text-start">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td> {{-- Perbaikan kecil di sini, ada double F --}}
                </tr>
            </table>
        </div>

        <table class="table table-bordered table-data mt-3"> {{-- mt-3 untuk margin-top Bootstrap --}}
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">NAMA BARANG</th>
                    <th rowspan="2">SST</th>
                    <th rowspan="2">Stok Awal</th>
                    <th rowspan="2">Pembelian</th>
                    <th rowspan="2">Penjualan</th>
                    <th rowspan="2">Stok Akhir</th>
                    <th colspan="2">Harga</th>
                    <th rowspan="2">KEUNTUNGAN</th>
                    <th rowspan="2">Modal Per Akhir</th>
                    <th rowspan="2">SUB TOTAL</th>
                </tr>
                <tr>
                    <th>Beli</th>
                    <th>Jual</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $totalKeuntungan = 0;
                    $totalModal = 0;
                    $totalSub = 0;
                @endphp

                @foreach ($dataRekap as $item)
                    <tr>
                        <td>{{ str_pad($no++, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['satuan'] }}</td>
                        <td>{{ $item['stok_awal'] }}</td>
                        <td>{{ $item['pembelian'] }}</td>
                        <td>{{ $item['penjualan'] }}</td>
                        <td>{{ $item['stok_akhir'] }}</td>
                        <td>@rupiah($item['harga_beli'])</td>
                        <td>@rupiah($item['harga_jual'])</td>
                        <td>@rupiah($item['keuntungan'])</td>
                        <td>@rupiah($item['modal_per_akhir'])</td>
                        <td>@rupiah($item['sub_total'])</td>
                    </tr>

                    @php
                        $totalKeuntungan += $item['keuntungan'];
                        $totalModal += $item['modal_per_akhir'];
                        $totalSub += $item['sub_total'];
                    @endphp
                @endforeach

                <tr class="total-row">
                    <th colspan="9">Total</th>
                    <th>@rupiah($totalKeuntungan)</th>
                    <th>@rupiah($totalModal)</th>
                    <th>@rupiah($totalSub)</th>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5LzTz4fR6d4jJ3kGkFmS95iMhI3Q8Q7v4D9k/p3fK" crossorigin="anonymous"></script>
</body>

</html>