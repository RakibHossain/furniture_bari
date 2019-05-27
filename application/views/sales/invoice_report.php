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

            <div class="col-sm-2 col-md-2">
                <label class="control-label">From Date</label>
                <input type="text" id="from_date" name="from_date" readonly placeholder="Select From Date" class="form-control date" value="<?=isset($_GET['from_date']) ? $_GET['from_date'] : ''?>">
            </div>

            <div class="col-sm-2 col-md-2">
                <label class="control-label">To Date</label>
                <input type="text" id="to_date" name="to_date" readonly placeholder="Select To Date" class="form-control date" value="<?=isset($_GET['to_date']) ? $_GET['to_date'] : ''?>">
            </div>

            <div class="col-sm-2 col-md-2">

                <label class="control-label">Status</label>
                <?php
                    $status_options   = ['' => 'All', '-1' => 'Cancel', '1' => 'Pending', '2' => 'Courier', '3' => 'Complete', '4' => 'Due Receipt'];
                    $status_attribute = ['class' => 'form-control', 'id' => 'status'];
                    echo form_dropdown('status', $status_options, isset($_GET['status']) ? $_GET['status'] : '', $status_attribute);
                ?>

            </div>

            <div class="col-sm-2 col-md-2">
                <label class="control-label">Item Code</label>
                <input type="text" id="item_code" name="item_code" placeholder="Item Code" class="form-control" value="<?=isset($_GET['item_code']) ? $_GET['item_code'] : ''?>">
            </div>

            <div class="col-sm-2 col-md-2">
                <label class="control-label">Sales Person</label>
                <select class="form-control" id="sales_person" name="sales_person">
                    <option value="">Select Option</option>
                    <?php foreach ($sales_persons as $sales_person): ?>
                        <option value="<?= isset($_GET['sales_person']) ? $_GET['sales_person'] : $sales_person->name ?>"><?= $sales_person->name ?></option>
                    <?php endforeach ?>
                </select>
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
                        <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Order Date" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Delivery Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Customer Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Due Amount" disabled></th>
                        <?php if ($this->session->userdata['logged_in']['role'] != 6): ?>
                            <th><input type="text" class="form-control" placeholder="Net Total" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Order by" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Delivery by" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <?php else: ?>
                            <th><input type="text" class="form-control" placeholder="Mobile No" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Address" disabled></th>
                        <?php endif ?>
                        <th width="5%"></th>
                    </tr>

                </thead>

                <tbody>
                
                    <?php

                        $statusArr = ['-1'=>'Cancel', '1'=>'Pending', '2'=>'Courier', '3'=>'Complete', '4'=>'Due Receipt'];

                        foreach ($data as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo ($key+1)?></td>
                            <td><?=$value->order_no?></td>
                            <td><?=date("m/d/Y", strtotime($value->order_date))?></td>
                            <td><?=date("m/d/Y", strtotime($value->delivery_date))?></td>
                            <td><?=$value->customer_name?></td>
                            <td><?=$value->total_due?></td>
                            <?php if ($this->session->userdata['logged_in']['role'] != 6): ?>
                                <td><?=$value->net_total?></td>
                                <td><?=$value->order_by?></td>
                                <td><?=$value->delivery_by?></td>
                                <td><?=$statusArr[$value->status]?></td>
                                <td><a target="_blink" href="<?= base_url("admin/invoice/edit/$value->id") ?>" class="btn btn-sm btn-success" data-id='<?=$value->id?>'>Edit</a></td>
                            <?php else: ?>
                                <td><?=$value->mobile_no?></td>
                                <td><?=$value->address?></td>
                            <?php endif ?>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

        <!-- <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
            <?= $this->pagination->create_links(); ?>
        </div> -->

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $('.date').datepicker();
        $('.delete_row').on('click', function() {
            var retConf = confirm('Are you sure you want to delete this row?');

            if(!retConf)
            {
                return false;
            }

            var id    = $(this).attr('data-id');
            var rowNo = $(this).parents('tr').index();  

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url();?>admin/invoice/delete",
                async: true,
                data: {'id': id},
                success: function(data) 
                {
                    if(data == 'ok') {
                        $('.table').find('tbody').find('tr').eq(rowNo).remove();
                    }
                },

            });

        });

        // click on filter button
        $('.filterable .btn-filter').click(function()
        {
            var $panel = $(this).parents('.filterable'),
            $filters   = $panel.find('.filters input'),
            $tbody     = $panel.find('.table tbody');
            
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
