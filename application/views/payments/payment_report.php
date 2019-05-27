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

    .table
    { 
        font-size: 12px; 
    }

    .filters .form-control
    { 
        font-size: 12px; 
    }

</style>

<div class="row">

    <form action="" method="get">
        
        <div class="box-body" id="searchBox">

            <div class="col-sm-3 col-md-3">
                <label class="control-label">From Date</label>
                    <input type="text" id="from_date" name="from_date" placeholder="Select From Date" class="form-control date" value="<?=isset($_GET['from_date']) ? $_GET['from_date'] : ''?>">
            </div>

            <div class="col-sm-3 col-md-3">
                <label class="control-label">To Date</label>
                <input type="text" id="to_date" name="to_date" placeholder="Select To Date" class="form-control date" value="<?=isset($_GET['to_date']) ? $_GET['to_date'] : ''?>">
            </div>

            <div class="col-sm-2 col-md-2 pull-right"><br>
                <input type="submit" value="Filter" class="btn btn-primary btn-sm form-control" id="filter">
            </div>

        </div>

    </form>

</div>

<div class="row">
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="clearfix"></div>

        <div class="panel panel-primary filterable">
        
            <div class="panel-heading">
                <h3 class="panel-title">&nbsp;</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
        
            <table id="datatable" class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Payment Type" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Reference No" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                        <th class="text-center">Action</th>
                    </tr>
                    
                </thead>

                <tbody>

                    <?php
                        $statusArr = ['-1'=>'Cancel', '1'=>'Pending', '2'=>'Courier', '3'=>'Complete'];
                        foreach ($data as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo ($key+1)?></td>
                            <td><?=date("m/d/Y", strtotime($value->date))?></td>
                            <td>
                                <?php if ($value->receive_status == 1): ?>
                                    <a target="_blank" href="<?= base_url("admin/reports/invoice/edit/{$value->ji_invoice_id}")?>"><span style="color: green;"><?= $value->order_no ?></span></a>
                                <?php else: ?>
                                    <a target="_blank" href="<?= base_url("admin/reports/invoice/edit/{$value->ji_invoice_id}")?>"><span style="color: red;"><?= $value->order_no ?></span></a>
                                <?php endif ?>  
                            </td>
                            <td><?=$value->payment_type?></td>
                            <td><?=$value->reference_no?></td>
                            <td><?=$value->account_name?></td>
                            <td><?=$value->amount?></td>
                            <td><a target="_blank" href="<?= base_url("admin/payment/edit/$value->id") ?>" class="btn btn-sm btn-success" data-id='<?=$value->id?>'>Edit</a></td>
                        </tr>
                        
                    <?php } ?>

                </tbody>

            </table>

        </div>

        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
            
            <?= $this->pagination->create_links(); ?>

        </div>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $( ".date" ).datepicker();

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
                url: "<?php echo base_url();?>admin/invoice/delete",
                async: true,
                data: {'id': id},
                success: function(data) {
                    
                    if(data == 'ok')
                    {
                        $('.table').find('tbody').find('tr').eq(rowNo).remove();
                    }

                },

            });

        })

        // click on filter button
        $('.filterable .btn-filter').on('click', function()
        {
            var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
            
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
