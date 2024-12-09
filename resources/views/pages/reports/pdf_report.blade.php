<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Laporan Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Total Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item['sku'] }}</td>
                    <td>{{ $item['nama_barang'] }}</td>
                    <td>{{ $item['stok_masuk'] }}</td>
                    <td>{{ $item['stok_keluar'] }}</td>
                    <td>{{ $item['total_stok'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
