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

<div class="filterable">

    <div class="pull-right">
        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>    
    </div>

    <table class="table">

        <thead>

            <tr class="filters">
                <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                <th><input type="text" class="form-control" placeholder="Time" disabled></th>
                <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                <th><input type="text" class="form-control" placeholder="Spot" disabled></th>
                <th><input type="text" class="form-control" placeholder="Activity" disabled></th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php foreach ($user_activities as $key => $user_activity): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= date("m/d/Y", strtotime($user_activity->date)) ?></td>
                    <td><?= $user_activity->time ?></td>
                    <td><?= $user_activity->name ?></td>
                    <?php if (!empty($user_activity->ji_invoice_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("admin/invoice/edit/$user_activity->ji_invoice_id") ?>">Invoice</a></td>
                        <?php else: ?>
                            <td>Invoice</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_payment_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("admin/payment/edit/$user_activity->ji_payment_id") ?>">Payment</a></td>
                        <?php else: ?>
                            <td>Payment</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_new_expanse_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("admin/new/expanse/edit/$user_activity->ji_new_expanse_id") ?>">Expense</a></td>
                        <?php else: ?>
                            <td>Expense</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_purchase_bill_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("purchase/edit/bill/$user_activity->ji_purchase_bill_id") ?>">Purchase Bill</a></td>
                        <?php else: ?>
                            <td>Purchase Bill</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_purchase_pay_bill_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("purchase/edit/pay/bill/$user_activity->ji_purchase_pay_bill_id") ?>">Purchase Pay Bill</a></td>
                        <?php else: ?>
                            <td>Purchase Pay Bill</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_worker_bill_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("worker/edit/bill/$user_activity->ji_worker_bill_id") ?>">Worker Bill</a></td>
                        <?php else: ?>
                            <td>Worker Bill</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_worker_pay_bill_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("worker/edit/pay/bill/$user_activity->ji_worker_pay_bill_id") ?>">Worker Pay Bill</a></td>
                        <?php else: ?>
                            <td>Worker Pay Bill</td>
                        <?php endif ?>
                    <?php elseif (!empty($user_activity->ji_account_cash_inflow_id)): ?>
                        <?php if ($user_activity->activity_type != 3): ?>
                            <td><a href="<?= base_url("account/edit/cashinflow/$user_activity->ji_account_cash_inflow_id") ?>">Account Cash Inflow</a></td>
                        <?php else: ?>
                            <td>Account Cash Inflow</td>
                        <?php endif ?>
                    <?php else: ?>
                        <td>Account Transfer</td>
                    <?php endif ?>
                    <?php if ($user_activity->activity_type == 1): ?>
                        <td>Insert</td>
                    <?php elseif ($user_activity->activity_type == 2): ?>
                        <td>Edit</td>
                    <?php else: ?>
                        <td>Delete</td>
                    <?php endif ?>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">

        <?= $this->pagination->create_links(); ?>

    </div>

</div>

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

