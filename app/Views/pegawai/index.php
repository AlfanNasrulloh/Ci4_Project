<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="card-title">Data Users</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th> <!-- Ubah label dari ID menjadi No -->
                            <!-- <th>Email</th> -->
                            <th>Nama Pegawai</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Pendidikan</th>
                            <th>Gender</th>
                            <th>TMT</th>
                            <th>Jabatan</th>
                            <th>Status Kepegawaian</th>
                            <th>Status Pernikahan</th>
                            <th>No Telp</th>
                            <th>Jumlah Anak</th>
                            <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                            <th>Actions</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $users) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td> <!-- Tambahkan 1 untuk nomor urut -->
                                <!-- <td><?= $users['email'] ?></td> -->
                                <td><?= $users['username'] ?></td>
                                <td><?= $users['tempat_lahir']; ?></td>
                                <td><?= $users['tanggal_lahir']; ?></td>
                                <td><?= $users['agama']; ?></td>
                                <td><?= $users['pendidikan']; ?></td>
                                <td><?= $users['jenkel']; ?></td>
                                <td><?= $users['TMT']; ?></td>
                                <td><?= $users['jabatan']; ?></td>
                                <td><?= $users['status_kepegawaian']; ?></td>
                                <td><?= $users['status_pernikahan']; ?></td>
                                <td><?= $users['no_telp']; ?></td>
                                <td><?= $users['jumlah_anak']; ?></td>
                                <?php if (in_groups('pimpinan') || in_groups('bendahara')) : ?>
                                <td>
                                    <a href="<?= base_url('pegawai/edit/' . $users['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
