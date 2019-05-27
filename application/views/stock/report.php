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

<h4>Stock Report</h4>

<div class="row">

    <div class="col-sm-6">

        <form class="form-horizontal" action="<?= base_url("stock/report") ?>" method="POST">

            <div class="col-sm-3">

                <div class="form-group">

                    <label for="stock_item">Stock Item:</label>
                    <select class="form-control required" name="stock_item">

                        <option <?= ($stock_item == "Sales Item") ? 'selected=""' : '' ?> value="Sales Item">Sales Item</option>
                        <option <?= ($stock_item == "Purchase Item") ? 'selected=""' : '' ?> value="Purchase Item">Purchase Item</option>

                    </select>

                </div>

            </div>

            <div class="col-sm-2" style="margin-top: 25px;">
                        
                <button type="submit" class="btn btn-primary">Ok</button>

            </div>

        </form>

    </div>

    <div class="col-sm-2">

        <div class="form-group">

            <label for="total_qty">Total Qty:</label>
            <input type="text" name="total_qty" readonly="" class="form-control" />

        </div>

    </div>

    <div class="col-sm-2 col-sm-offset-1">

        <div class="form-group">

            <label for="total_cost">Total Cost:</label>
            <input type="text" name="total_cost" readonly="" class="form-control" />

        </div>

    </div>

</div>

<br>

<div class="filterable">

    <div class="pull-right">
        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>    
    </div>

    <table id="datatable" class="table">

        <thead>

            <tr class="filters">
                <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control" placeholder="Item Category" disabled></th>
                <th><input type="text" class="form-control" placeholder="Item Name" disabled></th>
                <th><input type="text" class="form-control" placeholder="Item Code" disabled></th>
                <th><input type="text" class="form-control" placeholder="Qty" disabled></th>
                <th><input type="text" class="form-control" placeholder="Unit Cost" disabled></th>
                <th><input type="text" class="form-control" placeholder="Total Cost" disabled></th>
            </tr>

        </thead>

        <tbody id="rows">
        
            <?php foreach ($stock_reports as $key => $stock_report): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $stock_report->item_category ?></td>
                    <td><?= $stock_report->item_name ?></td>
                    <td><?= $stock_report->item_code ?></td>
                    <td>
                        <?= $stock_report->qty ?>
                        <input type="hidden" class="row_qty" value="<?= $stock_report->qty ?>">
                    </td>
                    <td><?= $stock_report->unit_price ?></td>
                    <td><?= $stock_report->total ?>
                        <input type="hidden" class="row_total" value="<?= $stock_report->total ?>">
                    </td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>

<script type="text/javascript">
    
    $(function () 
    {
        calculateGrandTotal();

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

    function calculateGrandTotal() 
    {
        var totalQty = 0;
        var totalCost = 0;

        $("#rows").find('tr').each(function () 
        {
            totalQty += parseFloat($(this).find('.row_qty').val());
            totalCost += parseFloat($(this).find('.row_total').val());
        });

        totalQty = isNaN(totalQty) ? 0 : totalQty;
        totalCost = isNaN(totalCost) ? 0 : totalCost;

        $('input[name^="total_qty"]').val(totalQty);
        $('input[name^="total_cost"]').val(totalCost.toFixed(2));
    }

</script>
