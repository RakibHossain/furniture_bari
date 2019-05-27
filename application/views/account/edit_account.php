<h4>Account Edit</h4>

<form class="form-horizontal" action="<?= base_url("admin/account/update/$edit_account_id") ?>" method="POST">

    <table class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-3">Access Type</th>
                <th class="col-sm-3">Account Category</th>
                <th class="col-sm-3">Account Name</th>
            </tr>

        </thead>

        <tbody>

            <tr>

                <td>
                    <select class="form-control required" name="access_type">
                        <?php foreach ($user_types as $key => $user_type): ?>
                            <option <?= ($user_type->id == $edit_account->access_type) ? 'selected=""' : '' ?> value="<?= $user_type->id ?>"><?= $user_type->type ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td>
                    <select class="form-control required" name="account_category">
                        <option <?= ($edit_account->account_category == 1) ? 'selected=""' : '' ?> value="1">Bank</option>
                        <option <?= ($edit_account->account_category == 2) ? 'selected=""' : '' ?> value="2">Cash</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="account_name" class="form-control required" value="<?= $edit_account->account_name ?>" />
                    <input type="hidden" name="previous_account_name" class="form-control" value="<?= $edit_account->account_name ?>" />
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Save</button>
                </td>

            </tr>

        </tbody>

    </table>

</form>
