<div class="pull-right">
    <a href="<?= base_url('admin/create/user/type') ?>" class="btn btn-info btn-xm"><span class="glyphicons glyphicons-plus"></span> Add New</a>
</div>

<table class="table order-list">

    <thead>

        <tr>
            <th width="2%">#</th>
            <th class="col-sm-2">Type</th>
            <th class="col-sm-2">Action</th>
        </tr>

    </thead>

    <tbody id="rows">

        <?php $i = 0; foreach ($user_types as $user_type): ?>

            <tr>

                <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>

                    <td><?= ++$i ?></td>
                    <td><?= $user_type->type ?></td>
                    <td><a href="<?= base_url("admin/edit/user/type/$user_type->id") ?>" class="btn btn-success">Edit</a></td>
                    <!-- <td><a href="<?= base_url("admin/delete/user/type/$user_type->id") ?>" class="btn btn-danger">Delete</a></td> -->

                <?php else: ?>
                    
                    <?php if ($user_type->id != 1): ?>

                        <td><?= ++$i ?></td>
                        <td><?= $user_type->type ?></td>
                        <td><a href="<?= base_url("admin/edit/user/type/$user_type->id") ?>" class="btn btn-success">Edit</a></td>
                        
                    <?php endif ?>

                <?php endif ?>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>
