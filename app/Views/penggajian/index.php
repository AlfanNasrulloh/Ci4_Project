<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="text-right">
        <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
            <a href="<?= base_url('penggajian/laporan') ?>" class="btn btn-info mb-3">Laporan Keuangan</a>
            <a href="<?= base_url('penggajian/create') ?>" class="btn btn-success mb-3">Tambah Penggajian Baru</a>
        <?php endif ?>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title text-center">Daftar Penggajian</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Penggajian</th>
                            <th>Username</th>
                            <th>Golongan</th>
                            <th>Gaji Pokok</th>
                            <th>Jumlah Tunjangan</th>
                            <th>Jumlah Potongan</th>
                            <th>Gaji Bersih</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $gaji) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $gaji['id_penggajian'] ?></td>
                                <td><?= $gaji['username'] ?></td>
                                <td><?= $gaji['golongan'] ?></td>
                                <td><?= 'Rp. ' . number_format($gaji['gaji_pokok'], 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($gaji['jumlah_tunjangan'], 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($gaji['jumlah_potongan'], 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($gaji['gaji_bersih'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if (in_groups('karyawan') || in_groups('bendahara')) : ?>
                                        <a href="<?= base_url('penggajian/pdf/' . $gaji['id_penggajian']) ?>" class="btn btn-sm btn-info">Slip Gaji</a>
                                    <?php endif ?>
                                    <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                                        <a href="<?= base_url('penggajian/edit/' . $gaji['id_penggajian']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('penggajian/delete/' . $gaji['id_penggajian']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>