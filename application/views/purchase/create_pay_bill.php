<?php if ($type == 'edit'): ?>

    <h4>Edit Pay Bill</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/update/pay/bill/$edit_pay_bill_id") ?>" method="POST">

        <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-5">

                <div class="form-group">

                    <label for="date">Date:</label>
                    <input type="text" name="date" class="form-control edit-date required" value="<?= date("m/d/Y", strtotime($edit_pay_bill->date)) ?>" />

                </div>

            </div>

            <div class="col-sm-5 col-sm-offset-1">

                <div class="form-group">

                    <label for="supplier">Supplier:</label>
                    <select class="form-control" id="supplier" name="supplier">
                        <option>Select A Supplier</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option <?= ($supplier->name == $edit_pay_bill->supplier) ? 'selected=""' : '' ?> value="<?= $supplier->name ?>"><?= $supplier->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="hidden" readonly="" class="form-control required" name="previous_supplier" value="<?= $edit_pay_bill->supplier ?>"/>

                </div>

            </div>
            
        </div>

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-5">

                <div class="form-group">

                    <label for="payment_type">Payment Type:</label>
                    <select class="form-control" name="payment_type">
                        <?php foreach ($payment_types as $payment_type): ?>
                            <option <?= ($payment_type->type == $edit_pay_bill->payment_type) ? 'selected=""' : '' ?> value="<?= $payment_type->type ?>"><?= $payment_type->type ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

            </div>

            <div class="col-sm-5 col-sm-offset-1">

                <div class="form-group">

                    <label for="balance">Balance:</label>
                    <input type="text" readonly="" class="form-control" id="supplier-balance" />

                </div>

            </div>
            
        </div>

        <table id="myTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Account</th>
                    <th class="col-sm-2">A/C Balance</th>
                    <th class="col-sm-2">Amount</th>
                    <th class="col-sm-2">Reference No.</th>
                    <th class="col-sm-3">Remarks</th>
                </tr>

            </thead>

            <tbody id="rows">

                <tr>

                    <td>
                        <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                            <select class="form-control required" id="account-name" name="account">
                                <option>Select Account</option>
                                <?php foreach ($accounts as $account): ?>
                                    <option <?= ($account->account_name == $edit_pay_bill->account) ? 'selected=""' : '' ?> value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="hidden" readonly="" class="form-control required" name="previous_account" value="<?= $edit_pay_bill->account ?>"/>

                        <?php else: ?>
                            <input type="text" readonly="" class="form-control required" name="account" value="<?= $edit_pay_bill->account ?>"/>
                        <?php endif ?>
                    </td>
                    <td>
                        <input type="text" id="balance" readonly="" class="form-control" />
                    </td>
                    <td>
                        <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                            <input type="text" name="amount"  class="form-control required" value="<?= $edit_pay_bill->amount ?>" />
                            <input type="hidden" readonly="" class="form-control required" name="previous_amount" value="<?= $edit_pay_bill->amount ?>" />
                        <?php else: ?>
                            <input type="text" readonly="" name="amount"  class="form-control required" value="<?= $edit_pay_bill->amount ?>" />
                        <?php endif ?>
                    </td>
                    <td>
                        <input type="text" name="reference_no"  class="form-control required" value="<?= $edit_pay_bill->reference_no ?>" />
                    </td>
                    <td>
                        <textarea cols="30" rows="2" name="remark" class="form-control required"><?= $edit_pay_bill->remark ?></textarea>
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr>
                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </td>
                    <td colspan="6"></td>
                </tr>

            </tfoot>

        </table>

    </form>


<?php else: ?>

    <h4>New Pay Bill</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("purchase/insert/pay/bill") ?>" method="POST">

        <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />
        
        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-5">

                <div class="form-group">

                    <label for="date">Date:</label>
                    <input type="text" name="date" class="form-control date required" />

                </div>

            </div>

            <div class="col-sm-5 col-sm-offset-1">

                <div class="form-group">

                    <label for="supplier">Supplier:</label>
                    <select class="form-control" id="supplier" name="supplier">
                        <option>Select A Supplier</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option value="<?= $supplier->name ?>"><?= $supplier->name ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

            </div>
            
        </div>

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-5">

                <div class="form-group">

                    <label for="payment_type">Payment Type:</label>
                    <select class="form-control" name="payment_type">
                        <?php foreach ($payment_types as $payment_type): ?>
                            <option value="<?= $payment_type->type ?>"><?= $payment_type->type ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

            </div>

            <div class="col-sm-5 col-sm-offset-1">

                <div class="form-group">

                    <label for="balance">Balance:</label>
                    <input type="text" readonly="" class="form-control" id="supplier-balance" />

                </div>

            </div>
            
        </div>

        <table id="myTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Account</th>
                    <th class="col-sm-2">A/C Balance</th>
                    <th class="col-sm-2">Amount</th>
                    <th class="col-sm-2">Reference No.</th>
                    <th class="col-sm-3">Remarks</th>
                </tr>

            </thead>

            <tbody id="rows">

                <tr>

                    <td>
                        <select class="form-control required" id="account-name" name="account">

                            <option>Select Account</option>
                            <?php if ($this->session->userdata['logged_in']['role'] == 2): ?>

                                <option value="Cash In Mirpur">Cash In Mirpur</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php elseif ($this->session->userdata['logged_in']['role'] == 3): ?>

                                <option value="Cash In Factory">Cash In Factory</option>
                                <?php foreach ($accounts as $account): ?>

                                    <?php if ($account->access_type == 1): ?>
                                        <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php elseif ($this->session->userdata['logged_in']['role'] == 4): ?>

                                <option value="Cash In MDP">Cash In MDP</option>
                                <?php foreach ($accounts as $account): ?>

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
                        <input type="text" id="balance" readonly="" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="amount"  class="form-control required"/>
                    </td>
                    <td>
                        <input type="text" name="reference_no"  class="form-control required"/>
                    </td>
                    <td >
                        <textarea cols="30" rows="2" name="remark" class="form-control required"></textarea>
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr>
                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </td>
                    <td colspan="6"></td>
                </tr>

            </tfoot>

        </table>

    </form>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker();
        $(".date").datepicker("setDate", new Date());
        $(".edit-date").datepicker();

        $(".formRoot").validate();

        $("#account-name").on("change", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var account = $(this).val();
            var url = "<?= base_url('purchase/pay/bill/balance') ?>";

            $.post(url, { account: account }, function(result) 
            {
                var data = JSON.parse(result);

                $("#balance").val(data.amount);

            });

        });

        $("#supplier").on("change", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var supplier = $(this).val();
            var url = "<?= base_url('purchase/pay/bill/supplier/balance') ?>";

            $.post(url, { supplier: supplier }, function(result) 
            {
                var data = JSON.parse(result);

                $("#supplier-balance").val(data.balance);

            });

        });

    });

</script>
