<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
<a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary mb-2"><i class="fas fa-home"></i></a>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Edit User</h4>
        </div>

        <div class="card-body">
            <form action="<?= base_url('pegawai/update/' . $users['id']) ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= isset($users['username']) ? $users['username'] : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $users['tempat_lahir'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $users['tanggal_lahir'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select class="form-control" id="agama" name="agama">
                        <option value="Islam" <?= isset($users['agama']) && $users['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                        <option value="Hindhu" <?= isset($users['agama']) && $users['agama'] == 'Hindhu' ? 'selected' : '' ?>>Hindhu</option>
                        <option value="Katolik" <?= isset($users['agama']) && $users['agama'] == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <select class="form-control" id="pendidikan" name="pendidikan">
                        <option value="SMA/SMK" <?= isset($users['pendidikan']) && $users['pendidikan'] == 'SMA/SMK' ? 'selected' : '' ?>>SMA/SMK</option>
                        <option value="D3" <?= isset($users['pendidikan']) && $users['pendidikan'] == 'D3' ? 'selected' : '' ?>>D3</option>
                        <option value="S1" <?= isset($users['pendidikan']) && $users['pendidikan'] == 'S1' ? 'selected' : '' ?>>S1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenkel">Jenis Kelamin</label>
                    <select class="form-control" id="jenkel" name="jenkel">
                        <option value="L" <?= isset($users['jenkel']) && $users['jenkel'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= isset($users['jenkel']) && $users['jenkel'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="TMT">TMT</label>
                    <input type="date" class="form-control" id="TMT" name="TMT" value="<?= $users['TMT'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" id="jabatan" name="jabatan">
                        <option value="HRD" <?= isset($users['jabatan']) && $users['jabatan'] == 'HRD' ? 'selected' : '' ?>>HRD</option>
                        <option value="Supervisor" <?= isset($users['jabatan']) && $users['jabatan'] == 'Supervisor' ? 'selected' : '' ?>>Supervisor</option>
                        <option value="Sales" <?= isset($users['jabatan']) && $users['jabatan'] == 'Sales' ? 'selected' : '' ?>>Sales</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_kepegawaian">Status Kepegawaian</label>
                    <select class="form-control" id="status_kepegawaian" name="status_kepegawaian">
                        <option value="Aktif" <?= isset($users['status_kepegawaian']) && $users['status_kepegawaian'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Tidak Aktif" <?= isset($users['status_kepegawaian']) && $users['status_kepegawaian'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak aktif</option>
                        <option value="Cuti" <?= isset($users['status_kepegawaian']) && $users['status_kepegawaian'] == 'Cuti' ? 'selected' : '' ?>>Cuti</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_pernikahan">Status Pernikahan</label>
                    <select class="form-control" id="status_pernikahan" name="status_pernikahan">
                        <option value="Sudah Menikah" <?= isset($users['status_pernikahan']) && $users['status_pernikahan'] == 'Sudah Menikah' ? 'selected' : '' ?>>Sudah Menikah</option>
                        <option value="Belum Menikah" <?= isset($users['status_pernikahan']) && $users['status_pernikahan'] == 'Belum Menikah' ? 'selected' : '' ?>>Belum Menikah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $users['no_telp'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="jumlah_anak">Jumlah Anak</label>
                    <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="<?= $users['jumlah_anak'] ?? '' ?>">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>