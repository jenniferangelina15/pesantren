<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        /* Your styles here */
    </style>
</head>
<body>
    <h1>Laporan Kas Keluar</h1>
    <p>Kategori: {{ $kategoriKeluar ? $kategoriKeluar : 'Semua' }}</p>
    <p>Tanggal Mulai: {{ $startMonthKeluar ? $startMonthKeluar : 'Semua' }}</p>
    <p>Tanggal Akhir: {{ $endMonthKeluar ? $endMonthKeluar : 'Semua' }}</p>
    <p>Total Data: {{ $totalDataKeluar }}</p>
    <p>Total Nominal: Rp. {{ number_format($totalKeluar, 2, ',', '.') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kasKeluar as $index => $keluar)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $keluar->tgl }}</td>
                <td>{{ $keluar->kategori }}</td>
                <td>{{ $keluar->keterangan }}</td>
                <td>Rp. {{ number_format($keluar->nominal, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
