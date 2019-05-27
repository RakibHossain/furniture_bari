<div class="pull-right">
    <a href="<?= base_url('admin/create/user') ?>" class="btn btn-info btn-xm"><span class="glyphicons glyphicons-plus"></span> Add New</a>
</div>

<table class="table order-list">

    <thead>

        <tr>
            <th width="6%">#</th>
            <th class="col-sm-2">Name</th>
            <th class="col-sm-2">User Name</th>
            <th class="col-sm-2 text-center">Action</th>
        </tr>

    </thead>

    <tbody id="rows">

        <?php $i = 0; foreach ($users as $user): ?>

            <tr>

                <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>

                    <td><?= ++$i ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->username ?></td>
                    <td><a href="<?= base_url("admin/edit/user/$user->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("admin/delete/user/$user->id") ?>" class="btn btn-danger">Delete</a></td>

                <?php else: ?>
                    
                    <?php if ($user->role != 1): ?>
                        
                        <td><?= ++$i ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->username ?></td>
                        <td><a href="<?= base_url("admin/edit/user/$user->id") ?>" class="btn btn-success">Edit</a></td>
                        
                    <?php endif ?>

                <?php endif ?>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>
