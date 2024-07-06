<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="text-right">
        <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
            <a href="<?= base_url('potongan/create') ?>" class="btn btn-success mb-3">Tambah Potongan Baru</a>
        <?php endif ?>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title text-center">Daftar Potongan</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Potongan</th>
                            <th>Potongan IWP</th>
                            <th>Potongan PPH</th>
                            <th>Bappetarum</th>
                            <th>Jumlah Potongan</th>
                            <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                            <th>Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($potongan as $pot): ?>
                            <tr>
                                <td><?= $pot['id_potongan'] ?></td>
                                <td><?= $pot['nama_potongan'] ?></td>
                                <td><?= 'Rp. ' . number_format($pot['pot_iwp'], 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($pot['pot_pph'], 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($pot['bappetarum'], 0, ',', '.') ?></td>
                                <td><?= 'Rp. ' . number_format($pot['pot_iwp'] + $pot['pot_pph'] + $pot['bappetarum'], 0, ',', '.') ?></td>
                                <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                                <td>
                                    <a href="<?= site_url('potongan/edit/'.$pot['id_potongan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('potongan/delete/'.$pot['id_potongan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
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
