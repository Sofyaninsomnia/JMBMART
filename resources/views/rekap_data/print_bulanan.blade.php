<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        .header-info {
            margin-bottom: 15px;
        }
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        .info-label {
            width: 80px;
            font-weight: bold;
        }
        .info-colon {
            padding-right: 5px;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header-info">
        <div class="info-row">
            <div class="info-label">USER</div>
            <div>: {{ auth()->user()->name ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">BULAN</div>
            <div>: {{ $bulan }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keuntungan</th>
                <th>Modal Per Akhir</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalKeuntungan = 0;
                $totalModal = 0;
                $totalSub = 0;
            @endphp

            @foreach ($rekapBulanan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>@rupiah($item->keuntungan)</td>
                    <td>@rupiah($item->modal_per_akhir)</td>
                    <td>@rupiah($item->sub_total)</td>
                </tr>
                @php
                    $totalKeuntungan += $item->keuntungan;
                    $totalModal += $item->modal_per_akhir;
                    $totalSub += $item->sub_total;
                @endphp
            @endforeach

            <tr>
                <th>Total</th>
                <th>@rupiah($totalKeuntungan)</th>
                <th>@rupiah($totalModal)</th>
                <th>@rupiah($totalSub)</th>
            </tr>
        </tbody>
    </table>

</body>
</html>