<?php if ($type == 'edit'): ?>

    <h4>Order By List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("sales/update/order-by/$edit_order_by_name_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Order By Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="order_by_name" class="form-control required" value="<?= $edit_order_by_name->order_by_name ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Order By List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('sales/insert/order-by') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Order By Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="order_by_name" class="form-control required" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <table class="table table-condensed table-hover">

        <thead>

            <tr>
                <th>#</th>
                <th>Order By Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($order_by_names as $key => $order_by_name): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $order_by_name->order_by_name ?></td>
                    <td><a href="<?= base_url("sales/edit/order-by/$order_by_name->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("sales/delete/order-by/$order_by_name->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php endif ?>
