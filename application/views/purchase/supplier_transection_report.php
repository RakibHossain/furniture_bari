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

<h4>Purchase Supplier Transection Report</h4>

<?php if ($type == 'Bill'): ?>

    <div class="filterable">

        <div class="pull-right">
            <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>

        <table class="table table-condensed table-hover">

            <thead>

                <tr class="filters">
                    <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                    <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Type" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Quantity" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($supplier_reports as $key => $supplier_report): ?>

                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $supplier_report->date ?></td>
                        <td><?= "Bill" ?></td>
                        <td><?= $supplier_report->qty ?></td>
                        <td><?= $supplier_report->amount ?></td>
                    </tr>

                <?php endforeach ?>

            </tbody>

        </table>

    </div>

<?php elseif ($type == 'Pay Bill'): ?>

    <div class="filterable">

        <div class="pull-right">
            <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>

        <table class="table table-condensed table-hover">

            <thead>

                <tr class="filters">
                    <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                    <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Type" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($supplier_reports as $key => $supplier_report): ?>

                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $supplier_report->date ?></td>
                        <td><?= "Pay Bill" ?></td>
                        <td><?= $supplier_report->account ?></td>
                        <td><?= $supplier_report->amount ?></td>
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

</script>
