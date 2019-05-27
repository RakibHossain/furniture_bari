<?php
    
    $parent_po_ids = '';
    $child_po_ids = '';
    $cost_item_information = '';
    $item_costs = '';
    $item_activities = '';
    $parent_cost = '';
    $material_cost = '';
    $operation_cost = '';

    if(isset($edit_cost))
    {
        if(!empty($edit_cost['parent_cost']) && !empty($edit_cost['material_cost']) && !empty($edit_cost['operation_cost']))
        {
            $parent_cost = $edit_cost['parent_cost'];
            $material_cost = $edit_cost['material_cost'];
            $operation_cost = $edit_cost['operation_cost'];
        }
        else
        {
            redirect('production/create/cost', 'refresh');
        }

    }

    if(isset($item_cost))
    {
        $cost_item_information = $item_cost['information'];
        $item_costs = $item_cost['cost'];
        $item_activities = $item_cost['activity'];

    }

    if(isset($po_ids))
    {
        $parent_po_ids = $po_ids['parent'];
        $child_po_ids = $po_ids['child'];

    }

?>

<h4>Production Cost</h4>

<?php if ($type == 'new_item'): ?>

    <form class="form-horizontal" action="<?= base_url("production/fetch/create/cost") ?>" method="POST">

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-2">

                <div class="form-group">

                    <label for="po_id">PO ID:</label>
                    <select class="form-control required" name="po_id">

                        <option>Select A PO</option>
                        <?php if (empty($child_po_ids)): ?>

                            <?php foreach ($parent_po_ids as $parent_po_id): ?>
                                <option value="<?= $parent_po_id->po_id ?>"><?= $parent_po_id->po_id ?></option>
                            <?php endforeach ?>

                        <?php else: ?>

                            <?php foreach ($parent_po_ids as $parent_po_id): ?>
                                <?php foreach ($child_po_ids as $child_po_id): ?>
                                    <?php if ($parent_po_id != $child_po_id): ?>
                                        <option value="<?= $parent_po_id->po_id ?>"><?= $parent_po_id->po_id ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            
                        <?php endif ?>

                    </select>

                </div>

            </div>

            <div class="col-sm-2" style="margin-top: 25px;">
                
                <button type="submit" class="btn btn-primary">Ok</button>

            </div>

        </div>

    </form>

    <br>

