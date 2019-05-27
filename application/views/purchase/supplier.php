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

<?php if($type == 'edit_supplier_type'): ?>

    <h4>Edit Purchase Supplier Type</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/supplier/type/update/$edit_supplier_type_id") ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Supplier Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="type" class="form-control required" value="<?= $edit_supplier_type->type ?>" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php elseif($type == 'new_supplier_type'): ?>

    <h4>Purchase Supplier Type List</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('purchase/supplier/type/insert') ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Supplier Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="type" class="form-control required" />
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
                <th>Supplier Type</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php $i = 0; foreach ($supplier_types as $supplier_type): ?>

                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $supplier_type->type ?></td>
                    <td><a href="<?= base_url("purchase/supplier/type/edit/$supplier_type->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("purchase/supplier/type/delete/$supplier_type->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php elseif ($type == 'edit_supplier'): ?>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/supplier/update/$edit_supplier_id") ?>" method="POST">

        <h4>Purchase Supplier List</h4>

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Name</th>
                    <th class="col-sm-2">Balance</th>
                    <th class="col-sm-2">Address</th>
                    <th class="col-sm-2">Phone No.</th>
                    <th class="col-sm-2">Category</th>
                    <th class="col-sm-2">Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="name" class="form-control required" value="<?= $edit_supplier->name ?>" />
                    </td>

                    <td>
                        <input type="text" readonly="" name="balance" class="form-control required" value="<?= $edit_supplier->balance ?>" />
                    </td>

                    <td>
                        <textarea cols="30" rows="2" name="address" class="form-control required"><?= $edit_supplier->address ?></textarea>
                    </td>

                    <td>
                        <input type="text" name="phone" class="form-control required" value="<?= $edit_supplier->phone ?>" />
                    </td>

                    <td>
                        <select class="form-control" name="supplier_category">
                            <option <?= ($edit_supplier->supplier_category == 'cash') ? 'selected=""' : '' ?> value="cash">Cash</option>
                            <option <?= ($edit_supplier->supplier_category == 'credit') ? 'selected=""' : '' ?> value="credit">Credit</option>
                        </select>
                    </td>

                    <td>
                        <select class="form-control" name="type">
                            <?php foreach ($supplier_types as $supplier_type): ?>
                                <option <?= ($supplier_type->type == $edit_supplier->type) ? 'selected=""' : '' ?> value="<?= $supplier_type->type ?>"><?= $supplier_type->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Purchase Supplier List</h4>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('message') ?> </div>
    <?php endif ?>

    <div class="row">

        <div class="col-sm-2">
            <a href="<?= base_url('purchase/supplier/type') ?>" class="btn btn-primary">Add A New Supplier Type</a>     
        </div>
        
    </div>

    <form class="form-horizontal formRoot" action="<?= base_url('purchase/supplier/insert') ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Name</th>
                    <th class="col-sm-2">Balance</th>
                    <th class="col-sm-2">Address</th>
                    <th class="col-sm-2">Phone No.</th>
                    <th class="col-sm-2">Category</th>
                    <th class="col-sm-2">Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="name" class="form-control required" />
                    </td>

                    <td>
                        <input type="text" name="balance" class="form-control required" />
                    </td>

                    <td>
                        <textarea cols="30" rows="2" name="address" class="form-control required"></textarea>
                    </td>

                    <td>
                        <input type="text" name="phone" class="form-control required" />
                    </td>

                    <td>
                        <select class="form-control" name="supplier_category">
                            <option value="cash">Cash</option>
                            <option value="credit">Credit</option>
                        </select>
                    </td>

                    <td>
                        <select class="form-control" name="type">
                            <?php foreach ($supplier_types as $supplier_type): ?>
                                <option value="<?= $supplier_type->type ?>"><?= $supplier_type->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>

                    <td style="text-align: right;">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
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
                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Balance" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Phone No." disabled></th>
                    <th><input type="text" class="form-control" placeholder="Category" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Type" disabled></th>
                    <th class="text-center">Action</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($suppliers as $key => $supplier): ?>

                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $supplier->name ?></td>
                        <td><?= $supplier->balance ?></td>
                        <td><?= $supplier->phone ?></td>
                        <td><?= $supplier->supplier_category ?></td>
                        <td><?= $supplier->type ?></td>
                        <td>
                            <a href="<?= base_url("purchase/supplier/edit/$supplier->id") ?>" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                                <a href="<?= base_url("purchase/supplier/delete/$supplier->id") ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php endif ?>
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
        $(".date").datepicker();
        $(".formRoot").validate();

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
