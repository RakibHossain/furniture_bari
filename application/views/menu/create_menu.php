<h4><?= ucfirst($type) ?> Menu</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("admin/insert/menu") : base_url("admin/update/menu/$edit_menu_id") ?>" method="POST">

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Name</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if($type == 'edit'): ?>

                <tr>
                    <td>
                        <input type="text" name="name" class="form-control required" value="<?= $edit_menu->name ?>" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>
                </tr>

            <?php else: ?>

                <tr>
                    <td>
                        <input type="text" name="name" class="form-control required"/>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>
                </tr>

            <?php endif ?>

        </tbody>

    </table>

</form>

<table class="table">

    <thead>

        <tr>
            <th width="6%">#</th>
            <th class="col-sm-2">Name</th>
            <th class="col-sm-1 text-center">Action</th>
        </tr>

    </thead>

    <tbody id="rows">

        <?php $i = 0; foreach ($menus as $menu): ?>

            <tr>

                <td><?= ++$i ?></td>
                <td><?= $menu->name ?></td>
                <td><a href="<?= base_url("admin/edit/menu/$menu->id") ?>" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                <td><a href="<?= base_url("admin/delete/menu/$menu->id") ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".formRoot").validate();
    });

</script>
