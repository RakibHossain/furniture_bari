<?php

    $parent = '';
    $child = '';

    if(isset($edit_bill))
    {
        if(!empty($edit_bill['parent']) && !empty($edit_bill['child']))
        {
            $parent = $edit_bill['parent'];
            $child = $edit_bill['child'];
        }
        else
        {
            redirect('purchase/create/bill', 'refresh');
        }

    }

?>

<h4><?= ucfirst($type) ?> Bill</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("purchase/insert/bill") : base_url("purchase/update/bill/$edit_bill_id") ?>" method="POST">

    <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />
    
    <div class="col-sm-2">

        <div class="form-group">

            <label for="date">Date:</label>

            <?php if ($type == 'new'): ?>

                <input type="text" name="date" class="form-control date required" />

            <?php else: ?>

                <input type="text" name="date" class="form-control edit-date required" value="<?= (!empty($parent->date)) ? date("m/d/Y", strtotime($parent->date)) : '' ?>" />

            <?php endif ?>

        </div>

    </div>

    <div class="col-sm-2 col-sm-offset-1">

        <div class="form-group">

            <label for="invoice">Supplier:</label>
            <select class="form-control" name="supplier">

                <option>Select A Supplier</option>
                <?php foreach ($suppliers as $supplier): ?>

                    <option <?= (!empty($parent)) ? (($supplier->name == $parent->supplier) ? 'selected=""' : '') : "" ?> value="<?= $supplier->name ?>"><?= $supplier->name ?></option>

                <?php endforeach ?>

            </select>
            <?php if ($type == 'edit'): ?>

                <input type="hidden" readonly="" class="form-control required" name="previous_supplier" value="<?= $parent->supplier ?>"/>

            <?php endif ?>
            
        </div>

    </div>

    <div class="col-sm-2 col-sm-offset-1">

        <div class="form-group">

            <label for="remark">Remarks:</label>
            <textarea cols="30" rows="2" class="form-control" name="remark"><?= (!empty($parent)) ? $parent->remark : "" ?></textarea>

        </div>

    </div>

    <?php if ($type == 'new'): ?>

        <div class="col-sm-2" style="position: relative; top: 10px; left: 20px;">

            <label class="checkbox-inline"><input type="checkbox" onclick="showAccount($(this));" name="pay_bill" />Pay Bill</label>

        </div>

        <div class="col-sm-2 hidden hidden-account">

            <div class="form-group">

                <label for="account">Account:</label>
                <select class="form-control account" name="account">

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

            </div>

        </div>

    <?php endif ?>

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th>Stock</th>
                <th class="col-sm-2">PO ID</th>
                <th class="col-sm-2">Purchase Item</th>
                <th class="col-sm-2">Purchase Item Code</th>
                <th class="col-sm-2">Description</th>
                <th class="col-sm-1">Qty</th>
                <th class="col-sm-1">Unit Price</th>
                <th class="col-sm-2">Total</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if(!empty($child)): ?>

                <?php foreach ($child as $key => $value): ?>

                    <tr>
                    
                        <td>
                            <input <?= ($value->stock_status == 1) ? 'checked=""' : '' ?> type="checkbox" onclick="removePO($(this))" name="details[<?= $key ?>][stock_status]">
                        </td>
                        <td>
                            <select class="form-control" name="details[<?= $key ?>][po_id]">

                                <?php foreach ($po_ids as $po_id): ?>

                                    <option <?= ($po_id->po_id == $value->po_id) ? 'selected=""' : '' ?> value="<?= $po_id->po_id ?>"><?= $po_id->po_id ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <select class="form-control required" onchange="fetchPurchaseItemCode(this.options[this.selectedIndex].value, $(this));" name="details[<?= $key ?>][item_name]">

                                <?php foreach ($item_names as $item_name): ?>

                                    <option <?= ($item_name == $value->item_name) ? 'selected=""' : '' ?> value="<?= $item_name ?>"><?= $item_name ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <select class="form-control required item-code" name="details[<?= $key ?>][item_code]">

                                <?php foreach ($item_codes as $item_code): ?>

                                    <option <?= ($item_code->item_code == $value->item_code) ? 'selected=""' : '' ?> value="<?= $item_code->item_code ?>"><?= $item_code->item_code ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <textarea cols="30" rows="2" class="form-control" name="details[<?= $key ?>][description]"><?= $value->description ?></textarea>
                        </td>
                        <td>
                            <input type="text" class="form-control row_qty required" name="details[<?= $key ?>][qty]" value="<?= $value->qty ?>"/>
                            <input type="hidden" readonly="" class="form-control previous_row_qty required" name="details[<?= $key ?>][previous_qty]" value="<?= $value->qty ?>"/>
                        </td>
                        <td >
                            <input type="text" class="form-control row_unit_price required" name="details[<?= $key ?>][unit_price]" value="<?= $value->unit_price ?>"/>
                        </td>
                        <td class="col-sm-2">

                            <input type="text" readonly=""  class="form-control row_total required" name="details[<?= $key ?>][total]" value="<?= $value->total ?>"/>
                            <input type="hidden" readonly=""  class="form-control previous_row_total required" name="details[<?= $key ?>][previous_total]" value="<?= $value->total ?>"/>

                        </td>

                    </tr>

                <?php endforeach ?>

            <?php else: ?>

                <tr>

                    <td>
                        <input type="checkbox" onclick="removePO($(this))" name="details[0][stock_status]" />
                    </td>
                    <td>
                        <select class="form-control" name="details[0][po_id]">

                            <option>Select PO ID</option>
                            <?php foreach ($po_ids as $po_id): ?>

                                <option value="<?= $po_id->po_id ?>"><?= $po_id->po_id ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <select class="form-control required" onchange="fetchPurchaseItemCode(this.options[this.selectedIndex].value, $(this));" name="details[0][item_name]">

                            <option>Select Item Name</option>
                            <?php foreach ($item_names as $item_name): ?>

                                <option value="<?= $item_name ?>"><?= $item_name ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <select class="form-control required item-code" name="details[0][item_code]">

                            <option>Select Item Code</option>

                        </select>
                    </td>
                    <td>
                        <textarea cols="30" rows="2" name="details[0][description]" class="form-control"></textarea>
                    </td>
                    <td>
                        <input type="text" name="details[0][qty]" class="form-control row_qty required"/>
                    </td>
                    <td>
                        <input type="text" name="details[0][unit_price]" class="form-control row_unit_price required"/>
                    </td>
                    <td>
                        <input type="text" name="details[0][total]" readonly="" class="form-control row_total required"/>
                    </td>

                </tr>

            <?php endif ?>

        </tbody>

        <tbody>

            <tr>
                <td colspan="4"></td>
                <td style="text-align:right;">Total Qty</td>
                <td>
                    <input type="text" readonly name="total_qty"  class="form-control" value="<?= (!empty($parent)) ? $parent->total_qty : ""; ?>" />
                </td>
                <td style="text-align:right;">Total Amount</td>
                <td class="col-sm-2">
                    <input type="text" name="total_amount" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->total_amount : ""; ?>" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;" colspan="7">Discount Amount</td>
                <td class="col-sm-2">
                    <input type="text" name="discount" class="form-control" value="<?= (!empty($parent)) ? $parent->discount : ""; ?>" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;" colspan="7">Net Total</td>
                <td class="col-sm-2">
                    <input type="text" name="net_total" readonly="" class="form-control" value="<?= (!empty($parent)) ? $parent->net_total : ""; ?>" />
                    <?php if ($type == 'edit'): ?>
                        <input type="hidden" name="previous_net_total" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->net_total : ""; ?>" />
                    <?php endif ?>
                </td>
                <td></td>
            </tr>

        </tbody>

        <tfoot>

            <tr>
                <td colspan="7"></td>
                <td style="text-align: right;">
                    <input type="button" class="btn btn-danger btn-block" id="addrow" value="Add Row" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left;">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </td>
            </tr>

        </tfoot>

    </table>

