<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Tahunan</title>
    <style>
        @page {
            size: landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 10px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header-info">
        <div class="info-row">
            <div class="info-label">USER</div>
            <div>: {{ $user }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">TAHUN</div>
            <div>: {{ $tahun }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>BULAN</th>
                <th>KEUNTUNGAN</th>
                <th>MODAL PER AKHIR</th>
                <th>SUB TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalKeuntungan = 0;
                $totalModal = 0;
                $totalSub = 0;
            @endphp

            @foreach ($rekapTahunan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::create()->month($item->bulan)->locale('id')->translatedFormat('F') }}</td>
                    <td class="text-right">@rupiah($item->keuntungan)</td>
                    <td class="text-right">@rupiah($item->modal_per_akhir)</td>
                    <td class="text-right">@rupiah($item->sub_total)</td>
                </tr>
                @php
                    $totalKeuntungan += $item->keuntungan;
                    $totalModal += $item->modal_per_akhir;
                    $totalSub += $item->sub_total;
                @endphp
            @endforeach

            <tr class="total-row">
                <td>TOTAL</td>
                <td class="text-right">@rupiah($totalKeuntungan)</td>
                <td class="text-right">@rupiah($totalModal)</td>
                <td class="text-right">@rupiah($totalSub)</td>
            </tr>
        </tbody>
    </table>

    <script>
        window.onafterprint = function() {
            window.close();
        };
    </script>
</body>
</html>