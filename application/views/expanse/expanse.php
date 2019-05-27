<?php if ($type == 'edit_category'): ?>

    <h4>Edit Category</h4>

    <form class="form-horizontal" id="formRoot" action="<?= base_url("admin/expanse/update/category/$edit_category_id") ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Category Name</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="expanse_category_name" class="form-control required" value="<?= $edit_expanse_category->expanse_category_name ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php elseif ($type == 'category'): ?>

    <h4>Category List</h4>
    
    <form class="form-horizontal" id="formRoot" action="<?= base_url('admin/expanse/insert/category') ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Category Name</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="expanse_category_name" class="form-control required" />
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
                <th>Category Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($expanse_categories as $expanse_category): ?>

                <tr>
                    <td><?= $expanse_category->expanse_category_name ?></td>
                    <td><a href="<?= base_url("admin/expanse/edit/category/$expanse_category->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("admin/expanse/delete/category/$expanse_category->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php elseif ($type == 'edit_expanse'): ?>

    <h4>Edit Expanse</h4>

    <form class="form-horizontal" id="formRoot" action="<?= base_url("admin/update/expanse/$edit_expanse_id") ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Expanse Name</th>
                    <th class="col-sm-3">Expanse Category</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="expanse_name" class="form-control required" value="<?= $edit_expanse->expanse_name ?>" />
                    </td>

                    <td>
                        
                        <select class="form-control" name="expanse_category">

                            <?php foreach ($expanse_categories as $expanse_category): ?>

                                <option <?= ($expanse_category->expanse_category_name == $edit_expanse->expanse_category ? 'selected=""' : '') ?> value="<?= $expanse_category->expanse_category_name ?>"><?= $expanse_category->expanse_category_name ?></option>

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

    <form class="form-horizontal" id="formRoot" action="<?= base_url('admin/expanse/insert') ?>" method="POST">

        <h4>Expanse List</h4>

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Expanse Name</th>
                    <th class="col-sm-3">Expanse Category</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="expanse_name" class="form-control required" />
                    </td>

                    <td>
                        
                        <select class="form-control" name="expanse_category">

                            <?php foreach ($expanse_categories as $expanse_category): ?>

                                <option value="<?= $expanse_category->expanse_category_name ?>"><?= $expanse_category->expanse_category_name ?></option>

                            <?php endforeach ?>
                            

                        </select>

                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </td>

                    <td style="text-align: right;">
                        <a href="<?= base_url('admin/expanse/category') ?>" class="btn btn-primary">Add A New Expanse Category</a>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <table class="table table-condensed table-hover">

        <thead>

            <tr>
                <th>#</th>
                <th>Expanse Name</th>
                <th>Expanse Category</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($expanses as $key => $expanse): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $expanse->expanse_name ?></td>
                    <td><?= $expanse->expanse_category ?></td>
                    <td><a href="<?= base_url("admin/edit/expanse/$expanse->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("admin/delete/expanse/$expanse->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $("#formRoot").validate();
    });

</script>
