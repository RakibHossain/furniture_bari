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

<?php if ($type == 'new'): ?>

    <form class="form-horizontal" id="formRoot" action="<?= base_url("purchase/report/filter") ?>" method="POST">

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-2">

                <div class="form-group">

                    <label for="item_name">Item Name:</label>
                    <select class="form-control required" onchange="fetchPurchaseItemCode(this.options[this.selectedIndex].value, $(this));" name="item_name">

                        <option>Select Item Name</option>
                        <?php foreach ($item_names as $item_name): ?>

                            <option value="<?= $item_name ?>"><?= $item_name ?></option>

                        <?php endforeach ?>

                    </select>

                </div>

            </div>

            <div class="col-sm-2 col-sm-offset-1">

                <div class="form-group item-code-div">

                    <label for="item_code">Item Code:</label>
                    <select class="form-control item-code" name="item_code">

                        <option>Select Item Code</option>

                    </select>

                </div>

            </div>

            <div class="col-sm-2 col-sm-offset-1">

                <div class="form-group">

                    <label for="from_date">From Date:</label>
                    <input type="text" class="form-control from-date" name="from_date">

                </div>

            </div>

            <div class="col-sm-2 col-sm-offset-1">

                <div class="form-group">

                    <label for="to_date">To Date:</label>
                    <input type="text" class="form-control to-date" name="to_date">

                </div>

            </div>

            <div class="col-sm-1" style="margin-top: 25px;">
                
                <button type="submit" class="btn btn-primary">Ok</button>

            </div>

        </div>

    </form>

    <br>

<?php else: ?>

    <div class="filterable">

        <div class="pull-right">

            <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

        </div>

        <table class="table">

            <thead>

                <tr class="filters">
                    <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                    <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Quantity" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Discount" disabled></th>
                </tr>

            </thead>

            <tbody id="rows">

                <?php foreach ($purchase_reports as $key => $purchase_report): ?>

                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= date("m/d/Y", strtotime($purchase_report->date)) ?></td>
                        <td><?= $purchase_report->total_qty ?></td>
                        <td><?= $purchase_report->total_amount ?></td>
                        <td><?= $purchase_report->discount ?></td>
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

        $(".from-date").datepicker({

            numberOfMonths: 1,
            onSelect: function(selected) 
            {
                $(".to-date").datepicker("option", "minDate", selected);
            }

        });

        $(".to-date").datepicker({ 
            
            numberOfMonths: 1,
            onSelect: function(selected) 
            {
               $(".from-date").datepicker("option", "maxDate", selected);
            }

        });

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

        $('.filterable .filters input').on('keyup change', function(e)
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

            /* Worst filter function ever */
            var $filteredRows = $rows.filter(function()
            {
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

    function fetchPurchaseItemCode(item_name, item_code_select) 
    {
        var url = "<?= base_url('fetch/purchase/item/code') ?>";

        $.post(url, { item_name: item_name }, function(result) 
        {
            item_code_select.parent().parent().next().find('.item-code-div').find('.item-code').html(result);
        });

    }

</script>
