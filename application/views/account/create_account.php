<h4>Account's List</h4>

<form class="form-horizontal formRoot" action="<?= base_url('admin/insert/account') ?>" method="POST">

    <table class="table">

        <thead>

            <tr>
                <th>Date</th>
                <th>Access Type</th>
                <th>Account Category</th>
                <th>Account Name</th> 
            </tr>

        </thead>

        <tbody>

            <tr>
                <td>
                    <input type="text" name="date" class="form-control date" />
                </td>
                <td>
                    <select class="form-control required" name="access_type">
                        <?php foreach ($user_types as $key => $user_type): ?>
                            <option value="<?= $user_type->id ?>"><?= $user_type->type ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td>
                    <select class="form-control required" name="account_category">
                        <option value="1">Bank</option>
                        <option value="2">Cash</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="account_name" class="form-control required" />
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
            <th>Date</th>
            <th>Account Category</th>
            <th>Account Name</th>
            <th class="text-center">Action</th>
        </tr>

    </thead>

    <tbody>

        <tr>

            <?php 

                foreach ($accounts as $key => $account): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $account->date ?></td>
                    <td>
                        <?= ($account->account_category == 1) ? 'Bank' : 'Cash' ?>
                    </td>
                    <td><?= $account->account_name ?></td>
                    <td><a href="<?= base_url("admin/account/edit/$account->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("admin/account/delete/$account->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tr>

    </tbody>

</table>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker().datepicker("setDate", new Date());
        $(".formRoot").validate();
    });

</script>
