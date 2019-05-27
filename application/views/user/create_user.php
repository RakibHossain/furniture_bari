<h4><?= ucfirst($type) ?> User</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("admin/insert/user") : base_url("admin/update/user/$edit_user_id") ?>" method="POST">

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">User Type</th>
                <th class="col-sm-2">Name</th>
                <th class="col-sm-2">User Name</th>
                <th class="col-sm-2">Password</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if($type == 'edit'): ?>

                <tr>

                    <td>
                        <select class="form-control required" name="role">

                            <?php foreach ($user_types as $user_type): ?>

                                <option <?= ($user_type->id == $edit_user->role) ? 'selected=""' : '' ?> value="<?= $user_type->id ?>"><?= $user_type->type ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" class="form-control required" value="<?= $edit_user->name ?>" />
                    </td>
                    <td>
                        <input type="text" name="username" class="form-control required" value="<?= $edit_user->username ?>" />
                    </td>
                    <td>
                        <input type="password" name="password" class="form-control required" placeholder="*******" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            <?php else: ?>

                <tr>

                    <td>
                        <select class="form-control required" name="role">

                            <?php foreach ($user_types as $user_type): ?>

                                <option value="<?= $user_type->id ?>"><?= $user_type->type ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" class="form-control required"/>
                    </td>
                    <td>
                        <input type="text" name="username" class="form-control required"/>
                    </td>
                    <td>
                        <input type="password" name="password" class="form-control required" placeholder="*******" />
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
