<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Laporan Keuangan</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Penggajian</th>
                    <th>Nama Pwgawai</th>
                    <th>Golongan</th>
                    <th>Gaji Pokok</th>
                    <th>Jumlah Tunjangan</th>
                    <th>Jumlah Potongan</th>
                    <th>Gaji Bersih</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($penggajian as $gaji) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $gaji['id_penggajian'] ?></td>
                        <td><?= $gaji['username'] ?></td>
                        <td><?= $gaji['golongan'] ?></td>
                        <td><?= $gaji['gaji_pokok'] ?></td>
                        <td><?= $gaji['jumlah_tunjangan'] ?></td>
                        <td><?= $gaji['jumlah_potongan'] ?></td>
                        <td><?= $gaji['gaji_bersih'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= site_url('penggajian') ?>" class="btn btn-secondary">Cancel</a>
        <a href="<?= site_url('penggajian/excel') ?>" class="btn btn-success">Download Excel</a>
    </div>
</body>

</html>