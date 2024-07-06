<?= $this->extend('templates/index') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="d-flex justify-content-end mb-2">
    <?php if (in_groups('pimpinan')) : ?>
        <a href="<?= base_url('addUser') ?>" class="btn btn-success">Add User</a>
        <?php endif ?>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="card-title">Users List</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Group</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->name ?></td>
                                <td>
                                    <a href="/user/detail/<?= $user->userid ?>" class="btn btn-info btn-sm">Detail</a>
                                    <form action="<?= base_url('user/delete/' . $user->userid) ?>" method="post" style="display:inline-block;">
                                        <?= csrf_field() ?>
                                        <?php if (in_groups('pimpinan')) : ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                        <?php endif ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?= $this->endSection() ?>
