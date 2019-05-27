<style type="text/css">

    .filterable 
    {
        margin-top: 15px;
    }

    .filterable .filters input[disabled] 
    {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }

    .filterable .filters input[disabled]::-webkit-input-placeholder 
    {
        color: #333;
    }

    .filterable .filters input[disabled]::-moz-placeholder 
    {
        color: #333;
    }

    .filterable .filters input[disabled]:-ms-input-placeholder 
    {
        color: #333;
    }
    
</style>

<?php if($type == 'edit_item_group'): ?>

    <h4>Edit Purchase Item Group</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/item/group/update/$edit_item_group_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Group Name</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="item_Group_name" class="form-control required" value="<?= $edit_item_group->item_group_name ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php elseif($type == 'group'): ?>

    <h4>Purchase Item Group's List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('purchase/item/group/insert') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Group Name</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="item_Group_name" class="form-control required" />
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
                <th>Item Group Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($item_groups as $item_group): ?>

                <tr>
                    <td><?= $item_group->item_group_name ?></td>
                    <td><a href="<?= base_url("purchase/item/group/edit/$item_group->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("purchase/item/group/delete/$item_group->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php elseif($type == 'edit_item_name'): ?>

    <h4>Edit Purchase Item Name</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/update/item/name/$edit_item_name_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Item Name</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="item_name" class="form-control required" value="<?= $edit_item_name->item_name ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php elseif($type == 'item_name'): ?>

    <h4>Purchase Item Name's List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('purchase/insert/item/name') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Item Name</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="item_name" class="form-control required" />
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
                <th>Item Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($item_names as $item_name): ?>

                <tr>
                    <td><?= $item_name->item_name ?></td>
                    <td><a href="<?= base_url("purchase/edit/item/name/$item_name->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("purchase/delete/item/name/$item_name->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php elseif($type == 'edit_item'): ?>

    <h4>Edit Purchase Item</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/item/update/$edit_item_id") ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Item Name</th>
                    <th class="col-sm-2">Item Code</th>
                    <th class="col-sm-3">Item Group</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <select class="form-control" name="item_name">

                            <?php foreach ($item_names as $item_name): ?>

                                <option <?= ($item_name->item_name == $edit_item->item_name) ? 'selected=""' : '' ?> value="<?= $item_name->item_name ?>"><?= $item_name->item_name ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>

                    <td>
                        <input type="text" name="item_code" class="form-control required" value="<?= $edit_item->item_code ?>" />
                    </td>

                    <td>
                        
                        <select class="form-control" name="item_group">

                            <?php foreach ($item_groups as $item_group): ?>

                                <option <?= ($item_group->item_group_name == $edit_item->item_group) ? 'selected=""' : '' ?> value="<?= $item_group->item_group_name ?>"><?= $item_group->item_group_name ?></option>

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

    <div class="row">

        <div class="col-md-3">

           <h4>Purchase Item's List</h4>
            
        </div>

    </div>

    <form class="form-horizontal formRoot" action="<?= base_url('purchase/item/insert') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Item Name</th>
                    <th class="col-sm-2">Item Code</th>
                    <th class="col-sm-3">Item Group</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <select class="form-control required" name="item_name">

                            <option>Select Item</option>
                            <?php foreach ($item_names as $item_name): ?>

                                <option value="<?= $item_name->item_name ?>"><?= $item_name->item_name ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>

                    <td>
                        <input type="text" name="item_code" class="form-control required" />
                    </td>

                    <td>
                        
                        <select class="form-control required" name="item_group">

                            <option>Select Item Group</option>
                            <?php foreach ($item_groups as $item_group): ?>

                                <option value="<?= $item_group->item_group_name ?>"><?= $item_group->item_group_name ?></option>

                            <?php endforeach ?>

                        </select>

                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                    <td>
                        <a href="<?= base_url('purchase/create/item/name') ?>" class="btn btn-primary">Add A New Item</a>
                    </td>

                    <td>
                        <a href="<?= base_url('purchase/item/group') ?>" class="btn btn-primary">Add A New Item Group</a>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <div class="filterable">

        <div class="pull-right">
            <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>

        <table id="datatable" class="table table-condensed table-hover">

            <thead>

                <tr class="filters">
                    <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Item Name" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Item Code" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Item Group" disabled></th>
                    <th class="text-center">Action</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($items as $key => $item): ?>

                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $item->item_name ?></td>
                        <td><?= $item->item_code ?></td>
                        <td><?= $item->item_group ?></td>
                        <td>
                            <a href="<?= base_url("purchase/item/edit/$item->id") ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url("purchase/item/delete/$item->id") ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                <?php endforeach ?>

            </tbody>

        </table>

    </div>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".formRoot").validate();
        $(".date").datepicker().datepicker("setDate", new Date());

        // click on filter button
        $('.filterable .btn-filter').click(function()
        {
            var $panel   = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody   = $panel.find('.table tbody');

            if ($filters.prop('disabled') == true) 
            {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } 
            else 
            {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }

        });

        // // custom filter event
        // $('.filterable .filters input').on('keyup change', function(e)
        // {
        //     /* Ignore tab key */
        //     var code = e.keyCode || e.which;

        //     if (code == '9') return;
            
        //     /* Useful DOM data and selectors */
        //     var $input = $(this),
        //     inputContent = $input.val().toLowerCase(),
        //     $panel = $input.parents('.filterable'),
        //     column = $panel.find('.filters th').index($input.parents('th')),
        //     $table = $panel.find('.table'),
        //     $rows = $table.find('tbody tr');

        //     /* Worst filter function ever */
        //     var $filteredRows = $rows.filter(function()
        //     {
        //         var value = $(this).find('td').eq(column).text().toLowerCase();
        //         return value.indexOf(inputContent) === -1;
        //     });

        //     /* Clean previous no-result if exist */
        //     $table.find('tbody .no-result').remove();

        //     /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        //     $rows.show();
        //     $filteredRows.hide();

        //     /* Prepend no-result row if all rows are filtered */
        //     if ($filteredRows.length === $rows.length) 
        //     {
        //         $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        //     }

        // });

        // DataTable
        var table = $('#datatable').DataTable();
     
        // Apply the search
        table.columns().every(function () {
            var datatableColumn = this;
            var searchTextBoxes = $(this.header()).find('input');

            searchTextBoxes.on('keyup change', function () {

                if (datatableColumn.search() !== this.value) {
                    datatableColumn.search(this.value).draw();
                }

            });

        });

    });

</script>
