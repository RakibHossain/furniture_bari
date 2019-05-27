<h4>Account Balance Reports</h4>

<?php if ($type == 'view'): ?>

    <form class="form-horizontal formRoot" action="<?= base_url('admin/account/balance/reports') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th>Account Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <select class="form-control required" name="account_name">

                            <?php if ($this->session->userdata['logged_in']['role'] == 2): ?>

                                <option value="Cash In Mirpur">Cash In Mirpur</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php 
                                        if ($account->account_name == 'Cash On MD') {
                                            continue;
                                        }
                                    ?>
                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php elseif ($this->session->userdata['logged_in']['role'] == 3): ?>

                                <option value="Cash In Factory">Cash In Factory</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php 
                                        if ($account->account_name == 'Cash On MD') {
                                            continue;
                                        }
                                    ?>
                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php elseif ($this->session->userdata['logged_in']['role'] == 4): ?>

                                <option value="Cash In MDP">Cash In MDP</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php 
                                        if ($account->account_name == 'Cash On MD') {
                                            continue;
                                        }
                                    ?>
                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php else: ?>

                                <?php foreach ($accounts as $account): ?>
                                    <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endforeach ?>

                            <?php endif ?>

                        </select>
                    </td>
                    <td>
                        <input type="text" name="from_date" class="form-control view-date" />
                    </td>
                    <td>
                        <input type="text" name="to_date" class="form-control view-date" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Ok</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <form class="form-horizontal formRoot" action="<?= base_url('admin/account/balance/reports') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    <th>Account Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <select class="form-control required" name="account_name">

                            <?php if ($this->session->userdata['logged_in']['role'] == 2): ?>

                                <option value="Cash In Mirpur">Cash In Mirpur</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php 
                                        if ($account->account_name == 'Cash On MD') {
                                            continue;
                                        }
                                    ?>
                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php elseif ($this->session->userdata['logged_in']['role'] == 3): ?>

                                <option value="Cash In Factory">Cash In Factory</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php 
                                        if ($account->account_name == 'Cash On MD') {
                                            continue;
                                        }
                                    ?>
                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php elseif ($this->session->userdata['logged_in']['role'] == 4): ?>

                                <option value="Cash In MDP">Cash In MDP</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php 
                                        if ($account->account_name == 'Cash On MD') {
                                            continue;
                                        }
                                    ?>
                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php else: ?>

                                <?php foreach ($accounts as $account): ?>
                                    <option <?= ($account_name == $account->account_name) ? 'selected=""' : '' ?> value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endforeach ?>

                            <?php endif ?>

                        </select>
                    </td>
                    <td>
                        <input type="text" name="from_date" class="form-control date" value="<?= date("m/d/Y", strtotime($from_date)) ?>" />
                    </td>
                    <td>
                        <input type="text" name="to_date" class="form-control date" value="<?= date("m/d/Y", strtotime($to_date)) ?>" />
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Ok</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <?php 
        $prev_day_account_balance = $account_balance_reports['prev_day_account_balance'];
        $range_day_account_balance_reports = $account_balance_reports['range_day_account_balance_reports'];
    ?>

    <div class="table-responsive">

        <div class="table-scroll">

            <table class="table table-condensed table-hover">

                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Sales</th>
                        <th>Service</th>
                        <th>Bank Transfer</th>
                        <th>Cash Transfer</th>
                        <th>Invest/Adjustment</th>
                        <th>Total</th>
                        <th>Expense</th>
                        <th>Bank Transfer</th>
                        <th>Cash Transfer</th>
                        <th>Cash Purchase</th>
                        <th>Vendor Pay</th>
                        <th>Worker Pay</th>
                        <th>Withdraw/Adjustment</th>
                        <th>Total</th>
                        <th>Balance</th>
                    </tr>

                </thead>

                <tbody id="rows">

                    <!-- <input type="hidden" class="prev-day-balance" value="<?= !empty($prev_day_account_balance->amount) ? $prev_day_account_balance->amount : 0 ?>" /> -->

                    <?php foreach ($range_day_account_balance_reports as $range_day_account_balance_report): ?>

                        <tr>
                            <td><?= $range_day_account_balance_report->date_day ?></td>
                            <td class="account-amount-1" data-amount="<?= !empty($range_day_account_balance_report->sales) ? $range_day_account_balance_report->sales : 0 ?>"><?= $range_day_account_balance_report->sales ?></td>
                            <td class="account-amount-2" data-amount="<?= !empty($range_day_account_balance_report->service) ? $range_day_account_balance_report->service : 0 ?>"><?= $range_day_account_balance_report->service ?></td>
                            <td class="account-amount-3" data-amount="<?= !empty($range_day_account_balance_report->bank_transfer_incoming) ? $range_day_account_balance_report->bank_transfer_incoming : 0 ?>"><?= $range_day_account_balance_report->bank_transfer_incoming ?></td>
                            <td class="account-amount-4" data-amount="<?= !empty($range_day_account_balance_report->cash_transfer_incoming) ? $range_day_account_balance_report->cash_transfer_incoming : 0 ?>"><?= $range_day_account_balance_report->cash_transfer_incoming ?></td>
                            <td class="account-amount-5" data-amount="<?= !empty($range_day_account_balance_report->invest_adjustment) ? $range_day_account_balance_report->invest_adjustment : 0 ?>"><?= $range_day_account_balance_report->invest_adjustment ?></td>
                            <td class="row-incoming-total" data-amount="0"></td>
                            <td class="account-amount-6" data-amount="<?= !empty($range_day_account_balance_report->expense) ? $range_day_account_balance_report->expense : 0 ?>"><?= $range_day_account_balance_report->expense ?></td>
                            <td class="account-amount-7" data-amount="<?= !empty($range_day_account_balance_report->bank_transfer_outgoing) ? $range_day_account_balance_report->bank_transfer_outgoing : 0 ?>"><?= $range_day_account_balance_report->bank_transfer_outgoing ?></td>
                            <td class="account-amount-8" data-amount="<?= !empty($range_day_account_balance_report->cash_transfer_outgoing) ? $range_day_account_balance_report->cash_transfer_outgoing : 0 ?>"><?= $range_day_account_balance_report->cash_transfer_outgoing ?></td>
                            <td class="account-amount-9" data-amount="<?= !empty($range_day_account_balance_report->cash_purchase) ? $range_day_account_balance_report->cash_purchase : 0 ?>"><?= $range_day_account_balance_report->cash_purchase ?></td>
                            <td class="account-amount-10" data-amount="<?= !empty($range_day_account_balance_report->vendor_pay) ? $range_day_account_balance_report->vendor_pay : 0 ?>"><?= $range_day_account_balance_report->vendor_pay ?></td>
                            <td class="account-amount-11" data-amount="<?= !empty($range_day_account_balance_report->worker_pay) ? $range_day_account_balance_report->worker_pay : 0 ?>"><?= $range_day_account_balance_report->worker_pay ?></td>
                            <td class="account-amount-12" data-amount="<?= !empty($range_day_account_balance_report->withdraw_adjustment) ? $range_day_account_balance_report->withdraw_adjustment : 0 ?>"><?= $range_day_account_balance_report->withdraw_adjustment ?></td>
                            <td class="row-outgoing-total" data-amount="0"></td>
                            <td class="day-balance" data-amount="0"></td>
                        </tr>

                    <?php endforeach ?>

                </tbody>

                <tfoot>

                    <tr>
                        <td><h4>Total:</h4></td>
                        <td class="total-sales-amount"></td>
                        <td class="total-service-amount"></td>
                        <td class="total-incoming-bank-transfer-amount"></td>
                        <td class="total-incoming-cash-transfer-amount"></td>
                        <td class="total-invest-adjustment-amount"></td>
                        <td class="total-incoming-amount"></td>
                        <td class="total-expense-amount"></td>
                        <td class="total-outgoing-bank-transfer-amount"></td>
                        <td class="total-outgoing-cash-transfer-amount"></td>
                        <td class="total-cash-purchase-amount"></td>
                        <td class="total-vendor-pay-amount"></td>
                        <td class="total-worker-pay-amount"></td>
                        <td class="total-withdraw-adjustment-amount"></td>
                        <td class="total-outgoing-amount"></td>
                        <td class="total-balance-amount"></td>
                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

