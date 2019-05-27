<?php if ($type == 'edit'): ?>

    <h4>Delivery By List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("sales/update/delivery-by/$edit_delivery_by_name_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Delivery By Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="delivery_by_name" class="form-control required" value="<?= $edit_delivery_by_name->delivery_by_name ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Delivery By List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('sales/insert/delivery-by') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Delivery By Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="delivery_by_name" class="form-control required" />
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
                <th>Delivery By Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($delivery_by_names as $key => $delivery_by_name): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $delivery_by_name->delivery_by_name ?></td>
                    <td><a href="<?= base_url("sales/edit/delivery-by/$delivery_by_name->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("sales/delete/delivery-by/$delivery_by_name->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php endif ?>
