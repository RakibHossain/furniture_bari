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

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="pull-right">

            <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

        </div>

        <table class="table table-condensed table-hover">

            <thead>

                <tr class="filters">
                    <th width="6%"><input type="text" class="form-control" placeholder="Date" disabled></th>
                    <?php foreach ($accounts as $account): ?>
                        <th><input type="text" class="form-control" placeholder="<?= $account->account_name ?>" disabled></th>
                    <?php endforeach ?>
                    <th><input type="text" class="form-control" placeholder="Total" disabled></th>
                </tr>

            </thead>

            <tbody id="rows">

                <?php foreach ($account_reports as $key => $account_report): ?>

                    <tr>
                        <td><?= $account_report->date_day ?></td>
                        <td class="account-amount-1" data-amount="<?= !empty($account_report->Bank_FB) ? $account_report->Bank_FB : 0 ?>"><?= $account_report->Bank_FB ?></td>
                        <td class="account-amount-2" data-amount="<?= !empty($account_report->Cash_In_MDP) ? $account_report->Cash_In_MDP : 0 ?>"><?= $account_report->Cash_In_MDP ?></td>
                        <td class="account-amount-3" data-amount="<?= !empty($account_report->Bkash) ? $account_report->Bkash : 0 ?>"><?= $account_report->Bkash ?></td>
                        <td class="account-amount-4" data-amount="<?= !empty($account_report->Cash_In_Mirpur) ? $account_report->Cash_In_Mirpur : 0 ?>"><?= $account_report->Cash_In_Mirpur ?></td>
                        <td class="account-amount-5" data-amount="<?= !empty($account_report->Cash_In_Factory) ? $account_report->Cash_In_Factory : 0 ?>"><?= $account_report->Cash_In_Factory ?></td>
                        <td class="account-amount-6" data-amount="<?= !empty($account_report->Cash_On_MD) ? $account_report->Cash_On_MD : 0 ?>"><?= $account_report->Cash_On_MD ?></td>
                        <td class="account-amount-7" data-amount="<?= !empty($account_report->DBBL) ? $account_report->DBBL : 0 ?>"><?= $account_report->DBBL ?></td>
                        <td class="row-total"></td>
                    </tr>

                <?php endforeach ?>

            </tbody>

        </table>

    </div>

    <!-- prev & next button -->
    <div class="row" style="margin-bottom: 20px;">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
            
            <form class="form-horizontal" action="<?= ($type == 'incoming') ? base_url('account/incoming/reports/prev-month') : base_url('account/outgoing/reports/prev-month') ?>" method="post">
                <input type="hidden" name="month" value="<?= $month ?>" />
                <input type="hidden" name="year" value="<?= $year ?>" />

                <input type="submit" class="btn btn-primary" value="< PREV MONTH"/>
            </form>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
            
            <form class="form-horizontal" action="<?= ($type == 'incoming') ? base_url('account/incoming/reports/next-month') : base_url('account/outgoing/reports/next-month') ?>" method="post">
                <input type="hidden" name="month" value="<?= $month ?>" />
                <input type="hidden" name="year" value="<?= $year ?>" />
                
                <input type="submit" class="btn btn-primary" value="NEXT MONTH >"/>
            </form>

        </div>

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
            var $input   = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows  = $table.find('tbody tr');

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
        var rowTotal = 0;

        $("#rows").find('tr').each(function () 
        {
            rowTotal = parseFloat($(this).find('.account-amount-1').attr('data-amount')) + parseFloat($(this).find('.account-amount-2').attr('data-amount')) + parseFloat($(this).find('.account-amount-3').attr('data-amount')) + parseFloat($(this).find('.account-amount-4').attr('data-amount')) + parseFloat($(this).find('.account-amount-5').attr('data-amount')) + parseFloat($(this).find('.account-amount-6').attr('data-amount')) + parseFloat($(this).find('.account-amount-7').attr('data-amount'));
            rowTotal = isNaN(rowTotal) ? 0 : rowTotal;

            $(this).find('.row-total').html(rowTotal.toFixed(2));
        });
    }

</script>
