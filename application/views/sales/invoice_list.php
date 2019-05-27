<style type="text/css">

    .filterable 
    {
        margin-top: 15px;
    }

    .filterable .panel-heading .pull-right 
    {
        margin-top: -20px;
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

<div class="row">
    
    <form action="" method="get">
        
        <div class="box-body" id="searchBox">

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label class="control-label">Factory</label>
                <input type="text" id="factory" name="factory" placeholder="Factory" class="form-control" value="<?=isset($_GET['factory']) ? $_GET['factory'] : ''?>">
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label class="control-label">Delivery By</label>
                <input type="text" id="delivery_by" name="delivery_by" placeholder="Delivery By" class="form-control" value="<?=isset($_GET['delivery_by']) ? $_GET['delivery_by'] : ''?>">
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><br>
                <input type="submit" id="filter" value="Filter" class="btn btn-primary btn-sm form-control" />
            </div>

        </div>

    </form>

    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right"><br>
            <a class="btn btn-primary btn-sm form-control" href="<?= base_url('sales/invoice/export') ?>">Export</a>
        </div>

    <?php endif ?>

</div>

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-primary filterable">

            <div class="panel-heading">

                <h3 class="panel-title">&nbsp;</h3>
                <div class="pull-right">
                    <a href="<?= base_url('admin/invoice') ?>" class="btn btn-default btn-xs"><span class="glyphicons glyphicons-plus"></span> Add New</a>
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>

            </div>

            <table id="datatable" class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Order Date" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Delivery Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Customer Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Due" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <th class="text-center">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                        $statusArr = ['-1'=>'Cancel', '1'=>'Pending', '2'=>'Courier', '3'=>'Complete', '4'=>'Due Receipt'];
                        foreach ($data as $key => $value) {
                    ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <?php if ($value->urgency_status == 1): ?>
                                <td style="color: red;"><?= $value->order_no ?></td>
                            <?php else: ?>
                                <td><?= $value->order_no ?></td>
                            <?php endif ?>
                            <td><?= date("m/d/Y", strtotime($value->order_date)) ?></td>
                            <td><?= date("m/d/Y", strtotime($value->delivery_date)) ?></td>
                            <td><?=$value->customer_name?></td>
                            <td><?=$value->mobile_no ?></td>
                            <td><?=$value->total_due ?></td>
                            <td>
                                <?php if (strtotime($value->delivery_date) < strtotime(date("m/d/Y"))): ?>
                                    <span style="color: #BB4931;"><?= $statusArr[$value->status] ?></span>
                                <?php else: ?>
                                    <span><?= $statusArr[$value->status] ?></span>
                                <?php endif ?>   
                            </td>
                            <td>
                                <a href="<?= base_url("admin/invoice/edit/$value->id"); ?>" class="btn btn-sm btn-success" data-id="<?= $value->id ?>"><i class="fa fa-edit"></i></a>
                                <?php if($role == 1): ?>
                                    <button class="btn btn-sm btn-danger delete_row" data-id="<?= $value->id ?>"><i class="fa fa-trash"></i></button>
                                <?php endif ?>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script type="text/javascript">
    
    $(function () 
    {
        $(".date").datepicker();

        $('.delete_row').on('click', function()
        {
            var retConf = confirm('Are you sure you want to delete this row ?');

            if(!retConf)
            {
                return false;
            }

            var id = $(this).attr('data-id');
            var rowNo = $(this).parents('tr').index();  

            $.ajax({
                type: 'POST',
                url: "<?= base_url('admin/invoice/delete') ?>",
                async: true,
                data: {'id': id},
                success: function(data) 
                {
                    if(data == 'ok')
                    {
                        $('.table').find('tbody').find('tr').eq(rowNo).remove();
                    }

                },

            });

        });

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
