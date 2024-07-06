<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="card-title">User Detail</h4>
        </div>

        <div class="card-body">
            <p><strong>ID:</strong> <?= $user->userid ?></p>
            <p><strong>Username:</strong> <?= $user->username ?></p>
            <p><strong>Email:</strong> <?= $user->email ?></p>
            <p><strong>Group:</strong> <?= $user->name ?></p>
            <a href="/user/admin" class="btn btn-secondary">Back to User List</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>