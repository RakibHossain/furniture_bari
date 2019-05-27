<?php

    $edit_data = '';

    if(isset($data))
    {
        if(!empty($data['parent']))
        {
            $edit_data = $data;
            $id = $edit_data['parent']->id;
            $order_date = $edit_data['parent']->order_date;
        }
        else
        {
            redirect('admin/invoice', 'refresh');
        }

    }

?>

<?php if($edit_data): ?>

    <?php if ($this->session->flashdata('success_status')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success_status') ?></div>
    <?php elseif ($this->session->flashdata('error_status')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error_status') ?></div>
    <?php endif ?>

    <div class="row">

        <div class="col-sm-12">

            <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 3) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                <a href="<?= base_url("send/sms/before/delivery/$id") ?>" class="btn btn-warning btn-sm"><?php if(!empty($send_before_delivery_sms[0]->sms_type)): ?><i class="fa fa-envelope"></i><?php endif ?> Send SMS Before Delivery</a>
            <?php endif ?>

        </div>

        <div class="pull-right">
            <label>Total Due : <?= (isset($due[0])) ? $due[0]->total_due : 0 ?></label><br>
            <a href="<?= base_url("admin/payment?order=$id&date=$order_date") ?>" class="btn btn-success">Payment Entry</a>
        </div>

    </div>

<?php endif ?>

<form class="form-horizontal" id="formRoot" action="" method="POST">

    <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

    <div class="col-sm-12">
        
        <h4>Basic Information</h4>

        <div class="col-sm-6">  
            
            <div class="form-group">
                <label class="control-label col-xs-4">Invoice No</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" readonly="" name="order_no" value="<?= (!empty($edit_data)) ? $edit_data['parent']->order_no : ""; ?>">
                </div>    
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Order Date</label>
                <div class="col-xs-8">
                    <?php if ($type == 'edit'): ?>
                        <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                            <input type="text" readonly="" class="form-control required edit_order_date" name="order_date" value="<?= (!empty($edit_data)) ? $edit_data['parent']->order_date : ""; ?>">
                        <?php else: ?>
                            <input type="text" readonly="" class="form-control required" name="order_date" value="<?= (!empty($edit_data)) ? $edit_data['parent']->order_date : ""; ?>">
                        <?php endif ?>
                    <?php else: ?>
                        <input type="text" readonly="" class="form-control required order_date" name="order_date" value="<?= (!empty($edit_data)) ? $edit_data['parent']->order_date : ""; ?>">
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Sales Person</label>
                <div class="col-xs-8">
                    <select class="form-control" name="sales_person">
                        <?php foreach ($sales_persons as $sales_person): ?>
                            <option <?= ((!empty($edit_data)) && ($sales_person->name == $edit_data['parent']->sales_person)) ? 'selected=""' : '' ?> value="<?= $sales_person->name ?>"><?= $sales_person->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Sales Assistent</label>
                <div class="col-xs-8">
                    <select class="form-control" name="sales_assistent">
                        <option value="">Select An Assistent</option>
                        <?php foreach ($sales_persons as $sales_person): ?>
                            <option <?= ((!empty($edit_data)) && ($sales_person->name == $edit_data['parent']->sales_assistent)) ? 'selected=""' : '' ?> value="<?= $sales_person->name ?>"><?= $sales_person->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Factory</label>
                <div class="col-xs-8">
                    <select class="form-control" name="factory">
                        <?php foreach ($factories as $factory): ?>
                            <option <?= ((!empty($edit_data)) && ($factory->factory == $edit_data['parent']->factory)) ? 'selected=""' : '' ?> value="<?= $factory->factory ?>"><?= $factory->factory ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Order By</label>
                <div class="col-xs-8">
                    <select class="form-control" name="order_by">
                        <?php foreach ($order_by_names as $order_by_name): ?>
                            <option <?= ((!empty($edit_data)) && ($order_by_name->order_by_name == $edit_data['parent']->order_by)) ? 'selected=""' : '' ?> value="<?= $order_by_name->order_by_name ?>"><?= $order_by_name->order_by_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            
            <div class="form-group">
                <label class="control-label col-xs-4">Delivery By</label>
                <div class="col-xs-8">
                    <select class="form-control" name="delivery_by">
                        <?php foreach ($delivery_by_names as $delivery_by_name): ?>
                            <option <?= ((!empty($edit_data)) && ($delivery_by_name->delivery_by_name == $edit_data['parent']->delivery_by)) ? 'selected=""' : '' ?> value="<?= $delivery_by_name->delivery_by_name ?>"><?= $delivery_by_name->delivery_by_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Delivery Date</label>
                <div class="col-xs-8">
                    <?php if ($type == 'edit'): ?>
                        <input type="text" readonly="" class="form-control required edit_delivery_date" name="delivery_date" value="<?= (!empty($edit_data)) ? $edit_data['parent']->delivery_date : ""; ?>">
                    <?php else: ?>
                        <input type="text" readonly="" class="form-control required delivery_date" name="delivery_date" value="<?= (!empty($edit_data)) ? $edit_data['parent']->delivery_date : ""; ?>">
                    <?php endif ?>       
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-xs-4">Remarks</label>
                <div class="col-xs-8">
                    <textarea cols="30" rows="3" class="form-control" name="remarks"><?php echo (!empty($edit_data)) ? $edit_data['parent']->remarks : ""; ?></textarea>
                </div>
            </div>

            <div class="form-group">

                <label class="control-label col-xs-4">Status</label>

                <div class="col-xs-8">

                    <?php

                        if ($this->session->userdata['logged_in']['role'] == 1 || $this->session->userdata['logged_in']['role'] == 5) 
                        {
                            $status_options = array('-1' => 'Cancel', '1' => 'Pending', '2' => 'Courier', '3' => 'Complete', '4' => 'Due Receipt');
                        } 
                        else 
                        {
                            $status_options = array('1' => 'Pending', '2' => 'Courier', '4' => 'Due Receipt');
                        }

                        $status_attribute = array('class' => 'form-control',);
                        echo form_dropdown('status', $status_options, (!empty($edit_data)) ? $edit_data['parent']->status : "1", $status_attribute);
                    ?>

                </div>

            </div>

            <div class="form-group" style="display:none;">
                <label class="control-label col-xs-4">Reason</label>
                <div class="col-xs-8">
                    <textarea cols="30" rows="4" class="form-control" name="reason"><?php echo (!empty($edit_data)) ? $edit_data['parent']->reason : ""; ?></textarea>
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-12">
        
        <h4>Customer Information</h4>

        <div class="col-sm-6">  
            
            <div class="form-group">
                <label class="control-label col-xs-4">Customer Name</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control required" name="customer_name" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->customer_name : ""; ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Mobile No</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control required" name="mobile_no" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->mobile_no : ""; ?>" placeholder="01xxxxxxxxx,01xxxxxxxxx" />
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            
            <div class="form-group">
                <label class="control-label col-xs-4">Address</label>
                <div class="col-xs-8">
                    <textarea cols="30" rows="4" class="form-control" name="address"><?php echo (!empty($edit_data)) ? $edit_data['parent']->address : ""; ?></textarea>
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-12">
        
        <h4>Product Delivery Status</h4>

        <div class="col-sm-6">
            
            <div class="form-group">

                <label class="control-label col-xs-4">Urgency</label>
                <div class="col-xs-8">
                    <select class="form-control" name="urgency_status">

                        <?php if ($type == 'edit'): ?>

                            <option <?= ($edit_data['parent']->urgency_status == 3) ? 'selected=""' : '' ?> value="3">Normal</option>
                            <option <?= ($edit_data['parent']->urgency_status == 2) ? 'selected=""' : '' ?> value="2">Urgent</option>
                            <option <?= ($edit_data['parent']->urgency_status == 1) ? 'selected=""' : '' ?> value="1">Very Urgent</option>

                        <?php else: ?>

                            <option value="3">Normal</option>
                            <option value="2">Urgent</option>
                            <option value="1">Very Urgent</option>

                        <?php endif ?>

                    </select>
                </div>
                
            </div>

        </div>

    </div>
    
    <div class="clearfix"></div>

    <h4>Product Details</h4>

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Item Name</th>
                <th class="col-sm-2">Item Code</th>
                <th class="col-sm-1"><i class="fa fa-cog"></i></th>
                <th class="col-sm-3">Description</th>
                <th class="col-sm-1">Qty</th>
                <th class="col-sm-1">Unit Price</th>
                <th class="col-sm-2">Total</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if(!empty($edit_data)): ?>

                <?php foreach ($edit_data['child'] as $key => $value): ?>

                    <tr>

                        <td>
                            <select class="form-control required item-name" onchange="fetchInvoiceItemCode(this.options[this.selectedIndex].value, $(this));" name="details[<?= $key ?>][item_name]">
                                <option>Select Item Name</option>
                                <?php foreach ($item_names as $item_name): ?>
                                    <option <?= ($item_name == $value['item_name']) ? 'selected=""' : '' ?> value="<?= $item_name ?>"><?= $item_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control required item-code" onchange="fetchStockStatus(this.options[this.selectedIndex].value, $(this));" name="details[<?= $key ?>][item_code]">
                                <option>Select Item Code</option>
                                <?php foreach ($item_codes as $item_code): ?>
                                    <option <?= ($item_code->item_code == $value['item_code']) ? 'selected=""' : '' ?> value="<?= $item_code->item_code ?>"><?= $item_code->item_code ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                            <label><input type="checkbox" <?= ($value['stock_status'] == 1) ? 'checked=""' : '' ?> class="checkbox" value="<?= $value['stock_status'] ?>" name="details[<?= $key ?>][stock_status]"/><span <?= ($value['stock_status'] == 1) ? 'style="color: green;"' : '' ?> class="stock_status">Stock</span></label>
                        </td>
                        <td>
                            <textarea cols="30" rows="2" class="form-control" name="details[<?= $key ?>][description]"><?= $value['description'] ?></textarea>
                        </td>
                        <td>
                            <input type="text" class="form-control row_qty required" value="<?= $value['qty'] ?>" name="details[<?= $key ?>][qty]"/>
                            <input type="hidden" readonly="" class="form-control" value="<?= $value['qty'] ?>" name="details[<?= $key ?>][previous_qty]"/>
                        </td>
                        <td >
                            <input type="text" class="form-control row_unit_price required" value="<?= $value['unit_price'] ?>" name="details[<?= $key ?>][unit_price]"/>
                        </td>
                        <td class="col-sm-2">
                            <input type="text" readonly="" class="form-control row_total required" value="<?= $value['total'] ?>" name="details[<?= $key ?>][total]"/>
                            <input type="hidden" readonly="" class="form-control" value="<?= $value['total'] ?>" name="details[<?= $key ?>][previous_total]"/>
                        </td>
                        <td class="col-sm-1"><input type="button" class="btnDel btn btn-md btn-danger" value="Delete"></td>

                    </tr>

                <?php endforeach ?>

            <?php else: ?>

                <tr>

                    <td>
                        <select class="form-control required item-name" onchange="fetchInvoiceItemCode(this.options[this.selectedIndex].value, $(this));" name="details[0][item_name]">
                            <option>Select Item Name</option>
                            <?php foreach ($item_names as $item_name): ?>
                                <option value="<?= $item_name ?>"><?= $item_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control required item-code" onchange="fetchStockStatus(this.options[this.selectedIndex].value, $(this));" name="details[0][item_code]">
                            <option>Select Item Code</option>
                        </select>
                    </td>
                    <td>
                        <label><input type="checkbox" class="checkbox" name="details[0][stock_status]" /><span class="stock_status">Stock</span></label>
                    </td>
                    <td>
                        <textarea cols="30" rows="2" class="form-control" name="details[0][description]"></textarea>
                    </td>
                    <td>
                        <input type="text" name="details[0][qty]" class="form-control row_qty required"/>
                    </td>
                    <td >
                        <input type="text" name="details[0][unit_price]" class="form-control row_unit_price required"/>
                    </td>
                    <td class="col-sm-2">
                        <input type="text" name="details[0][total]" readonly="" class="form-control row_total required"/>
                    </td>
                    <td class="col-sm-1"></td>

                </tr>

            <?php endif ?>
        
        </tbody>

        <tbody>

            <tr>
                <td colspan="3"></td>
                <td style="text-align:right;">
                    Total Qty
                </td>
                <td>
                    <input type="text" readonly name="total_qty"  class="form-control" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->total_qty : ""; ?>"/>
                </td>
                <td style="text-align:right;">
                    Total Amount
                </td>
                <td class="col-sm-2">
                    <input type="text" name="total_amount" readonly  class="form-control" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->total_amount : ""; ?>"/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;" colspan="6">Advance Payment
                </td>
                <td class="col-sm-2">
                    <input type="text" readonly class="form-control" value="<?php echo (!empty($edit_data)) ? $edit_data['advance_fetch']->amount : ""; ?>"/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;" colspan="6">Delivery Charge
                </td>
                <td class="col-sm-2">
                    <input type="text" name="delivery_charge" class="form-control" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->delivery_charge : ""; ?>"/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;" colspan="6">Discount Amount
                </td>
                <td class="col-sm-2">
                    <input type="text" name="discount" class="form-control" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->discount : ""; ?>"/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;" colspan="6">Net Total
                </td>
                <td class="col-sm-2">
                    <input type="text" name="net_total" readonly=""  class="form-control" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->net_total : ""; ?>"/>
                </td>
                <td></td>
            </tr>

        </tbody>

        <tfoot>

            <tr>
                <td colspan="6"></td>
                <td style="text-align: right;">
                    <input type="button" class="btn btn-block btn-danger" id="addrow" value="Add Row" />
                </td>
                <td></td>
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

<?php if(!empty($edit_data['edit_history'])): ?>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title">Edit Invoice History</h3>
                </div>

                <table class="table">

                    <thead>

                        <tr>
                            <th width="6%">#</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>User</th>
                            <th>Field</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($edit_data['edit_history'] as $key => $edit_history): ?>

                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= date("d/m/Y", strtotime($edit_history->edit_date)) ?></td>
                                <td><?= $edit_history->edit_time ?></td>
                                <td><?= $edit_history->user_name ?></td>
                                <td><?= $edit_history->field_name ?></td>
                            </tr>

                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

<?php endif ?>

<script type="text/javascript">
    
    $(function () 
    {
        $("#formRoot").validate();
        // $(".item-name").select2();

        $(".order_date").datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
                $(".delivery_date").datepicker("option", "minDate", selected);
            }

        });

        $(".order_date").datepicker("setDate", new Date());
        
        $(".delivery_date").datepicker({ 
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
               $(".order_date").datepicker("option", "maxDate", selected);
            }

        });

        $(".edit_order_date").datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
                $(".edit_delivery_date").datepicker("option", "minDate", selected);
            }

        });

        $(".edit_delivery_date").datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
               $(".edit_order_date").datepicker("option", "maxDate", selected);
            }

        });

        var counter = 100;
        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols   = "";
            
            cols += '<td><select class="form-control required item-name" onchange="fetchInvoiceItemCode(this.options[this.selectedIndex].value, $(this));" name="details[' + counter + '][item_name]"><option>Select Item Name</option><?php foreach ($item_names as $item_name): ?><option value="<?= $item_name ?>"><?= $item_name ?></option><?php endforeach ?></td>';
            cols += '<td><select class="form-control required item-code" onchange="fetchStockStatus(this.options[this.selectedIndex].value, $(this));" name="details[' + counter + '][item_code]"><option>Select Item Code</option></td>';
            cols += '<td><label><input type="checkbox" class="checkbox" name="details[' + counter + '][stock_status]"/><span class="stock_status">Stock</span></label></td>';
            cols += '<td><textarea cols="30" rows="2" class="form-control" name="details[' + counter + '][description]"></textarea></td>';
            cols += '<td><input type="text" class="form-control row_qty required" name="details[' + counter + '][qty]"/></td>';
            cols += '<td><input type="text" class="form-control row_unit_price required" name="details[' + counter + '][unit_price]"/></td>';
            cols += '<td><input type="text" class="form-control row_total required" readonly="" name="details[' + counter + '][total]"/></td>';
            cols += '<td><input type="button" class="btnDel btn btn-md btn-danger" value="Delete"></td>';

            newRow.append(cols);
            $("#rows").append(newRow);

            counter++;
        });

        $("#rows").on("change", '.row_qty, .row_unit_price', function (event) 
        {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();                
        });

        $('input[name^="delivery_charge"], input[name^="discount"]').on("change", function (event) 
        {
            calculateRow($(this).closest("tr"));
            calculateGrandTotal();                
        });

        $("#rows").on("click", '.btnDel', function (event) 
        {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });

        $('select[name^="status"]').on("change", function (event) 
        {
            if($(this).val() == '-1')
            {
                $('textarea[name^="reason"]').parents('.form-group').show();
            }
            else
            {
                $('textarea[name^="reason"]').parents('.form-group').hide();
            }

        });

        <?php if($edit_data): ?>
            $('select[name^="status"]').trigger('change');
        <?php endif ?>
    });

    function fetchStockStatus(item_code, item_code_td) 
    {
        var url = "<?= base_url('admin/invoice/fetch/stock/status') ?>";

        $.post(url, { item_code: item_code }, function(result) 
        {
            var data = JSON.parse(result);

            if (data == null) 
            {
                item_code_td.closest('td').next('td').find('.stock_status').css("color", "red");
            }
            else
            {
                item_code_td.closest('td').next('td').find('.stock_status').css("color", "green");
            }

        });

    }

    function fetchInvoiceItemCode(item_name, item_code_td) 
    {
        var url = "<?= base_url('sales/fetch/invoice/item/code') ?>";

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

        var delivery_charge = parseInt($('input[name^="delivery_charge"]').val());
        delivery_charge = isNaN(delivery_charge) ? 0 : delivery_charge;

        var discount = parseInt($('input[name^="discount"]').val());
        discount = isNaN(discount) ? 0 : discount;

        var netTotal = (totalAmount + delivery_charge) - discount;

        $('input[name^="total_qty"]').val(totalQty);
        $('input[name^="total_amount"]').val(totalAmount.toFixed(2));
        $('input[name^="net_total"]').val(netTotal.toFixed(2));
    }

</script>
