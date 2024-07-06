<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <a href="<?= base_url('potongan'); ?>" class="btn btn-secondary mb-2"><i class="fas fa-home"></i> Kembali</a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Tambah Potongan Baru</h4>
        </div>

        <div class="card-body">
            <form action="<?= base_url('potongan/store') ?>" method="post">
                <div class="form-group">
                    <label for="nama_potongan">Nama Potongan</label>
                    <input type="text" class="form-control" id="nama_potongan" name="nama_potongan">
                </div>
                <div class="form-group">
                    <label for="pot_iwp">Potongan IWP</label>
                    <input type="number" class="form-control" id="pot_iwp" name="pot_iwp">
                </div>
                <div class="form-group">
                    <label for="pot_pph">Potongan PPH</label>
                    <input type="number" class="form-control" id="pot_pph" name="pot_pph">
                </div>
                <div class="form-group">
                    <label for="bappetarum">Bappetarum</label>
                    <input type="number" class="form-control" id="bappetarum" name="bappetarum">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
