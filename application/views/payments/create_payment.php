<?php
    
    $edit_data = '';

    if(isset($data))
    {
        if(!empty($data))
        {
            $edit_data = $data;
        }
        else
        {
            redirect('admin/payment', 'refresh');
        }

    }

?>

<form class="form-horizontal" id="formRoot" action="" method="POST">

    <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

    <div class="col-sm-12">

        <?php if ($type == 'edit'): ?>
            
            <div class="col-sm-6">
                
                <div class="form-group">
                
                    <label class="control-label col-xs-4">Order No</label>
                    <div class="col-xs-8">

                        <?php

                            $order_list = [''=>'Select Order No'] + $order_list;
                            $order_no = $edit_data->ji_invoice_id;

                            echo form_dropdown('ji_invoice_id', $order_list, $order_no, ['class'=>'form-control required']);
                        ?>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Payment Type</label>
                    <div class="col-xs-8">

                        <select class="form-control required" name="payment_type">

                            <?php foreach ($types as $type): ?>
                                <option <?= ($type->type == $edit_data->payment_type) ? 'selected=""' : '' ?> value="<?= $type->type ?>"><?= $type->type ?></option>
                            <?php endforeach ?>

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Reference No</label>
                    <div class="col-xs-8">

                        <?php
                            $reference_no_options = [
                                ''         => 'Select Reference',
                                'Advance'  => 'Advance',
                                'Delivery' => 'Delivery'
                            ];
                            echo form_dropdown('reference_no', $reference_no_options, (!empty($edit_data)) ? $edit_data->reference_no : '', ['class'=>'form-control required']);
                        ?>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Amount</label>
                    <div class="col-xs-8">

                        <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>

                            <input type="text" class="form-control required" name="amount" value="<?= (!empty($edit_data)) ? $edit_data->amount : ""; ?>">
                            <input type="hidden" readonly="" class="form-control" name="previous_amount" value="<?= (!empty($edit_data)) ? $edit_data->amount : ""; ?>">

                        <?php else: ?>

                            <input type="text" readonly="" class="form-control" name="amount" value="<?= (!empty($edit_data)) ? $edit_data->amount : ""; ?>">
                            <input type="hidden" readonly="" class="form-control" name="previous_amount" value="<?= (!empty($edit_data)) ? $edit_data->amount : ""; ?>">

                        <?php endif ?>

                    </div>

                </div>
                
                <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                    <div class="col-sm-offset-2">
                        <div class="checkbox">
                            <label><input type="checkbox" <?= ($edit_data->receive_status == 1) ? 'checked=""' : '' ?> name="receive_status">Payment Received</label>
                        </div>
                    </div>
                <?php endif ?>

            </div>

            <div class="col-sm-6">
                
                <div class="form-group">

                    <label class="control-label col-xs-4">Date</label>
                    <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                        <div class="col-xs-8">
                            <input type="text" class="form-control required edit-date" name="date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data->date)) : ""; ?>">
                        </div>
                    <?php else: ?>
                        <div class="col-xs-8">
                            <input type="text" readonly="" class="form-control required" name="date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data->date)) : ""; ?>">
                        </div>
                    <?php endif ?>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Account</label>

                    <div class="col-xs-8">

                        <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                            <select class="form-control required" name="account_name">

                                <?php foreach ($accounts as $account): ?>
                                    <option <?= ($account->account_name == $edit_data->account_name) ? 'selected=""' : '' ?> value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endforeach ?>

                            </select>
                            <input type="hidden" class="form-control" readonly="" name="previous_account_name" value="<?php echo (!empty($edit_data)) ? $edit_data->account_name : ""; ?>">

                        <?php else: ?>

                            <input type="text" class="form-control" readonly="" name="account_name" value="<?php echo (!empty($edit_data)) ? $edit_data->account_name : ""; ?>">
                            <input type="hidden" class="form-control" readonly="" name="previous_account_name" value="<?php echo (!empty($edit_data)) ? $edit_data->account_name : ""; ?>">

                        <?php endif ?>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Remarks</label>
                    <div class="col-xs-8">
                        <textarea cols="30" rows="4" class="form-control" name="remarks"><?php echo (!empty($edit_data)) ? $edit_data->remarks : ""; ?></textarea>
                    </div>

                </div>

            </div>

        <?php else: ?>
            
            <div class="col-sm-6">
                
                <div class="form-group">
                
                    <label class="control-label col-xs-4">Order No</label>
                    <div class="col-xs-8">

                        <?php

                            $order_list = [''=>'Select Order No'] + $order_list;
                            $order_no = '';
                            $order_date = '';

                            if(isset($_GET['order']))
                            {
                                $order_no = $_GET['order'];
                                $order_date = $_GET['date'];
                            }

                            echo form_dropdown('ji_invoice_id', $order_list, $order_no, ['class'=>'form-control required']);
                        ?>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Payment Type</label>
                    <div class="col-xs-8">

                        <select class="form-control required" name="payment_type">

                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type->type ?>"><?= $type->type ?></option>
                            <?php endforeach ?>

                        </select>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Reference No</label>
                    <div class="col-xs-8">

                        <?php

                            $reference_no_options = array(
                                '' => 'Select Reference',
                                'Advance' => 'Advance',
                                'Delivery' => 'Delivery'
                            );

                            echo form_dropdown('reference_no', $reference_no_options, (!empty($edit_data)) ? $edit_data->reference_no : '', ['class'=>'form-control required']);
                        ?>

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Amount</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control required" name="amount" value="">
                    </div>

                </div>

            </div>

            <div class="col-sm-6">
                
                <div class="form-group">

                    <label class="control-label col-xs-4">Date</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control required date" name="date" value="">
                        <input type="hidden" class="form-control required hidden-date" name="hidden_date" value="<?=date("m/d/Y", strtotime($order_date))?>">
                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Account</label>

                    <div class="col-xs-8">

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

                    </div>

                </div>

                <div class="form-group">

                    <label class="control-label col-xs-4">Remarks</label>
                    <div class="col-xs-8">
                        <textarea cols="30" rows="4" class="form-control" name="remarks"></textarea>
                    </div>

                </div>

            </div>

        <?php endif ?>

    </div>

    <div class="clearfix"></div>

    <br>
    <br>

    <div class="form-group">

        <div class="col-xs-offset-2 col-xs-10">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </div>

</form>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".edit-date").datepicker();
        $(".date").datepicker({
            numberOfMonths: 1,
            minDate: $(".hidden-date").val(),
            maxDate: "+2Y",
            dateFormat: 'mm/dd/yy',
            onSelect: function(selected) 
            {
                datepicker("option", "minDate", selected);
            }

        });

        $(".date").datepicker("setDate", new Date());

        $("#formRoot").validate();
    });

</script>