<?php else: ?>

    <form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("production/insert/cost") : base_url("production/update/cost/$edit_cost_id") ?>" method="POST">

        <div class="row">

            <div class="col-sm-2">
                
                <label for="invoice_no">Invoice:</label>
                <input type="text" name="invoice_no" readonly="" class="form-control" value="<?= !empty($parent_cost) ? $parent_cost->invoice_no : $cost_item_information->invoice_no ?>" />

            </div>

            <div class="col-sm-2">
                
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" readonly="" class="form-control" value="<?= !empty($parent_cost) ? $parent_cost->item_name : $cost_item_information->item_name ?>" />

            </div>

            <div class="col-sm-2">
                
                <label for="item_code">Item Code:</label>
                <input type="text" name="item_code" readonly="" class="form-control" value="<?= !empty($parent_cost) ? $parent_cost->item_code : $cost_item_information->item_code ?>" />

            </div>

            <div class="col-sm-2">
                
                <input type="hidden" name="po_id" readonly="" class="form-control" value="<?= !empty($parent_cost) ? $parent_cost->po_id : $cost_item_po_id['po_id'] ?>" />

            </div>

        </div>

        <br>

        <h4>Material Cost</h4>

        <table id="materialTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Purchase Item</th>
                    <th class="col-sm-2">Purchase Item Code</th>
                    <th class="col-sm-2">Qty</th>
                    <th class="col-sm-2">Unit Price</th>
                    <th class="col-sm-2">Amount</th>
                </tr>

            </thead>

            <tbody id="materialRows">

                <?php if(!empty($material_cost)): ?>

                    <?php foreach ($material_cost as $key => $value): ?>

                        <tr>

                            <td>
                                <select class="form-control required" name="material_details[<?= $key ?>][purchase_item]">

                                    <?php foreach ($purchase_item_names as $purchase_item_name): ?>

                                        <option <?= ($purchase_item_name->item_name == $value->purchase_item) ? 'selected=""' : '' ?> value="<?= $purchase_item_name->item_name ?>"><?= $purchase_item_name->item_name ?></option>

                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <select class="form-control required" name="material_details[<?= $key ?>][purchase_item_code]">

                                    <?php foreach ($purchase_items as $purchase_item): ?>

                                        <option <?= ($purchase_item->item_code == $value->purchase_item_code) ? 'selected=""' : '' ?> value="<?= $purchase_item->item_code ?>"><?= $purchase_item->item_code ?></option>

                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control row_qty required" name="material_details[<?= $key ?>][qty]" value="<?= $value->qty ?>"/>
                                <input type="hidden" class="form-control row_qty" name="material_details[<?= $key ?>][hidden_qty]" value="<?= $value->qty ?>"/>
                            </td>
                            <td>
                                <input type="text" class="form-control row_unit_price required" name="material_details[<?= $key ?>][unit_price]" value="<?= $value->unit_price ?>"/>
                            </td>
                            <td class="col-sm-2">
                                <input type="text" readonly=""  class="form-control row_total required" name="material_details[<?= $key ?>][total]" value="<?= $value->total ?>"/>
                                <input type="hidden" readonly=""  class="form-control row_total" name="material_details[<?= $key ?>][hidden_total]" value="<?= $value->total ?>"/>
                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else: ?>

                    <?php foreach ($item_costs as $key => $item_cost): ?>

                        <tr>

                            <td>
                                <select class="form-control required" name="material_details[<?= $key ?>][purchase_item]">

                                    <?php foreach ($purchase_item_names as $purchase_item_name): ?>

                                        <option <?= ($purchase_item_name->item_name == $item_cost->item_name) ? 'selected=""' : '' ?> value="<?= $purchase_item_name->item_name ?>"><?= $purchase_item_name->item_name ?></option>

                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <select class="form-control required" name="material_details[<?= $key ?>][purchase_item_code]">

                                    <?php foreach ($purchase_items as $purchase_item): ?>

                                        <option <?= ($purchase_item->item_code == $item_cost->item_code) ? 'selected=""' : '' ?> value="<?= $purchase_item->item_code ?>"><?= $purchase_item->item_code ?></option>

                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <input type="text" name="material_details[<?= $key ?>][qty]"  class="form-control row_qty required" value="<?= $item_cost->qty ?>" />
                            </td>
                            <td>
                                <input type="text" name="material_details[<?= $key ?>][unit_price]"  class="form-control row_unit_price required" value="<?= $item_cost->unit_price ?>" />
                            </td>
                            <td class="col-sm-2">
                                <input type="text" name="material_details[<?= $key ?>][total]" readonly=""  class="form-control row_total required" value="<?= $item_cost->total ?>" />
                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php endif ?>

            </tbody>

            <tbody>

                <tr>
                    <td></td>
                    <td style="text-align: right;">Total Qty</td>
                    <td>
                        <input type="text" readonly name="total_material_qty"  class="form-control" value="<?= (!empty($parent)) ? $parent->total_qty : "" ?>" />
                    </td>
                    <td style="text-align: right;">Total Amount</td>
                    <td class="col-sm-2">
                        <input type="text" name="total_material_amount" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr>
                    <td colspan="5"></td>
                    <td style="text-align: right;">
                        <input type="button" class="btn btn-danger btn-block" id="materialAddrow" value="Add Row" />
                    </td>
                    <td></td>
                </tr>

            </tfoot>

        </table>

        <h4>Operational Cost</h4>

        <table id="operationalTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Activity</th>
                    <th class="col-sm-2">Amount</th>
                </tr>

            </thead>

            <tbody id="operationalRows">

                <?php if(!empty($operation_cost)): ?>

                    <?php foreach ($operation_cost as $key => $value): ?>

                        <tr>

                            <td>
                                <select class="form-control required" name="operation_details[<?= $key ?>][activity]">

                                    <?php foreach ($activities as $activity): ?>

                                        <option <?= ($activity->activity == $value->activity) ? 'selected=""' : '' ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <input type="text"  class="form-control row_total required" name="operation_details[<?= $key ?>][total]" value="<?= $value->total ?>"/>
                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else: ?>

                    <?php foreach ($item_activities as $key => $item_activity): ?>

                        <tr>

                            <td>
                                <select class="form-control required" name="operation_details[<?= $key ?>][activity]">

                                    <?php foreach ($activities as $activity): ?>

                                        <option <?= ($activity->activity == $item_activity->activity) ? 'selected=""' : '' ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <input type="text" name="operation_details[<?= $key ?>][total]" class="form-control row_total required" value="<?= $item_activity->amount ?>" />
                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php endif ?>

            </tbody>

            <tbody>

                <tr>

                    <td style="text-align: right;">Total Amount</td>
                    <td class="col-sm-2">
                        <input type="text" name="total_operational_amount" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr>

                    <td colspan="6"></td>
                    <td class="col-sm-2">
                        <input type="button" class="btn btn-danger btn-block" id="operationalAddrow" value="Add Row" />
                    </td>

                </tr>

                <tr>

                    <td>Net Total Amount</td>
                    <td class="col-sm-2">
                        <input type="text" name="total_amount" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
                    </td>

                </tr>

                <tr>

                    <td class="col-sm-2">
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

        $(".formRoot").validate();

        calculateGrandTotal();

        var counter = 100;

        // material rows
        $("#materialAddrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="material_details[' + counter + '][purchase_item]"><option>Select Item</option><?php foreach ($purchase_item_names as $purchase_item_name): ?><option value="<?= $purchase_item_name->item_name ?>"><?= $purchase_item_name->item_name ?></option><?php endforeach ?></td>';
            cols += '<td><select class="form-control required" name="material_details[' + counter + '][purchase_item_code]"><option>Select Item Code</option><?php foreach ($purchase_items as $purchase_item): ?><option value="<?= $purchase_item->item_code ?>"><?= $purchase_item->item_code ?></option><?php endforeach ?></td>';
            cols += '<td><input type="text" class="form-control row_qty required" name="material_details[' + counter + '][qty]"/></td>';
            cols += '<td><input type="text" class="form-control row_unit_price required" name="material_details[' + counter + '][unit_price]"/></td>';
            cols += '<td><input type="text" class="form-control row_total required" readonly="" name="material_details[' + counter + '][total]"/></td>';
            cols += '<td><input type="button" class="btn btn-danger btn-del" value="Delete"></td>';

            newRow.append(cols);
            
            $("#materialRows").append(newRow);

            counter++;

        });

        $("#materialRows").on("change", '.row_qty, .row_unit_price', function (event) 
        {
            calculateMaterialRow($(this).closest("tr"));
            calculateGrandTotal();            
        });

        $("#materialRows").on("click", '.btn-del', function (event) 
        {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });
        //end of material rows

        // operational rows
        $("#operationalAddrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="operation_details[' + counter + '][activity]"><option>Select An Activity</option><?php foreach ($activities as $activity): ?><option value="<?= $activity->activity ?>"><?= $activity->activity ?></option><?php endforeach ?></td>';
            cols += '<td><input type="text" class="form-control row_total required" name="operation_details[' + counter + '][total]"/></td>';
            cols += '<td><input type="button" class="btn btn-danger btn-del" value="Delete"></td>';

            newRow.append(cols);
            
            $("#operationalRows").append(newRow);

            counter++;

        });

        $("#operationalRows").on("change", '.row_qty, .row_unit_price', function (event) 
        {
            calculateOperationRow($(this).closest("tr"));
            calculateGrandTotal();
        });

        $("#operationalRows").on("click", '.btn-del', function (event) 
        {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });
        //end of operational rows

    });

    function calculateMaterialRow(row) 
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

    function calculateOperationRow(row) 
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
        var totalMaterialAmount = 0;
        var totalMaterialQty = 0;
        var totalOperationalAmount = 0;
        var totalOperationalQty = 0;
        var totalAmount = 0;
        var totalQty = 0;

        $("#materialRows").find('tr').each(function () 
        {
            totalMaterialAmount += parseFloat($(this).find('.row_total').val());
            totalMaterialQty += parseInt($(this).find('.row_qty').val());
        });

        totalMaterialQty = isNaN(totalMaterialQty) ? 0 : totalMaterialQty;
        totalMaterialAmount = isNaN(totalMaterialAmount) ? 0 : totalMaterialAmount;

        $('input[name^="total_material_qty"]').val(totalMaterialQty);
        $('input[name^="total_material_amount"]').val(totalMaterialAmount.toFixed(2));

        $("#operationalRows").find('tr').each(function () 
        {
            totalOperationalAmount += parseFloat($(this).find('.row_total').val());
            totalOperationalQty += parseInt($(this).find('.row_qty').val());
        });

        totalOperationalQty = isNaN(totalOperationalQty) ? 0 : totalOperationalQty;
        totalOperationalAmount = isNaN(totalOperationalAmount) ? 0 : totalOperationalAmount;

        $('input[name^="total_operational_qty"]').val(totalOperationalQty);
        $('input[name^="total_operational_amount"]').val(totalOperationalAmount.toFixed(2));

        totalQty = totalMaterialQty + totalOperationalQty;
        totalAmount = totalMaterialAmount + totalOperationalAmount;

        $('input[name^="total_qty"]').val(totalQty);
        $('input[name^="total_amount"]').val(totalAmount.toFixed(2));

    }

</script>
