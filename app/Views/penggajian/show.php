<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

    <h1>Detail Penggajian</h1>
    <ul>
        <li>ID Penggajian: <?= $penggajian['id_penggajian'] ?></li>
        <li>Username: <?= $penggajian['username'] ?></li>
        <li>Golongan: <?= $penggajian['golongan'] ?></li>
        <li>Gaji Pokok: <?= $penggajian['gaji_pokok'] ?></li>
        <li>Gaji Bersih: <?= $penggajian['gaji_bersih'] ?></li>
    </ul>
    <a href="/penggajian/pdf/<?= $penggajian['id_penggajian'] ?>">Cetak Slip Gaji (PDF)</a>
<?= $this->endSection() ?>
