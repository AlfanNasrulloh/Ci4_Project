<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <a href="<?= base_url('penggajian'); ?>" class="btn btn-secondary mb-2"><i class="fas fa-home"></i> Kembali</a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Tambah Penggajian</h4>
        </div>

        <div class="card-body">
            <form action="<?= base_url('penggajian/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <select class="form-control" id="username" name="username">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="golongan">Golongan</label>
                    <select class="form-control" id="golongan" name="golongan">
                        <option value="I">Golongan I</option>
                        <option value="II">Golongan II</option>
                        <option value="III">Golongan III</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_tunjangan">Tunjangan</label>
                    <select  class="form-control" id="id_tunjangan" name="id_tunjangan[]">
                        <?php foreach ($tunjangan as $t) : ?>
                            <option value="<?= $t->id_tunjangan ?>"><?= $t->nama_tunjangan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_potongan">Potongan</label>
                    <select class="form-control" id="id_potongan" name="id_potongan">
                        <?php foreach ($potongan as $p) : ?>
                            <option value="<?= $p['id_potongan'] ?>"><?= $p['nama_potongan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
