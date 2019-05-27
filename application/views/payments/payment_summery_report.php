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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-primary filterable">

            <div class="panel-heading">

                <h3 class="panel-title">&nbsp;</h3>

                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>

            </div>
            
            <table class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Item Code" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Delivery Paid" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Advance" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Total Paid" disabled></th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                        $statusArr = ['Delivery'=>'Delivery', 'Courier'=>'Courier', 'Advance'=>'Advance'];
                        $statusColor = ['Delivery'=>'blue', 'Courier'=>'blue', 'Advance'=>'#804000'];

                        $total_delivery_paid = 0;
                        $total_advance_paid = 0;
                        $total_total_paid = 0;

                        foreach ($data as $key => $value) 
                        {
                            $getID = explode(', ', $value->id);
                            $getORDNO = explode(', ', $value->order_no);
                            $getItemCode = explode(', ', $value->item_code);
                            $getInvoiceStatus = explode(', ', $value->status);
                            $getREFERENCE = explode(', ', $value->reference_no);
                    ?>
                        <tr>

                            <td><?= $value->date_day ?></td>
                            <td>
                                <?php 

                                    foreach ($getID as $k => $v) 
                                    {
                                        echo '<a href="'.base_url().'admin/invoice/edit/'.$v.'" style="color:'.$statusColor[$getREFERENCE[$k]].'">'.$getORDNO[$k].', </a> &nbsp;' ;
                                    }

                                ?>

                            </td>
                            <td>
                                <?php 

                                    foreach ($getItemCode as $k => $v) 
                                    {
                                        echo '<span style="color:'.$statusColor[$getREFERENCE[$k]].'">'.$getItemCode[$k].', </span> &nbsp;';
                                    }

                                ?>
                                
                            </td>
                            <td>
                                <?php

                                    echo $value->delivery_paid;
                                    // counting total delevary paid
                                    $total_delivery_paid += $value->delivery_paid;

                                ?>

                            </td>
                            <td>
                                <?php

                                    echo $value->advance_paid;
                                    // counting total advance paid
                                    $total_advance_paid += $value->advance_paid;

                                ?>

                            </td>
                            <td>
                                <?php

                                    echo $value->total_paid;
                                    // counting total total paid
                                    $total_total_paid += $value->total_paid;

                                ?>

                            </td>

                        </tr>

                    <?php } ?>

                    <tr>
                        
                        <td colspan="3"><h4>Total:</h4></td>
                        <td><h4><?= $total_delivery_paid ?></h4></td>
                        <td><h4><?= $total_advance_paid ?></h4></td>
                        <td><h4><?= $total_total_paid ?></h4></td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <div class="row" style="margin-bottom: 20px;">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
            <a href="<?= base_url("admin/payment/summery/reports/prev-month/$month/$year") ?>" class="btn btn-primary">< PREV MONTH</a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
            <a href="<?= base_url("admin/payment/summery/reports/next-month/$month/$year") ?>" class="btn btn-primary">NEXT MONTH ></a>
        </div>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker();

        $('.delete_row').on('click', function()
        {
            var retConf = confirm('Are you sure you want to delete this row?');

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
                success: function(data) 
                {
                    if(data == 'ok'){
                        $('.table').find('tbody').find('tr').eq(rowNo).remove();
                    }
                }

            });

        })

        $('.filterable .btn-filter').click(function()
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

        $('.filterable .filters input').on('keyup change',function(e)
        {
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;

            /* Useful DOM data and selectors */
            var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');

            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });

            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();

            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) 
            {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }

        });

    });

</script>
