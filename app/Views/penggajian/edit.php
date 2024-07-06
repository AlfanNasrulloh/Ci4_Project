<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <a href="<?= base_url('penggajian'); ?>" class="btn btn-secondary mb-2"><i class="fas fa-home"></i> Kembali</a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Edit Penggajian</h4>
        </div>

        <div class="card-body">
            <form action="<?= base_url('penggajian/update/' . $penggajian['id_penggajian']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $penggajian['username'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="golongan">Golongan</label>
                    <select class="form-control" id="golongan" name="golongan">
                        <option value="I" <?= $penggajian['golongan'] == 'I' ? 'selected' : '' ?>>Golongan I</option>
                        <option value="II" <?= $penggajian['golongan'] == 'II' ? 'selected' : '' ?>>Golongan II</option>
                        <option value="III" <?= $penggajian['golongan'] == 'III' ? 'selected' : '' ?>>Golongan III</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>