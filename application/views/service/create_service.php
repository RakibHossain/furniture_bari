<?php

    $edit_data = '';

    if(isset($data))
    {
        if(!empty($data['parent']))
        {
            $edit_data = $data;
            $id = $edit_data['parent']->id;
        }
        else
        {
            redirect('service/create', 'refresh');
        }

    }

?>

<?php if($edit_data): ?>

    <?php if ($this->session->flashdata('success_status')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success_status') ?></div>
    <?php elseif ($this->session->flashdata('error_status')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error_status') ?></div>
    <?php endif ?>

<?php endif ?>

<form class="form-horizontal" id="formRoot" action="<?= ($type == 'new') ? base_url("service/insert") : base_url("service/update/$id") ?>" method="POST">

    <input type="hidden" name="user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

    <div class="col-sm-12">
        
        <h4>Basic Information</h4>

        <div class="col-sm-6">  
            
            <div class="form-group">
                <label class="control-label col-xs-4">Invoice No</label>
                <div class="col-xs-8">
                    <select class="form-control" onchange="getInvoiceInfo(this.options[this.selectedIndex].value, $(this));" name="invoice_id">

                        <?php if (!empty($edit_data)): ?>
                            <option <?= ($edit_data['parent']->ji_invoice_id == 0) ? 'selected' : '' ?> value="0">Select An Invoice</option>
                            <?php foreach ($invoices as $invoice): ?>
                                <option <?= ($invoice->id == $edit_data['parent']->ji_invoice_id) ? 'selected' : '' ?> value="<?= $invoice->id ?>"><?= $invoice->order_no ?></option>
                            <?php endforeach ?>
                        <?php else: ?>
                            <option value="0">Select An Invoice</option>
                            <?php foreach ($invoices as $invoice): ?>
                                <option value="<?= $invoice->id ?>"><?= $invoice->order_no ?></option>
                            <?php endforeach ?>
                        <?php endif ?>

                    </select>
                    <input type="hidden" class="invoice-no" name="invoice_no" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Date</label>
                <div class="col-xs-8">
                    <?php if ($type == 'edit'): ?>
                        <input type="text" class="form-control edit-date required" name="date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data['parent']->date)) : ""; ?>">
                    <?php else: ?>
                        <input type="text" class="form-control date required" name="date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data['parent']->date)) : ""; ?>">
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Next Follow Up Date</label>
                <div class="col-xs-8">
                    <?php if ($type == 'edit'): ?>
                        <input type="text" class="form-control edit-followup-date required" name="followup_date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data['parent']->followup_date)) : ""; ?>">
                    <?php else: ?>
                        <input type="text" class="form-control followup-date required" name="followup_date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data['parent']->followup_date)) : ""; ?>">
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group">

                <label class="control-label col-xs-4">Status</label>

                <div class="col-xs-8">

                    <?php

                        if ($this->session->userdata['logged_in']['role'] == 1 || $this->session->userdata['logged_in']['role'] == 5) 
                        {
                            $status_options = array('0' => 'Out Of Condition', '1' => 'Pending', '2' => 'Processing', '3' => 'Complete', '4' => 'Not Response');
                        } 
                        else 
                        {
                            $status_options = array('0' => 'Out Of Condition', '1' => 'Pending', '2' => 'Processing', '4' => 'Not Response');
                        }

                        $status_attribute = array('class' => 'form-control',);
                        echo form_dropdown('status', $status_options, (!empty($edit_data)) ? $edit_data['parent']->status : "1", $status_attribute);
                    ?>

                </div>

            </div>

        </div>

        <div class="col-sm-6">

            <div class="form-group">
                <label class="control-label col-xs-4">Due</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control service due"  name="due" value="<?= (!empty($edit_data)) ? $edit_data['parent']->due : ""; ?>">       
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Delivery Date</label>
                <div class="col-xs-8">
                    <?php if ($type == 'edit'): ?>
                        <input type="text" class="form-control service edit-delivery-date" name="delivery_date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data['parent']->delivery_date)) : "";?>" />
                    <?php else: ?>
                        <input type="text" class="form-control service delivery-date" name="delivery_date" value="<?= (!empty($edit_data)) ? date("m/d/Y", strtotime($edit_data['parent']->delivery_date)) : "";?>" />
                    <?php endif ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-xs-4">Remarks</label>
                <div class="col-xs-8">
                    <textarea cols="30" rows="3" class="form-control" name="remarks"><?php echo (!empty($edit_data)) ? $edit_data['parent']->remarks : ""; ?></textarea>
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
                    <input type="text" class="form-control service customer-name required" name="customer_name" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->customer_name : ""; ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-4">Mobile No</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control service mobile-no required" name="mobile_no" value="<?php echo (!empty($edit_data)) ? $edit_data['parent']->mobile_no : ""; ?>" placeholder="01xxxxxxxxx,01xxxxxxxxx" />
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            
            <div class="form-group">
                <label class="control-label col-xs-4">Address</label>
                <div class="col-xs-8">
                    <textarea cols="30" rows="4" class="form-control service address" name="address"><?php echo (!empty($edit_data)) ? $edit_data['parent']->address : ""; ?></textarea>
                </div>
            </div>

        </div>

    </div>

    <h4>Product Details</h4>

    <table class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-1"><i class="fa fa-cog"></i></th>
                <th class="col-sm-2">Item Name</th>
                <th class="col-sm-2">Item Code</th>
                <th class="col-sm-3">Problem</th>
            </tr>

        </thead>

        <tbody id="item-rows">

            <?php if(!empty($edit_data)): ?>

                <?php foreach ($edit_data['child'] as $key => $value): ?>

                    <tr>

                        <td>
                            <label><input type="checkbox" class="checkbox" <?= ($value['item_problem_status'] == 1) ? 'checked=""' : '' ?> name="details[<?= $key ?>][item_problem_status]" value="<?= $value['item_problem_status'] ?>" /></label>
                        </td>
                        <td>
                            <input type="text" class="form-control service"  name="details[<?= $key ?>][item_name]" value="<?= $value['item_name'] ?>" />
                        </td>
                        <td>
                            <input type="text" class="form-control service"  name="details[<?= $key ?>][item_code]" value="<?= $value['item_code'] ?>" />
                        </td>
                        <td>
                            <textarea cols="30" rows="2" class="form-control" name="details[<?= $key ?>][problem]"><?= $value['problem'] ?></textarea>
                        </td>

                    </tr>

                <?php endforeach ?>

            <?php endif ?>
        
        </tbody>

    </table>

    <h4>Comments</h4>

    <table class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Date</th>
                <th class="col-sm-3">Comment</th>
            </tr>

        </thead>

        <tbody id="comment-rows">

            <?php if(!empty($edit_data)): ?>

                <?php foreach ($edit_data['comment_details'] as $key => $value): ?>

                    <tr>

                        <td>
                            <input type="text" class="form-control edit-comment-date" name="comment_details[<?= $key ?>][comment_date]" value="<?= date("m/d/Y", strtotime($value['comment_date'])) ?>" />
                        </td>
                        <td>
                            <textarea cols="30" rows="2" class="form-control" name="comment_details[<?= $key ?>][comment]"><?= $value['comment'] ?></textarea>
                        </td>
                        <td class="col-sm-1"><input type="button" class="btnDel btn btn-md btn-danger" value="Delete"></td>

                    </tr>

                <?php endforeach ?>

            <?php else: ?>
                
                <tr>

                    <td>
                        <input type="text" class="form-control comment-date" name="comment_details[0][comment_date]" />
                    </td>
                    <td>
                        <textarea cols="30" rows="2" class="form-control" name="comment_details[0][comment]"></textarea>
                    </td>
                    <td class="col-sm-1"><input type="button" class="btnDel btn btn-md btn-danger" value="Delete"></td>

                </tr>

            <?php endif ?>
        
        </tbody>

        <tfoot>

            <tr>
                <td colspan="6"></td>
                <td class="col-md-2" style="text-align: right;">
                    <input type="button" class="btn btn-block btn-danger" id="addrow" value="Add Row" />
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

<script type="text/javascript">
    
    $(function() 
    {
        $("#formRoot").validate();
        $(".edit-date").datepicker();
        $(".date").datepicker().datepicker("setDate", new Date());
        $(".edit-delivery-date").datepicker();
        $(".delivery-date").datepicker().datepicker("setDate", new Date());
        $(".edit-followup-date").datepicker();
        $(".followup-date").datepicker().datepicker("setDate", new Date());
        $(".edit-comment-date").datepicker();
        $(".comment-date").datepicker().datepicker("setDate", new Date());

        var counter = 100;

        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><input type="text" class="form-control comment-date" name="comment_details[' + counter + '][comment_date]" /></td>';
            cols += '<td><textarea cols="30" rows="2" class="form-control" name="comment_details[' + counter + '][comment]"></textarea></td>';
            cols += '<td><input type="button" class="btnDel btn btn-md btn-danger" value="Delete"></td>';

            newRow.append(cols);
            $("#comment-rows").append(newRow);
            $(".comment-date").datepicker().datepicker("setDate", new Date());

            counter++;
        });

        $("#comment-rows").on("click", '.btnDel', function (event) 
        {
            $(this).closest("tr").remove();
        });

    });

    function getInvoiceInfo(invoice_id, invoice_no_td) 
    {
        var url = "<?= base_url('service/get/invoice/information') ?>";
        
        $.post(url, { invoice_id: invoice_id }, function(result) 
        {
            //console.log(result);

            var result = JSON.parse(result);
            var parent = result.parent;
            var child  = result.child;

            $(".service").prop("readonly", true);
            
            $('.due').val(parent.total_due);
            $('.invoice-no').val(parent.order_no);
            $('.delivery-date').val(parent.delivery_date);
            $('.customer-name').val(parent.customer_name);
            $('.mobile-no').val(parent.mobile_no);
            $('.address').val(parent.address);

            var cols = "";
            $.each(child, function (i, item) 
            {
                cols += '<tr><td><label><input type="checkbox" class="checkbox" name="details[' + i + '][item_problem_status]" /></label></td>';
                cols += '<td><input type="text" class="form-control" readonly="" name="details[' + i + '][item_name]" value="' + item.item_name + '" /></td>';
                cols += '<td><input type="text" class="form-control" readonly="" name="details[' + i + '][item_code]" value="' + item.item_code + '" /></td>';
                cols += '<td><textarea cols="30" rows="2" class="form-control" name="details[' + i + '][problem]"></textarea></td></tr>';
            });

            //console.log(cols);
            $("#item-rows").html(cols);
        });

    }

</script>