</form>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker();
        $(".date").datepicker("setDate", new Date());
        $(".edit-date").datepicker();

        $(".formRoot").validate();

        var counter = 100;

        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><input type="checkbox" onclick="removePO($(this))" name="details[' + counter + '][stock_status]" /></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][po_id]"><option>Select PO ID</option><?php foreach ($po_ids as $po_id): ?><option value="<?= $po_id->po_id ?>"><?= $po_id->po_id ?></option><?php endforeach ?></select></td>';
            cols += '<td><select class="form-control required" onchange="fetchPurchaseItemCode(this.options[this.selectedIndex].value, $(this));" name="details[' + counter + '][item_name]"><option>Select Item Name</option><?php foreach ($item_names as $item_name): ?><option value="<?= $item_name ?>"><?= $item_name ?></option><?php endforeach ?></select></td>';
            cols += '<td><select class="form-control required item-code" name="details[' + counter + '][item_code]"><option>Select Item Code</option></select></td>';
            cols += '<td><textarea cols="30" rows="2" class="form-control" name="details[' + counter + '][description]"></textarea></td>';
            cols += '<td><input type="text" class="form-control row_qty required" name="details[' + counter + '][qty]"/></td>';
            cols += '<td><input type="text" class="form-control row_unit_price required" name="details[' + counter + '][unit_price]"/></td>';
            cols += '<td><input type="text" class="form-control row_total required" readonly="" name="details[' + counter + '][total]"/></td>';
            cols += '<td><input type="button" class="btn-del btn btn-md btn-danger" value="Delete"></td></tr>';

            newRow.append(cols);
            
            $("#rows").append(newRow);

            counter++;

        });

        $("#rows").on("change", '.row_qty, .row_unit_price', function (event) 
        {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();             
        });

        $('input[name^="discount"]').on("change", function (event) 
        {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();                
        });

        $("#rows").on("click", '.btn-del', function (event) 
        {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });

    });

    function showAccount(paybill) 
    {
        if (paybill.is(':checked')) 
        {
            $(".hidden-account").removeClass("hidden");
        } 
        else 
        {
            $(".hidden-account").addClass("hidden");
        }

    }

    function removePO(stock)
    {
        if (stock.is(':checked')) 
        {
            stock.closest('td').next('td').find('select').hide();
        }
        else
        {
            stock.closest('td').next('td').find('select').show();
        }

    }

    function fetchPurchaseItemCode(item_name, item_code_td) 
    {
        var url = "<?= base_url('fetch/purchase/item/code') ?>";

        $.post(url, { item_name: item_name }, function(result) 
        {
            item_code_td.closest('td').next('td').find('.item-code').html(result);

        });

    }

    function calculateRow(row) 
    {
        var unitPrice = row.find('.row_unit_price').val();
        var qty = +row.find('.row_qty').val();

        var totalAmount = parseFloat(unitPrice) * parseFloat(qty);

        if(isNaN(totalAmount))
        {
            totalAmount = 0;
        }

        row.find('.row_total').val(totalAmount.toFixed(2));
    }

    function calculateGrandTotal() 
    {
        var totalAmount = 0;
        var totalQty = 0;

        $("#rows").find('tr').each(function () 
        {
            totalAmount += parseFloat($(this).find('.row_total').val());
            totalQty += parseInt($(this).find('.row_qty').val());
        });

        totalQty = isNaN(totalQty) ? 0 : totalQty;
        totalAmount = isNaN(totalAmount) ? 0 : totalAmount;

        var discount = parseInt($('input[name^="discount"]').val());
        discount = isNaN(discount) ? 0 : discount;

        var netTotal = totalAmount - discount;

        $('input[name^="total_qty"]').val(totalQty);
        $('input[name^="total_amount"]').val(totalAmount.toFixed(2));
        $('input[name^="net_total"]').val(netTotal.toFixed(2));
    }

</script>
