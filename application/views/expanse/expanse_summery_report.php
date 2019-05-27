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
        
        <form class="form-horizontal" id="formRoot" action="<?= base_url("admin/expanse/summery/report/filter") ?>" method="POST">

            <div class="row" style="margin-left: 10px;">

                <div class="col-sm-2">

                    <div class="form-group">

                        <label for="expense_name">Expense Name:</label>
                        <select class="form-control required" name="expense_name">

                            <option>Select Expense Name</option>
                            <?php foreach ($expense_names as $expense_name): ?>

                                <option value="<?= $expense_name->expanse_name ?>"><?= $expense_name->expanse_name ?></option>

                            <?php endforeach ?>

                        </select>

                    </div>

                </div>

                <div class="col-sm-2 col-sm-offset-1">

                    <div class="form-group">

                        <label for="expense_category">Expense Category:</label>
                        <select class="form-control required" name="expense_category">

                            <option>Select Expense Category</option>
                            <?php foreach ($expense_categories as $expense_category): ?>

                                <option value="<?= $expense_category->expanse_category_name ?>"><?= $expense_category->expanse_category_name ?></option>

                            <?php endforeach ?>

                        </select>

                    </div>

                </div>

                <!-- <div class="col-sm-2 col-sm-offset-1">

                    <div class="form-group">

                        <label for="time_limit">Time Limit:</label>
                        <select class="form-control required" name="time_limit">

                            <option value="1">Current Month</option>
                            <option value="3">Last 3 Months</option>
                            <option value="6">Last 6 Months</option>

                        </select>

                    </div>

                </div> -->

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

        <?php if ($type != 'new'): ?>

            <div class="filterable">

                <div class="pull-right">

                    <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

                </div>

                <table class="table">

                    <thead>

                        <tr class="filters">
                            <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Expense" disabled></th>
                            <th><input type="text" class="form-control date" placeholder="Transection Date" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Description" disabled></th>
                        </tr>

                    </thead>

                    <tbody id="rows">

                        <?php foreach ($expense_summery_reports as $key => $expense_summery_report): ?>

                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $expense_summery_report->expanse_name ?></td>
                                <td><?= date("m/d/Y", strtotime($expense_summery_report->date)) ?></td>
                                <td><?= $expense_summery_report->account ?></td>
                                <td class="expense-amount"><?= $expense_summery_report->amount ?></td>
                                <td><?= $expense_summery_report->description ?></td>
                            </tr>

                        <?php endforeach ?>

                    </tbody>

                    <tbody>

                        <tr>
                            <td colspan="4"><h3>Total:</h3></td>
                            <td class="total-expense-amount"></td>
                        </tr>

                    </tbody>

                </table>

            </div>

        <?php endif ?>

    </div>

</div>

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

        calculateGrandTotal();
    });

    function calculateGrandTotal() 
    {
        var totalAmount = 0;

        $("#rows").find('tr').each(function() 
        {
            totalAmount += parseFloat($(this).find('.expense-amount').html());
        });

        totalAmount = isNaN(totalAmount) ? 0 : totalAmount;
        $('.total-expense-amount').html('<h3>'+totalAmount.toFixed(2)+'</h3>');
    }

</script>
