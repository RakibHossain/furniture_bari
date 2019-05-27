<h4>Account Cash Inflow</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("account/insert/cashinflow") : base_url("account/update/cashinflow/$edit_cash_inflow_id") ?>" method="POST">

    <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />
    
    <div class="col-sm-12">
        
        <div class="col-sm-6">

            <div class="form-group">

                <label class="control-label col-xs-4">Payment Type</label>

                <div class="col-xs-8">

                    <select class="form-control required" name="payment_type">

                        <?php foreach ($payment_types as $payment_type): ?>
                            <option <?= ((!empty($edit_cash_inflow)) && ($payment_type->type == $edit_cash_inflow->payment_type)) ? 'selected=""' : '' ?> value="<?= $payment_type->type ?>"><?= $payment_type->type ?></option>
                        <?php endforeach ?>

                    </select>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-xs-4">Reference No</label>

                <div class="col-xs-8">

                    <select class="form-control required" name="reference_no">

                        <?php foreach ($references as $reference): ?>
                            <option <?= ((!empty($edit_cash_inflow)) && ($reference->reference_name == $edit_cash_inflow->reference_no)) ? 'selected=""' : '' ?> value="<?= $reference->reference_name ?>"><?= $reference->reference_name ?></option>
                        <?php endforeach ?>

                    </select>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-xs-4">Amount</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control required" name="amount" value="<?= (!empty($edit_cash_inflow)) ? $edit_cash_inflow->amount : "" ?>" />
                    <?php if ($type == 'edit'): ?>
                        <input type="hidden" class="form-control required" name="previous_amount" value="<?= (!empty($edit_cash_inflow)) ? $edit_cash_inflow->amount : "" ?>" />
                    <?php endif ?>
                </div>

            </div>

        </div>

        <div class="col-sm-6">
            
            <div class="form-group">

                <label class="control-label col-xs-4">Date</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control required date" name="date" value="<?= (!empty($edit_cash_inflow)) ? $edit_cash_inflow->date : "" ?>" />
                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-xs-4">Account</label>

                <div class="col-xs-8">

                    <?php if ($type == 'new'): ?>

                        <select class="form-control required" name="account_name">

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

                    <?php else: ?>

                        <input type="text" readonly="" class="form-control required" name="account_name" value="<?= (!empty($edit_cash_inflow)) ? $edit_cash_inflow->account_name : "" ?>" />
                        <input type="hidden" class="form-control required" name="previous_account_name" value="<?= (!empty($edit_cash_inflow)) ? $edit_cash_inflow->account_name : "" ?>" />

                    <?php endif ?>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-xs-4">Remarks</label>
                <div class="col-xs-8">
                    <textarea cols="30" rows="4" class="form-control" name="remark"><?= (!empty($edit_cash_inflow)) ? $edit_cash_inflow->remark : "" ?></textarea>
                </div>

            </div>

        </div>

    </div>

    <div class="form-group">

        <div class="col-xs-offset-2 col-xs-10">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </div>

</form>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker();
        $(".date").datepicker("setDate", new Date());

        $(".formRoot").validate();
    });

</script>
