<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details table th,
        .details table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .details table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Slip Gaji</h1>
        </div>
        <div class="details">
            <table>
                <tr>
                    <th>ID Penggajian</th>
                    <td><?= $penggajian['id_penggajian'] ?></td>
                </tr>
                <tr>
                    <th>Nama Karyawan</th>
                    <td><?= $penggajian['username'] ?></td>
                </tr>
                <tr>
                    <th>Golongan</th>
                    <td><?= $penggajian['golongan'] ?></td>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <td>Rp <?= number_format($penggajian['gaji_pokok'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Gaji Bersih</th>
                    <td>Rp <?= number_format($penggajian['gaji_bersih'], 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
