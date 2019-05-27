<?php if ($type == 'edit'): ?>

    <h4>Sales Persons</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("sales/update/person/$edit_sales_person_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Person Name: </td>

                    <td class="col-sm-2">
                        <select class="form-control required" name="ji_user_id">

                            <?php foreach ($users as $user): ?>

                                <option <?= ($edit_sales_person->ji_user_id == $user->id) ? 'selected=""' : '' ?> value="<?= $user->id ?>"><?= $user->name ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Sales Persons</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('sales/insert/person') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-2">Person Name: </td>

                    <td class="col-sm-2">
                        <select class="form-control required" name="ji_user_id">

                            <?php foreach ($users as $user): ?>

                                <option value="<?= $user->id ?>"><?= $user->name ?></option>

                            <?php endforeach ?>

                        </select>
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
                <th>Person Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($sales_persons as $key => $sales_person): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $sales_person->name ?></td>
                    <td><a href="<?= base_url("sales/edit/person/$sales_person->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("sales/delete/person/$sales_person->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php endif ?>
