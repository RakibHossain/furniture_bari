<?php if ($type == 'edit_reference'): ?>

    <h4>Edit Reference</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("account/update/reference/$edit_reference_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Reference Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="reference_name" class="form-control required" value="<?= $edit_reference->reference_name ?>" />
                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Reference's List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('account/insert/reference') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Reference Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="reference_name" class="form-control required" />
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
                <th>#</th>
                <th>Reference Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <tr>

                <?php 

                    foreach ($references as $key => $reference): ?>

                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $reference->reference_name ?></td>
                        <td><a href="<?= base_url("account/edit/reference/$reference->id") ?>" class="btn btn-success">Edit</a></td>
                        <td><a href="<?= base_url("account/delete/reference/$reference->id") ?>" class="btn btn-danger">Delete</a></td>
                    </tr>

                <?php endforeach ?>

            </tr>

        </tbody>

    </table>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker(new Date());

        $(".formRoot").validate();

    });

</script>