<?php endif ?>

<script type="text/javascript">
    
    $(function() 
    {
        $(".view-date").datepicker().datepicker("setDate", new Date());
        $(".date").datepicker();
        $(".formRoot").validate();
        calculateRowTotal();
        calculateGrandTotal();
    });

    function calculateRowTotal() 
    {
        var prevDayBalance   = 0;
        var rowBalanceTotal  = 0;
        var rowIncomingTotal = 0;
        var rowOutgoingTotal = 0;

        $("#rows").find('tr').each(function() 
        {
            prevDayBalance = parseFloat($(this).closest('tr').prev('tr').find('.day-balance').data('amount'));
            prevDayBalance = isNaN(prevDayBalance) ? 0 : prevDayBalance;

            // if (prevDayBalance == 0) 
            // {
            //     prevDayBalance = parseFloat($('.prev-day-balance').val());
            // }

            rowIncomingTotal = parseFloat($(this).find('.account-amount-1').data('amount')) + parseFloat($(this).find('.account-amount-2').data('amount')) + parseFloat($(this).find('.account-amount-3').data('amount')) + parseFloat($(this).find('.account-amount-4').data('amount')) + parseFloat($(this).find('.account-amount-5').data('amount'));
            rowIncomingTotal = isNaN(rowIncomingTotal) ? 0 : rowIncomingTotal;

            $(this).find('.row-incoming-total').data('amount', rowIncomingTotal.toFixed(2)).html(rowIncomingTotal.toFixed(2));

            rowOutgoingTotal = parseFloat($(this).find('.account-amount-6').data('amount')) + parseFloat($(this).find('.account-amount-7').data('amount')) + parseFloat($(this).find('.account-amount-8').data('amount')) + parseFloat($(this).find('.account-amount-9').data('amount')) + parseFloat($(this).find('.account-amount-10').data('amount')) + parseFloat($(this).find('.account-amount-11').data('amount')) + parseFloat($(this).find('.account-amount-12').data('amount'));
            rowOutgoingTotal = isNaN(rowOutgoingTotal) ? 0 : rowOutgoingTotal;

            $(this).find('.row-outgoing-total').data('amount', rowOutgoingTotal.toFixed(2)).html(rowOutgoingTotal.toFixed(2));

            rowBalanceTotal = (prevDayBalance + rowIncomingTotal) - rowOutgoingTotal;
            $(this).find('.day-balance').data('amount', rowBalanceTotal.toFixed(2)).html(rowBalanceTotal.toFixed(2));
        });

    }

    function calculateGrandTotal() 
    {
        var totalSalesAmount = 0;
        var totalServiceAmount = 0;
        var totalIncomingBankTransferAmount = 0;
        var totalIncomingCashTransferAmount = 0;
        var totalInvestAdjustmentAmount = 0;
        var totalIncomingAmount = 0;
        var totalExpenseAmount = 0;
        var totalOutgoingBankTransferAmount = 0;
        var totalOutgoingCashTransferAmount = 0;
        var totalCashPurchaseAmount = 0;
        var totalVendorPayAmount = 0;
        var totalWorkerPayAmount = 0;
        var totalWithdrawAdjustmentAmount = 0;
        var totalOutgoingAmount = 0;
        var totalBalanceAmount = 0;

        $("#rows").find('tr').each(function() 
        {
            totalSalesAmount += parseFloat($(this).find('.account-amount-1').data('amount'));
            totalServiceAmount += parseFloat($(this).find('.account-amount-2').data('amount'));
            totalIncomingBankTransferAmount += parseFloat($(this).find('.account-amount-3').data('amount'));
            totalIncomingCashTransferAmount += parseFloat($(this).find('.account-amount-4').data('amount'));
            totalInvestAdjustmentAmount += parseFloat($(this).find('.account-amount-5').data('amount'));
            totalIncomingAmount += parseFloat($(this).find('.row-incoming-total').data('amount'));
            totalExpenseAmount += parseFloat($(this).find('.account-amount-6').data('amount'));
            totalOutgoingBankTransferAmount += parseFloat($(this).find('.account-amount-7').data('amount'));
            totalOutgoingCashTransferAmount += parseFloat($(this).find('.account-amount-8').data('amount'));
            totalCashPurchaseAmount += parseFloat($(this).find('.account-amount-9').data('amount'));
            totalVendorPayAmount += parseFloat($(this).find('.account-amount-10').data('amount'));
            totalWorkerPayAmount += parseFloat($(this).find('.account-amount-11').data('amount'));
            totalWithdrawAdjustmentAmount += parseFloat($(this).find('.account-amount-12').data('amount'));
            totalOutgoingAmount += parseFloat($(this).find('.row-outgoing-total').data('amount'));
            totalBalanceAmount += parseFloat($(this).find('.day-balance').data('amount'));
        });
        
        totalSalesAmount = isNaN(totalSalesAmount) ? 0 : totalSalesAmount;
        totalServiceAmount = isNaN(totalServiceAmount) ? 0 : totalServiceAmount;
        totalIncomingBankTransferAmount = isNaN(totalIncomingBankTransferAmount) ? 0 : totalIncomingBankTransferAmount;
        totalIncomingCashTransferAmount = isNaN(totalIncomingCashTransferAmount) ? 0 : totalIncomingCashTransferAmount;
        totalInvestAdjustmentAmount = isNaN(totalInvestAdjustmentAmount) ? 0 : totalInvestAdjustmentAmount;
        totalIncomingAmount = isNaN(totalIncomingAmount) ? 0 : totalIncomingAmount;
        totalExpenseAmount = isNaN(totalExpenseAmount) ? 0 : totalExpenseAmount;
        totalOutgoingBankTransferAmount = isNaN(totalOutgoingBankTransferAmount) ? 0 : totalOutgoingBankTransferAmount;
        totalOutgoingCashTransferAmount = isNaN(totalOutgoingCashTransferAmount) ? 0 : totalOutgoingCashTransferAmount;
        totalCashPurchaseAmount = isNaN(totalCashPurchaseAmount) ? 0 : totalCashPurchaseAmount;
        totalVendorPayAmount = isNaN(totalVendorPayAmount) ? 0 : totalVendorPayAmount;
        totalWorkerPayAmount = isNaN(totalWorkerPayAmount) ? 0 : totalWorkerPayAmount;
        totalWithdrawAdjustmentAmount = isNaN(totalWithdrawAdjustmentAmount) ? 0 : totalWithdrawAdjustmentAmount;
        totalOutgoingAmount = isNaN(totalOutgoingAmount) ? 0 : totalOutgoingAmount;
        totalBalanceAmount = isNaN(totalBalanceAmount) ? 0 : totalBalanceAmount;

        $('.total-sales-amount').html('<h4>'+totalSalesAmount.toFixed(2)+'</h4>');
        $('.total-service-amount').html('<h4>'+totalServiceAmount.toFixed(2)+'</h4>');
        $('.total-incoming-bank-transfer-amount').html('<h4>'+totalIncomingBankTransferAmount.toFixed(2)+'</h4>');
        $('.total-incoming-cash-transfer-amount').html('<h4>'+totalIncomingCashTransferAmount.toFixed(2)+'</h4>');
        $('.total-invest-adjustment-amount').html('<h4>'+totalInvestAdjustmentAmount.toFixed(2)+'</h4>');
        $('.total-incoming-amount').html('<h4>'+totalIncomingAmount.toFixed(2)+'</h4>');
        $('.total-expense-amount').html('<h4>'+totalExpenseAmount.toFixed(2)+'</h4>');
        $('.total-outgoing-bank-transfer-amount').html('<h4>'+totalOutgoingBankTransferAmount.toFixed(2)+'</h4>');
        $('.total-outgoing-cash-transfer-amount').html('<h4>'+totalOutgoingCashTransferAmount.toFixed(2)+'</h4>');
        $('.total-cash-purchase-amount').html('<h4>'+totalCashPurchaseAmount.toFixed(2)+'</h4>');
        $('.total-vendor-pay-amount').html('<h4>'+totalVendorPayAmount.toFixed(2)+'</h4>');
        $('.total-worker-pay-amount').html('<h4>'+totalWorkerPayAmount.toFixed(2)+'</h4>');
        $('.total-withdraw-adjustment-amount').html('<h4>'+totalWithdrawAdjustmentAmount.toFixed(2)+'</h4>');
        $('.total-outgoing-amount').html('<h4>'+totalOutgoingAmount.toFixed(2)+'</h4>');
        $('.total-balance-amount').html('<h4>'+totalBalanceAmount.toFixed(2)+'</h4>');
    }

</script>
