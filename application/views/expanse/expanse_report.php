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

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="filterable">

            <div class="pull-right">

                <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

            </div>

            <table class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Expanse" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Purchase Expanse" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Worker Expanse" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Total Expanse" disabled></th>
                    </tr>

                </thead>

                <tbody id="rows">

                    <?php foreach ($expanse_reports as $key => $expanse_report): ?>

                        <tr>
                            <td><?= $expanse_report->date_day ?></td>
                            <!-- <td><a href="<?= base_url("admin/expanse/report/details/expanse?date=$expanse_report->date") ?>" target="_blank" class="expanse" data-expanse="<?= $expanse_report->expanse_total ?>"><?= $expanse_report->expanse_total ?></a></td>
                            <td><a href="<?= base_url("admin/expanse/report/details/purchase?date=$expanse_report->date") ?>" target="_blank" class="purchase-expanse" data-expanse="<?= $expanse_report->purchase_expanse_total ?>"><?= $expanse_report->purchase_expanse_total ?></a></td>
                            <td><a href="<?= base_url("admin/expanse/report/details/worker?date=$expanse_report->date") ?>" target="_blank" class="worker-expanse" data-expanse="<?= $expanse_report->worker_expanse_total ?>"><?= $expanse_report->worker_expanse_total ?></a></td> -->
                            <td class="expanse" data-expanse="<?= $expanse_report->expanse_total ?>"><?= $expanse_report->expanse_total ?></td>
                            <td class="purchase-expanse" data-expanse="<?= $expanse_report->purchase_expanse_total ?>"><?= $expanse_report->purchase_expanse_total ?></a></td>
                            <td class="worker-expanse" data-expanse="<?= $expanse_report->worker_expanse_total ?>"><?= $expanse_report->worker_expanse_total ?></a></td>
                            <td class="row-total"></td>
                        </tr>

                    <?php endforeach ?>

                </tbody>

                <tbody>

                    <tr>
                        <td>Total:</td>
                        <td class="total-expense-amount"></td>
                        <td class="total-purchase-amount"></td>
                        <td class="total-worker-amount"></td>
                        <td class="total-amount"></td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="row" style="margin-bottom: 20px;">

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
        
        <form class="form-horizontal" action="<?= base_url('admin/expanse/report/prev-month') ?>" method="post">

            <input type="hidden" name="month" value="<?= $month ?>" />
            <input type="hidden" name="year" value="<?= $year ?>" />

            <input type="submit" class="btn btn-primary" value="< PREV MONTH"/>
          
        </form>

    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
        
        <form class="form-horizontal" action="<?= base_url('admin/expanse/report/next-month') ?>" method="post">

            <input type="hidden" name="month" value="<?= $month ?>" />
            <input type="hidden" name="year" value="<?= $year ?>" />
            
            <input type="submit" class="btn btn-primary" value="NEXT MONTH >"/>
          
        </form>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
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

        calculateRowTotal();
        calculateGrandTotal();
        
    });

    function calculateRowTotal() 
    {
        var rowTotal = 0;

        $("#rows").find('tr').each(function () 
        {
            rowTotal = (parseFloat($(this).find('.expanse').attr('data-expanse')) + parseFloat($(this).find('.purchase-expanse').attr('data-expanse')) + parseFloat($(this).find('.worker-expanse').attr('data-expanse')));
            rowTotal = isNaN(rowTotal) ? 0 : rowTotal;

            $(this).find('.row-total').html(rowTotal.toFixed(2));
        });

    }

    function calculateGrandTotal() 
    {
        var totalExpenseAmount = 0;
        var totalPurchaseAmount = 0;
        var totalWorkerAmount = 0;
        var totalAmount = 0;

        $("#rows").find('tr').each(function () 
        {
            totalExpenseAmount += parseFloat($(this).find('.expanse').attr('data-expanse'));
            totalPurchaseAmount += parseFloat($(this).find('.purchase-expanse').attr('data-expanse'));
            totalWorkerAmount += parseFloat($(this).find('.worker-expanse').attr('data-expanse'));
            totalAmount += parseFloat($(this).find('.row-total').html());

        });

        totalExpenseAmount = isNaN(totalExpenseAmount) ? 0 : totalExpenseAmount;
        totalPurchaseAmount = isNaN(totalPurchaseAmount) ? 0 : totalPurchaseAmount;
        totalWorkerAmount = isNaN(totalWorkerAmount) ? 0 : totalWorkerAmount;
        totalAmount = isNaN(totalAmount) ? 0 : totalAmount;

        $('.total-expense-amount').html(totalExpenseAmount.toFixed(2));
        $('.total-purchase-amount').html(totalPurchaseAmount.toFixed(2));
        $('.total-worker-amount').html(totalWorkerAmount.toFixed(2));
        $('.total-amount').html(totalAmount.toFixed(2));
    }

</script>
