<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="text-right">
        <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
            <a href="<?= base_url('tunjangan/create') ?>" class="btn btn-success mb-3">Tambah Tunjangan Baru</a>
        <?php endif ?>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title text-center">Daftar Tunjangan</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Tunjangan</th>
                            <th>Tunjangan Suami/Istri</th>
                            <th>Tunjangan Anak</th>
                            <th>Tunjangan Jabatan</th>
                            <th>Tunjangan Beras</th>
                            <th>Tunjangan Kinerja</th>
                            <th>Uang Makan</th>
                            <th>Sewa Rumah</th>
                            <th>Jumlah Tunjangan</th>
                            <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                                <th>Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tunjangan as $t) : ?>
                            <tr>
                                <td><?= $t->id_tunjangan ?></td>
                                <td><?= $t->nama_tunjangan ?></td>
                                <td><?= 'Rp. ' . number_format($t->tunjangan_suami_istri, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->tunjangan_anak, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->tunjangan_jabatan, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->tunjangan_beras, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->tukin, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->uang_makan, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->sewa_rumah, 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($t->tunjangan_suami_istri + $t->tunjangan_anak + $t->tunjangan_jabatan + $t->tunjangan_beras + $t->tukin + $t->uang_makan + $t->sewa_rumah, 0, ',', '.') ?></td>
                                <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                                    <td>
                                        <a href="<?= base_url('tunjangan/edit/' . $t->id_tunjangan) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('tunjangan/delete/' . $t->id_tunjangan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>