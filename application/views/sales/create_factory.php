<?php if ($type == 'edit'): ?>

    <h4>Factory List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("sales/update/factory/$edit_factory_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Factory Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="factory" class="form-control required" value="<?= $edit_factory->factory ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Factory List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('sales/insert/factory') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Factory Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="factory" class="form-control required" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <table class="table table-condensed table-hover">

        <thead>

            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($factories as $key => $factory): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $factory->factory ?></td>
                    <td><a href="<?= base_url("sales/edit/factory/$factory->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("sales/delete/factory/$factory->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php endif ?>
