<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Kas</h2>

    <h3>Filter Kas Masuk</h3>
    <p>Kategori: {{ $kategoriMasuk ?? 'Semua' }}</p>
    <p>Periode: {{ $startMonthMasuk ?? 'Semua' }} - {{ $endMonthMasuk ?? 'Semua' }}</p>

    <h3>Filter Kas Keluar</h3>
    <p>Kategori: {{ $kategoriKeluar ?? 'Semua' }}</p>
    <p>Periode: {{ $startMonthKeluar ?? 'Semua' }} - {{ $endMonthKeluar ?? 'Semua' }}</p>

    <h3>Kas Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kasMasuk as $index => $masuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $masuk->tgl }}</td>
                    <td>{{ $masuk->kategori }}</td>
                    <td>{{ $masuk->nominal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Kas Keluar</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kasKeluar as $index => $keluar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $keluar->tgl }}</td>
                    <td>{{ $keluar->kategori }}</td>
                    <td>{{ $keluar->nominal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Rekapitulasi</h3>
    <p>Total Kas Masuk: {{ $totalMasuk }}</p>
    <p>Total Kas Keluar: {{ $totalKeluar }}</p>
    <p>Selisih: {{ $totalMasuk - $totalKeluar }}</p>
</body>
</html>
