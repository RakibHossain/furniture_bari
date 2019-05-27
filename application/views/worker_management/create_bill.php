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
            redirect('worker/create/bill', 'refresh');
        }

    }

?>

<h4><?= ucfirst($type) ?> Bill</h4>

<form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("worker/insert/bill") : base_url("worker/update/bill/$edit_bill_id") ?>" method="POST">

    <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />
    
    <div class="row" style="margin-left: 10px;">

        <div class="col-sm-3">

            <div class="form-group">

                <label for="date">Date:</label>

                <?php if ($type == 'new'): ?>

                    <input type="text" name="date" class="form-control date required" />

                <?php else: ?>

                    <input type="text" name="date" class="form-control edit-date required" value="<?= (!empty($parent)) ? date("m/d/Y", strtotime($parent->date)): "" ?>" />

                <?php endif ?>

            </div>

        </div>

        <div class="col-sm-3 col-sm-offset-1">

            <div class="form-group">

                <label for="invoice">Worker Name:</label>
                <select class="form-control" name="worker" id="worker-name">

                    <?php if ($type == 'new'): ?>

                        <option>Select A Worker</option>
                        <?php foreach ($workers as $worker): ?>

                            <option value="<?= $worker->name ?>"><?= $worker->name ?></option>

                        <?php endforeach ?>

                    <?php else: ?>

                        <option>Select A Worker</option>
                        <?php foreach ($workers as $worker): ?>

                            <option <?= ($worker->name == $parent->worker) ? 'selected=""' : '' ?> value="<?= $worker->name ?>"><?= $worker->name ?></option>

                        <?php endforeach ?>

                    <?php endif ?>

                </select>

                <?php if ($type == 'edit'): ?>
                   <input type="hidden" name="previous_worker" readonly="" class="form-control" value="<?= $parent->worker ?>" /> 
                <?php endif ?>

            </div>

        </div>

        <div class="col-sm-3 col-sm-offset-1">

            <div class="form-group">

                <label for="remark">Balance:</label>
                <input type="text" id="worker-balance" readonly="" class="form-control" />

            </div>

        </div>
        
    </div>

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">PO ID</th>
                <th class="col-sm-2">Item Code</th>
                <th class="col-sm-2">Activity</th>
                <th class="col-sm-2">Description</th>
                <th class="col-sm-2">Amount</th>
            </tr>

        </thead>

        <tbody id="rows">

            <?php if(!empty($child)): ?>

                <?php foreach ($child as $key => $value): ?>

                    <tr>
                    
                        <td>
                            <select class="form-control poId" onchange="fetchItemCode(this.options[this.selectedIndex].value, $(this));" name="details[<?= $key ?>][po_id]">

                                <option>Select A PO</option>
                                <?php foreach ($production_processes as $production_process): ?>

                                    <option <?= ($production_process->po_id == $value->po_id) ? 'selected=""' : '' ?> value="<?= $production_process->po_id ?>"><?= $production_process->po_id ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <!-- <select class="form-control item_code" name="details[<?= $key ?>][item_code]">

                                <option>Select Item Code</option>
                                <?php foreach ($production_processes as $production_process): ?>

                                    <option <?= ($production_process->item_code == $value->item_code) ? 'selected=""' : '' ?> value="<?= $production_process->item_code ?>"><?= $production_process->item_code ?></option>

                                <?php endforeach ?>

                            </select> -->
                            <select class="form-control" name="details[<?= $key ?>][item_code]">

                                <option>Select Item Code</option>
                                <?php foreach ($item_codes as $item_code): ?>

                                    <option <?= ($item_code->item_code == $value->item_code) ? 'selected=""' : '' ?> value="<?= $item_code->item_code ?>"><?= $item_code->item_code ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="details[<?= $key ?>][activity]">

                                <option>Select Activity</option>
                                <?php foreach ($activities as $activity): ?>

                                    <option <?= ($activity->activity == $value->activity) ? 'selected=""' : '' ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <textarea cols="30" rows="2" name="details[<?= $key ?>][description]" class="form-control"><?= $value->description ?></textarea>
                        </td>
                        <td class="col-sm-2">
                            <input type="text" name="details[<?= $key ?>][amount]" class="form-control row_total required" value="<?= $value->amount ?>" />
                        </td>

                    </tr>

                <?php endforeach ?>

            <?php else: ?>

                <tr>

                    <td>
                        <select class="form-control required poId" onchange="fetchItemCode(this.options[this.selectedIndex].value, $(this));" name="details[0][po_id]">

                            <option>Select A PO</option>

                        </select>
                    </td>
                    <td>
                        <!-- <select class="form-control required item_code" name="details[0][item_code]">

                            <option>Select Item Code</option>

                        </select> -->
                        <select class="form-control required" name="details[0][item_code]">

                            <option>Select Item Code</option>
                            <?php foreach ($item_codes as $item_code): ?>

                                <option value="<?= $item_code->item_code ?>"><?= $item_code->item_code ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <select class="form-control required" name="details[0][activity]">

                            <option>Select Activity</option>
                            <?php foreach ($activities as $activity): ?>

                                <option value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                            <?php endforeach ?>

                        </select>
                    </td>
                    <td>
                        <textarea cols="30" rows="2" name="details[0][description]" class="form-control"></textarea>
                    </td>
                    <td class="col-sm-2">
                        <input type="text" name="details[0][amount]" class="form-control row_total required"/>
                    </td>

                </tr>

            <?php endif ?>

        </tbody>

        <tbody>

            <tr>
                
                <td colspan="4" style="text-align:right;">Total Amount</td>
                <td class="col-sm-2">
                    <input type="hidden" readonly="" class="form-control" name="total_qty" value="<?= (!empty($parent)) ? $parent->total_qty : "" ?>" />
                    <input type="text" readonly="" class="form-control" name="total_amount" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
                    <input type="hidden" readonly="" class="form-control" name="previous_total_amount" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
                </td>

            </tr>

        </tbody>

        <tfoot>

            <tr>
                <td colspan="4"></td>
                <td style="text-align: right;">
                    <input type="button" class="btn btn-danger btn-block" id="addrow" value="Add Row" />
                </td>
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

        $("#worker-name").on("change", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var worker_name = $(this).val();
            var url = "<?= base_url('worker/pay/bill/balance') ?>";

            $.post(url, { worker_name: worker_name }, function(result) 
            {
                var data = JSON.parse(result);

                if (data.amount != '') 
                {
                    $("#worker-balance").val(data.balance);
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

        $("#addrow").on("click", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var worker_name = $("#worker-name").val();
            var url = "<?= base_url('worker/pay/bill/poid') ?>";

            $.post(url, { worker_name: worker_name }, function(result) 
            {
                $(".addrow-poId").html(result);
                
            });

        });

        var counter = 100;

        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required addrow-poId" onchange="fetchItemCode(this.options[this.selectedIndex].value, $(this));" name="details[' + counter + '][po_id]"><option>Select A PO</option></select></td>';
            //cols += '<td><select class="form-control required item_code" name="details[' + counter + '][item_code]"><option>Select Item Code</option></select></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][item_code]"><option>Select Item Code</option><?php foreach ($item_codes as $item_code): ?><option value="<?= $item_code->item_code ?>"><?= $item_code->item_code ?></option><?php endforeach ?></select></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][activity]"><option>Select Activity</option><?php foreach ($activities as $activity): ?><option value="<?= $activity->activity ?>"><?= $activity->activity ?></option><?php endforeach ?></select></td>';
            cols += '<td><textarea cols="30" rows="2" name="details[' + counter + '][description]" class="form-control"></textarea></td>';
            cols += '<td><input type="text" class="form-control row_total required" name="details[' + counter + '][amount]"/></td>';
            cols += '<td><input type="button" class="btn-del btn btn-md btn-danger" value="Delete"></td></tr>';

            newRow.append(cols);
            
            $("#rows").append(newRow);

            counter++;
        });

        $("#rows").on("change", '.row_total', function (event) 
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

    function fetchItemCode(po_id, item_code_td) 
    {
        var url = "<?= base_url('fetch/worker/bill/item/code') ?>";

        $.post(url, { po_id: po_id }, function(result) 
        {
            item_code_td.closest('td').next('td').find('.item_code').html(result);

        });

    }

    function calculateRow(row) 
    {
        var totalAmount = +row.find('.row_total').val();

        if(isNaN(totalAmount))
        {
            totalAmount = 0;
        }

        row.find('.row_total').val(totalAmount.toFixed(2));
    }

    function calculateGrandTotal() 
    {
        var totalQty = 0;
        var totalAmount = 0;

        $("#rows").find('tr').each(function () 
        {
            totalQty++;
            totalAmount += parseFloat($(this).find('.row_total').val());
        });

        totalQty = isNaN(totalQty) ? 0 : totalQty;
        totalAmount = isNaN(totalAmount) ? 0 : totalAmount;

        $('input[name^="total_qty"]').val(totalQty);
        $('input[name^="total_amount"]').val(totalAmount.toFixed(2));
    }

</script>
