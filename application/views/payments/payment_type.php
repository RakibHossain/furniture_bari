<?php if ($type == 'edit_payment_type'): ?>

    <form class="form-horizontal formRoot" action="<?= base_url("admin/payment/update/type/$edit_payment_type_id") ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Payment Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="type" class="form-control required" value="<?= $edit_payment_type->type ?>" />
                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <form class="form-horizontal formRoot" action="<?= base_url('admin/payment/insert/type') ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Payment Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="type" class="form-control required" />
                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <table class="table table-condensed table-hover">

        <thead>

            <tr>
                <th>Payment Type</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($types as $type): ?>

                <tr>
                    <td><?= $type->type ?></td>
                    <td><a href="<?= base_url("admin/payment/edit/type/$type->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("admin/payment/delete/type/$type->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker();

        $(".formRoot").validate();

    });

</script>
