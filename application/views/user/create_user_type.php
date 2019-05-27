<h4><?= ucfirst($type) ?> User Type</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("admin/insert/user/type") : base_url("admin/update/user/type/$edit_user_type_id") ?>" method="POST">

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">User Type</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if($type == 'edit'): ?>

                <tr>

                    <td>
                        <input type="text" name="type" class="form-control required" value="<?= $edit_user_type->type ?>" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            <?php else: ?>

                <tr>

                    <td>
                        <input type="text" name="type" class="form-control required"/>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            <?php endif ?>

        </tbody>

    </table>

</form>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".formRoot").validate();
    });

</script>
