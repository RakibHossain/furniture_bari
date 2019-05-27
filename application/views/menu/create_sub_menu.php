<h4><?= ucfirst($type) ?> SubMenu</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("admin/insert/submenu") : base_url("admin/update/submenu/$edit_sub_menu_id") ?>" method="POST">

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Menu</th>
                <th class="col-sm-2">Sub Menu</th>
                <th class="col-sm-3">URL</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if($type == 'edit'): ?>

                <tr>

                    <td>
                        <select class="form-control required" name="menu_id">
                            <?php foreach ($menus as $menu): ?>
                                <option <?= ($menu->id == $edit_sub_menu->ji_parent_menu_id) ? 'selected=""' : '' ?> value="<?= $menu->id ?>"><?= $menu->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" class="form-control required" value="<?= $edit_sub_menu->name ?>" />
                    </td>
                    <td>
                        <input type="text" name="url" class="form-control required" value="<?= $edit_sub_menu->url ?>" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            <?php else: ?>

                <tr>

                    <td>
                        <select class="form-control required" name="menu_id">
                            <?php foreach ($menus as $menu): ?>
                                <option value="<?= $menu->id ?>"><?= $menu->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="name" class="form-control required"/>
                    </td>
                    <td>
                        <input type="text" name="url" class="form-control required"/>
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
            <th class="col-sm-2">Menu</th>
            <th class="col-sm-2">Sub Menu</th>
            <th class="col-sm-2">URL</th>
            <th class="col-sm-1 text-center">Action</th>
        </tr>

    </thead>

    <tbody id="rows">

        <?php $i = 0; foreach ($sub_menus as $sub_menu): ?>

            <tr>

                <td><?= ++$i ?></td>
                <td><?= $sub_menu->parent_menu_name ?></td>
                <td><?= $sub_menu->name ?></td>
                <td><?= $sub_menu->url ?></td>
                <td><a href="<?= base_url("admin/edit/submenu/$sub_menu->id") ?>" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                <td><a href="<?= base_url("admin/delete/submenu/$sub_menu->id") ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>

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
