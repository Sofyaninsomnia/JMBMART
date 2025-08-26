<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Penjualan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .container {
            width: 100%;
            padding: 10mm;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #ccc;
        }

        .header .img img {
            width: 50px;
            height: auto;
            margin-bottom: 5px;
        }

        .header .title h3 {
            margin: 0;
            font-size: 18px;
        }

        .header .title h4 {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .header .title p {
            margin: 1px 0;
            font-size: 10px;
            color: #777;
        }

        .info {
            margin-bottom: 15px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 10px;
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .info table td {
            padding: 2px 0;
            vertical-align: top;
        }

        .info-label {
            width: 100px;
            padding-left: 5px;
        }

        .info-value {
            padding-left: 5px;
        }

        .table-items {
            width: 99%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 15px;
        }

        .table-items th,
        .table-items td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        .table-items thead th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .table-items tbody td:nth-child(2) {
            text-align: left;
            padding-left: 8px;
        }

        .table-items tbody td:nth-child(3) {
            text-align: right;
            padding-right: 8px;
        }

        .table-items tbody td:nth-child(4) {
            text-align: right;
            padding-right: 8px;
        }

        .table-items tbody td:last-child {
            text-align: right;
            padding-right: 8px;
        }

        .table-items th:nth-child(1),
        .table-items td:nth-child(1) {
            width: 5%;
        }

        .table-items th:nth-child(2),
        .table-items td:nth-child(2) {
            width: 40%;
        }

        .table-items th:nth-child(3),
        .table-items td:nth-child(3) {
            width: 15%;
        }

        .table-items th:nth-child(4),
        .table-items td:nth-child(4) {
            width: 20%;
        }

        .table-items th:nth-child(5),
        .table-items td:nth-child(5) {
            width: 20%;
        }


        .total-section {
            border-top: 1px dashed #ccc;
            padding-top: 10px;
            margin-top: 10px;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
            padding-right: 10px;
        }

        .total-section div {
            margin-bottom: 5px;
        }

        .total-section .label-total {
            display: inline-block;
            width: 140px;
            text-align: right;
        }

        .total-section .value-total {
            display: inline-block;
            width: 90px;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #777;
        }

        @media print {

            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                width: initial !important;
                height: initial !important;
                overflow: initial !important;
            }

            @page {
                margin-top: 2cm !important;
                margin-bottom: 1cm !important;
                margin-left: 1cm !important;
                margin-right: 1cm !important;
                size: A4 portrait;
            }

            .container {
                padding: 0 !important;
            }

            header,
            footer,
            nav,
            aside,
            .no-print {
                display: none !important;
            }

            a[href]:after {
                content: none !important;
            }

            body {
                padding-top: 50px !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="img">
                <img src="{{ asset('assets/img/JMB.jpg') }}" alt="Logo">
            </div>
            <div class="title">
                <h3>NOTA PENJUALAN</h3>
                <h4>JMB MART</h4>
                <p>Jl. Raya Cirebon Kuningan KM. 8</p>
                <p>Ciperna, Cirebon</p>
            </div>
        </div>

        <div class="info">
            <table>
                <tr>
                    <td class="info-label">Kode Penjualan</td>
                    <td class="info-value">: {{ $penjualan->kode_penjualan }}</td>
                </tr>
                <tr>
                    <td class="info-label">Nama Pelanggan</td>
                    <td class="info-value">: {{ $penjualan->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <td class="info-label">Tanggal</td>
                    <td class="info-value">:
                        {{ \Carbon\Carbon::parse($penjualan->tanggal)->now(new DateTimeZone('Asia/Jakarta'))->format('d M Y, H:i:s') }}
                        WIB</td>
                </tr>
            </table>
        </div>

        <div class="table-container">
            <table class="table-items">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                        $grandTotalPenjualan = 0;
                    @endphp
                    @forelse ($detail as $p)
                        @php
                            $subTotal = $p->jumlah_keluar * $p->dataBarang->harga_jual;
                            $grandTotalPenjualan += $subTotal;
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->dataBarang->nama_barang }}</td>
                            <td>{{ $p->jumlah_keluar }} {{ $p->dataBarang->package }}</td>
                            <td>@rupiah($p->dataBarang->harga_jual)/{{ $p->dataBarang->package }}</td>
                            <td>@rupiah($subTotal)</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak ada barang yang tercatat untuk
                                penjualan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div><span class="label-total">Total Belanja:</span> <span class="value-total">@rupiah($grandTotalPenjualan)</span>
            </div>
            <div style="text-align: left;">
                <span style="margin-top: 10px; font-size: 12px; font-weight: normal; display: inline-block;">
                    Pembayaran mohon di transfer ke rekening <br>
                    <span style="font-weight: bold;">Bank Mandiri</span>
                </span>

                <div style="margin-top: 1px;">
                    <span style="display: inline-block; width: 80px;  font-weight: normal;">No Rekening</span>  
                    <span style="display: inline-block;">: {{ $norek->nomor }} </span>
                    <br>
                    <span style="display: inline-block; width: 80px;  font-weight: normal;">Atas Nama</span>
                    <span style="display: inline-block;">: {{ $norek->nama }}</span>
                </div>
            <div style="text-align: left;">
                <span style="margin-top: 10px; font-size: 12px; font-weight: normal; display: inline-block;">
                    Setelah melakukan transaksi mohon hubungi admin  <br>
                </span>

                <div style="margin-top: 1px;">
                    <span style="display: inline-block; width: 80px;  font-weight: normal;">No Telp</span>
                    <span style="display: inline-block;">: 0821153822331</span>
                </div>
            </div>

        </div>
    </div>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda!</p>
        <p>Dicetak Pada: {{ \Carbon\Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('d M Y, H:i:s') }} WIB</p>
    </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html