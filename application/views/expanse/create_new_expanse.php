<?php

    $parent = '';
    $child = '';

    if(isset($edit_new_expanse))
    {
        if(!empty($edit_new_expanse['parent']) && !empty($edit_new_expanse['child']))
        {
            $parent = $edit_new_expanse['parent'];
            $child = $edit_new_expanse['child'];
        }
        else
        {
            redirect('admin/create/new/expanse', 'refresh');
        }

    }

?>

<?php if ($type == 'edit'): ?>

    <h4>Edit New Expense</h4>

    <form class="form-horizontal formRoot" action="<?= base_url("admin/new/expanse/update/$parent->id") ?>" method="POST">

        <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

        <div>
            
            <div class="col-sm-3">

                <div class="form-group">

                    <label for="date">Date:</label>
                    <input type="text" name="date" class="form-control date-edit required" value="<?= date("m/d/Y", strtotime($parent->date)) ?>" />

                </div>

            </div>

            <div class="col-sm-3 col-sm-offset-1">

                <div class="form-group">

                    <label for="remark">Remarks:</label>
                    <textarea cols="30" rows="2" name="remark" class="form-control"><?= $parent->remark ?></textarea>

                </div>

            </div>

        </div>

        <table id="myTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Expense Name</th>
                    <th class="col-sm-2">Expense Category</th>
                    <th class="col-sm-2">Account</th>
                    <th class="col-sm-2">Amount</th>
                    <th class="col-sm-2">Description</th>
                    <th class="col-sm-2">Action</th>
                </tr>

            </thead>

            <tbody id="rows">

                <?php if(!empty($child)): ?>

                    <?php foreach ($child as $key => $value): ?>

                        <tr>

                            <td>
                                <select class="form-control" name="details[<?= $key ?>][expanse_name]">

                                    <?php foreach ($expanses as $expanse): ?>
                                        <option <?= ($expanse->expanse_name == $value->expanse_name) ? 'selected=""' : '' ?> value="<?= $expanse->expanse_name ?>"><?= $expanse->expanse_name ?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                                <input type="hidden" readonly="" class="form-control previous-expense-details-id required" name="details[<?= $key ?>][previous_expense_details_id]" value="<?= $value->id ?>" />
                            </td>
                            <td>
                                <select class="form-control" name="details[<?= $key ?>][expanse_category]">

                                    <?php foreach ($expanse_categories as $expanse_category): ?>
                                        <option <?= ($expanse_category->expanse_category_name == $value->expanse_category) ? 'selected=""' : '' ?> value="<?= $expanse_category->expanse_category_name ?>"><?= $expanse_category->expanse_category_name ?></option>
                                    <?php endforeach ?>
                                    <input type="hidden" readonly="" class="form-control required" name="details[<?= $key ?>][type]" value="edit" />
                                </select>
                            </td>
                            <td>
                                <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                                    <select class="form-control" name="details[<?= $key ?>][account]">

                                        <?php foreach ($accounts as $account): ?>
                                            <option <?= ($account->account_name == $value->account) ? 'selected=""' : '' ?> value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                        <?php endforeach ?>
                                        
                                    </select>
                                    <input type="hidden" readonly="" class="form-control previous-account required" name="details[<?= $key ?>][previous_account]" value="<?= $value->account ?>" />

                                <?php else: ?>

                                    <input type="text" readonly="" class="form-control required" name="details[<?= $key ?>][account]" value="<?= $value->account ?>" />
                                    <input type="hidden" readonly="" class="form-control required" name="details[<?= $key ?>][previous_account]" value="<?= $value->account ?>" />

                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>

                                    <input type="text" class="form-control amount required" name="details[<?= $key ?>][amount]" value="<?= $value->amount ?>" />
                                    <input type="hidden" readonly="" class="form-control previous-amount required" name="details[<?= $key ?>][previous_amount]" value="<?= $value->amount ?>" />

                                <?php else: ?>

                                    <input type="text" readonly="" class="form-control amount required" name="details[<?= $key ?>][amount]" value="<?= $value->amount ?>" />
                                    <input type="hidden" readonly="" class="form-control required" name="details[<?= $key ?>][previous_amount]" value="<?= $value->amount ?>" />

                                <?php endif ?>
                            </td>
                            <td>
                                <textarea cols="30" rows="2" class="form-control required" name="details[<?= $key ?>][description]"><?= $value->description ?></textarea>
                            </td>
                            <td class="col-sm-1"><input type="button" class="btn btn-del btn-danger" value="Delete"></td>

                        </tr>

                    <?php endforeach ?>

                <?php endif ?>

            </tbody>

            <tfoot>

                <tr>
                    <td style="text-align: right;" colspan="4">Net Total</td>
                    <td class="col-sm-2">
                        <input type="text" name="net_total" readonly="" class="form-control" value="<?= $parent->net_total ?>"/>
                    </td>
                </tr>

                <td colspan="4"></td>

                <td>
                    <input type="button" class="btn btn-info btn-block" id="addrow" value="Add Row" />
                </td>

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

    <h4>New Expense</h4>

    <form class="form-horizontal formRoot" action="<?= base_url('admin/new/expanse/insert') ?>" method="POST">

        <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

        <div>
            
            <div class="col-sm-3">

                <div class="form-group">

                    <label for="date">Date:</label>
                    <input type="text" name="date" class="form-control date required" />

                </div>

            </div>

            <div class="col-sm-3 col-sm-offset-1">

                <div class="form-group">

                    <label for="remark">Remarks:</label>
                    <textarea cols="30" rows="2" name="remark" class="form-control"></textarea>

                </div>

            </div>

        </div>

        <table id="myTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Expense Name</th>
                    <th class="col-sm-2">Expense Category</th>
                    <th class="col-sm-2">Account</th>
                    <th class="col-sm-2">Amount</th>
                    <th class="col-sm-2">Description</th>
                    <th class="col-sm-2">Action</th>
                </tr>

            </thead>

            <tbody id="rows">

                <tr>
                    <td>
                        <select class="form-control required" name="details[0][expanse_name]">

                            <option value="">Select Expanse Name</option>
                            <?php foreach ($expanses as $expanse): ?>
                                <option value="<?= $expanse->expanse_name ?>"><?= $expanse->expanse_name ?></option>
                            <?php endforeach ?>
                            
                        </select>
                    </td>
                    <td>
                        <select class="form-control required" name="details[0][expanse_category]">

                            <option value="">Select Expanse Category</option>
                            <?php foreach ($expanse_categories as $expanse_category): ?>
                                <option value="<?= $expanse_category->expanse_category_name ?>"><?= $expanse_category->expanse_category_name ?></option>
                            <?php endforeach ?>
                            
                        </select>
                    </td>
                    <td>     
                        <select class="form-control" name="details[0][account]">

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
                                    <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>

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
                        <input type="text" name="details[0][amount]" class="form-control amount required" />
                    </td>
                    <td>
                        <textarea cols="30" rows="2" name="details[0][description]" class="form-control required"></textarea>
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr>
                    <td style="text-align: right;" colspan="4">Net Total</td>
                    <td class="col-sm-2">
                        <input type="text" name="net_total" readonly="" class="form-control"/>
                    </td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                    <td class="col-sm-2">
                        <input type="button" class="btn btn-info btn-block" id="addrow" value="Add Row" />
                    </td>
                </tr>

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
        $(".date-edit").datepicker();
        $(".date").datepicker().datepicker("setDate", new Date());
        $(".formRoot").validate();

        var counter = 100;

        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="details[' + counter + '][expanse_name]"><option>Select Expanse Name</option><?php foreach ($expanses as $expanse): ?><option value="<?= $expanse->expanse_name ?>"><?= $expanse->expanse_name ?></option><?php endforeach ?></select></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][expanse_category]"><option>Select Expanse Category</option><?php foreach ($expanse_categories as $expanse_category): ?><option value="<?= $expanse_category->expanse_category_name ?>"><?= $expanse_category->expanse_category_name ?></option><?php endforeach ?></select></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][account]" onchange="fetchPreviousAccount(this.options[this.selectedIndex].value, $(this));">'
                        +'<option>Select Account</option>'
                        +'<?php if ($this->session->userdata['logged_in']['role'] == 2): ?><option value="Cash In Mirpur">Cash In Mirpur</option><?php foreach ($accounts as $account): ?><?php if ($account->access_type == 1): ?><option value="<?= $account->account_name ?>"><?= $account->account_name ?></option><?php endif ?><?php endforeach ?>'
                        +'<?php elseif ($this->session->userdata['logged_in']['role'] == 3): ?><option value="Cash In Factory">Cash In Factory</option><?php foreach ($accounts as $account): ?><?php if ($account->access_type == 1): ?><option value="<?= $account->account_name ?>"><?= $account->account_name ?></option><?php endif ?><?php endforeach ?>'
                        +'<?php elseif ($this->session->userdata['logged_in']['role'] == 4): ?><option value="Cash In MDP">Cash In MDP</option><?php foreach ($accounts as $account): ?><?php if ($account->access_type == 1): ?><option value="<?= $account->account_name ?>"><?= $account->account_name ?></option><?php endif ?><?php endforeach ?>'
                        +'<?php else: foreach ($accounts as $account): ?><option value="<?= $account->account_name ?>"><?= $account->account_name ?></option><?php endforeach ?><?php endif ?></select>'
                        +'<?php if ($type == 'edit'): ?><input type="hidden" readonly="" class="form-control required" name="details[' + counter + '][previous_account]" /><?php endif ?></td>';
            cols += '<td><input type="text" onchange="fetchPreviousAmount(this.value, $(this));" class="form-control required amount" name="details[' + counter + '][amount]"/><?php if ($type == 'edit'): ?><input type="hidden" readonly="" class="form-control required" name="details[' + counter + '][previous_amount]"/><?php endif ?></td>';
            cols += '<td><textarea cols="30" rows="2" class="form-control" name="details[' + counter + '][description]"></textarea></td>';
            cols += '<td><input type="button" class="btn btn-danger btn-del" value="Delete"></td>';

            newRow.append(cols);
            $("#rows").append(newRow);

            counter++;
        });

        // delete row
        $("#rows").on("click", '.btn-del', function(event) 
        {
            var deleteExpenseAccount = $(this).closest("tr").find('.previous-account').val();
            var deleteExpenseAmount = $(this).closest("tr").find('.previous-amount').val();

            $(this).closest("tr").remove();
            calculateGrandTotal();

            var newRow = $('<tr class="hidden">');
            var cols = "";

            cols += '<td><input type="text" readonly="" class="form-control required" name="details[' + counter + '][type]" value="delete" /></td>';
            cols += '<td><input type="text" readonly="" class="form-control required" name="details[' + counter + '][delete_expense_account]" value="' + deleteExpenseAccount + '" /></td>';
            cols += '<td><input type="text" readonly="" class="form-control required" name="details[' + counter + '][delete_expense_amount]" value="' + deleteExpenseAmount + '" /></td></tr>';

            newRow.append(cols);
            $("#rows").append(newRow);

            counter++;
        });

        $("#rows").on("change", '.amount', function(event) 
        {
            calculateGrandTotal();          
        });

        function calculateGrandTotal() 
        {
            var totalAmount = 0;

            $("#rows").find('tr').each(function() 
            {
                totalAmount += parseFloat($(this).find('.amount').val());
            });

            totalAmount = isNaN(totalAmount) ? 0 : totalAmount;
            var netTotal = totalAmount;
            $('input[name^="net_total"]').val(netTotal.toFixed(2));
        }

    });

    function fetchPreviousAccount(account_name, account_td) 
    {
        account_td.closest('td').find('input').val(account_name);
    }

    function fetchPreviousAmount(amount, amount_td) 
    {
        amount_td.closest('td').find('input').val(amount);
    }

</script>
