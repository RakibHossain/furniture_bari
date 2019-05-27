<?php if ($type == 'new'): ?>

    <h4><?= ucfirst($type) ?> Pay Bill</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("worker/insert/pay/bill") ?>" method="POST">

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

                    <label for="worker">Worker Name:</label>
                    <select class="form-control" name="worker" id="worker-name">

                        <option>Select A Worker</option>
                        <?php foreach ($workers as $worker): ?>

                            <option value="<?= $worker->name ?>"><?= $worker->name ?></option>

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
                    <input type="text" id="worker-balance" readonly="" class="form-control" />

                </div>

            </div>
            
        </div>

        <table id="myTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">PO ID</th>
                    <th class="col-sm-2">Account</th>
                    <th class="col-sm-2">A/C Balance</th>
                    <th class="col-sm-2">Amount</th>
                    <th class="col-sm-2">Reference No.</th>
                    <th class="col-sm-2">Remarks</th>
                </tr>

            </thead>

            <tbody id="rows">

                <tr>

                    <td>
                        <select class="form-control required poId" name="po_id">

                            <option>Select A PO</option>

                        </select>
                    </td>
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
                        <input type="text" id="acc-balance" readonly="" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="amount"  class="form-control required" />
                    </td>
                    <td>
                        <input type="text" name="reference_no"  class="form-control" />
                    </td>
                    <td>
                        <textarea cols="30" rows="2" name="remark" class="form-control"></textarea>
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

    <h4><?= ucfirst($type) ?> Pay Bill</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("worker/update/pay/bill/$edit_pay_bill_id") ?>" method="POST">

        <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />
        
        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-5">

                <div class="form-group">

                    <label for="date">Date:</label>
                    <input type="text" name="date" class="form-control edit-date required" value="<?= (!empty($edit_pay_bill)) ? date("m/d/Y", strtotime($edit_pay_bill->date)) : "" ?>" />

                </div>

            </div>

            <div class="col-sm-5 col-sm-offset-1">

                <div class="form-group">

                    <label for="worker">Worker:</label>
                    <select class="form-control" name="worker" id="worker-name">

                        <?php foreach ($workers as $worker): ?>

                            <option <?= ($worker->name == $edit_pay_bill->worker) ? 'selected=""' : '' ?> value="<?= $worker->name ?>"><?= $worker->name ?></option>

                        <?php endforeach ?>

                    </select>
                    <input type="hidden" name="previous_worker" class="form-control" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->worker : "" ?>" />

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
                    <input type="text" id="worker-balance" readonly="" class="form-control" />

                </div>

            </div>
            
        </div>

        <table id="myTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">PO ID</th>
                    <th class="col-sm-2">Account</th>
                    <th class="col-sm-2">A/C Balance</th>
                    <th class="col-sm-2">Amount</th>
                    <th class="col-sm-2">Reference No.</th>
                    <th class="col-sm-2">Remarks</th>
                </tr>

            </thead>

            <tbody id="rows">

                <tr>

                    <td>
                        <select class="form-control poId" name="po_id">

                            <option>Select A PO</option>
                            <?php foreach ($production_processes as $production_process): ?>

                                <option <?= ($production_process->po_id == $edit_pay_bill->po_id) ? 'selected=""' : '' ?> value="<?= $production_process->po_id ?>"><?= $production_process->po_id ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                            <select class="form-control required" id="account-name" name="account">

                                <?php foreach ($accounts as $account): ?>

                                    <option <?= ($account->account_name == $edit_pay_bill->account) ? 'selected=""' : '' ?> value="<?= $account->account_name ?>"><?= $account->account_name ?></option>

                                <?php endforeach ?>

                            </select>
                            <input type="hidden" readonly="" name="previous_account" class="form-control" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->account : "" ?>" />

                        <?php else: ?>

                            <input type="text" name="account" readonly="" class="form-control" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->account : "" ?>" />

                        <?php endif ?>
                    </td>
                    <td>
                        <input type="text" id="acc-balance" readonly="" class="form-control" />
                    </td>
                    <td>
                        <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                            <input type="text" name="amount" class="form-control required" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->amount : "" ?>" />
                            <input type="hidden" readonly="" name="previous_amount" class="form-control" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->amount : "" ?>" />

                        <?php else: ?>

                            <input type="text" readonly="" name="amount" class="form-control required" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->amount : "" ?>" />

                        <?php endif ?>
                    </td>
                    <td>
                        <input type="text" name="reference_no"  class="form-control" value="<?= (!empty($edit_pay_bill)) ? $edit_pay_bill->reference_no : "" ?>" />
                    </td>
                    <td >
                        <textarea cols="30" rows="2" name="remark" class="form-control"><?= (!empty($edit_pay_bill)) ? $edit_pay_bill->remark : "" ?></textarea>
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

            $.post(url, { account: account }, function(data) 
            {
                var a = JSON.parse(data);

                if (a.amount != '') 
                {
                    $("#acc-balance").val(a.amount);
                }

            });

        });

        $("#worker-name").on("change", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var worker_name = $(this).val();
            var url = "<?= base_url('worker/pay/bill/balance') ?>";

            $.post(url, { worker_name: worker_name }, function(data) 
            {
                var a = JSON.parse(data);

                if (a.amount != '') 
                {
                    $("#worker-balance").val(a.balance);
                }

            });

        });

        $("#worker-name").on("change", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var worker_name = $(this).val();
            var url = "<?= base_url('worker/pay/bill/poid') ?>";

            $.post(url, { worker_name: worker_name }, function(result) 
            {
                $(".poId").html(result);   
            });

        });

    });

</script>
