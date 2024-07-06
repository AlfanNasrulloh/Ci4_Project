<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <a href="<?= base_url('tunjangan'); ?>" class="btn btn-secondary mb-2"><i class="fas fa-home"></i> Kembali</a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Edit Tunjangan</h4>
        </div>

        <div class="card-body">
            <form action="<?= base_url('tunjangan/update/' . $tunjangan->id_tunjangan) ?>" method="post">
                <div class="form-group">
                    <label for="nama_tunjangan">Nama Tunjangan</label>
                    <input type="text" class="form-control" id="nama_tunjangan" name="nama_tunjangan" value="<?= $tunjangan->nama_tunjangan ?>">
                </div>
                <div class="form-group">
                    <label for="jumlah_tunjangan">Jumlah Tunjangan</label>
                    <input type="number" class="form-control" id="jumlah_tunjangan" name="jumlah_tunjangan" value="<?= $tunjangan->jumlah_tunjangan ?>">
                </div>
                <div class="form-group">
                    <label for="tunjangan_suami_istri">Tunjangan Suami/Istri</label>
                    <input type="number" class="form-control" id="tunjangan_suami_istri" name="tunjangan_suami_istri" value="<?= $tunjangan->tunjangan_suami_istri ?>">
                </div>
                <div class="form-group">
                    <label for="tunjangan_anak">Tunjangan Anak</label>
                    <input type="number" class="form-control" id="tunjangan_anak" name="tunjangan_anak" value="<?= $tunjangan->tunjangan_anak ?>">
                </div>
                <div class="form-group">
                    <label for="tunjangan_jabatan">Tunjangan Jabatan</label>
                    <input type="number" class="form-control" id="tunjangan_jabatan" name="tunjangan_jabatan" value="<?= $tunjangan->tunjangan_jabatan ?>">
                </div>
                <div class="form-group">
                    <label for="tunjangan_beras">Tunjangan Beras</label>
                    <input type="number" class="form-control" id="tunjangan_beras" name="tunjangan_beras" value="<?= $tunjangan->tunjangan_beras ?>">
                </div>
                <div class="form-group">
                    <label for="tukin">Tukin</label>
                    <input type="number" class="form-control" id="tukin" name="tukin" value="<?= $tunjangan->tukin ?>">
                </div>
                <div class="form-group">
                    <label for="uang_makan">Uang Makan</label>
                    <input type="number" class="form-control" id="uang_makan" name="uang_makan" value="<?= $tunjangan->uang_makan ?>">
                </div>
                <div class="form-group">
                    <label for="sewa_rumah">Sewa Rumah</label>
                    <input type="number" class="form-control" id="sewa_rumah" name="sewa_rumah" value="<?= $tunjangan->sewa_rumah ?>">
                </div>

                <!-- Add other fields here -->

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
