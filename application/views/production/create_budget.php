<?php
    
    $parent_po_ids = '';
    $child_po_ids = '';
    $parent_budget = '';
    $material_budget = '';
    $operation_budget = '';

    if(isset($edit_budget))
    {
        if(!empty($edit_budget['parent_budget']) && !empty($edit_budget['material_budget']) && !empty($edit_budget['operation_budget']))
        {
            $parent_budget = $edit_budget['parent_budget'];
            $material_budget = $edit_budget['material_budget'];
            $operation_budget = $edit_budget['operation_budget'];
        }
        else
        {
            redirect('production/create/budget', 'refresh');
        }

    }

    if(isset($po_ids))
    {
        $parent_po_ids = $po_ids['parent'];
        $child_po_ids = $po_ids['child'];
    }

?>

<h4>Production Budget</h4>

<?php if ($type == 'new_item'): ?>

    <form class="form-horizontal" action="<?= base_url("production/fetch/create/budget") ?>" method="POST">

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-2">

                <div class="form-group">

                    <label for="po_id">PO ID:</label>
                    <select class="form-control required" name="po_id">

                        <option value="">Select A PO</option>
                        <?php foreach ($parent_po_ids as $parent_po_id): ?>
                            <option value="<?= $parent_po_id->po_id ?>"><?= $parent_po_id->po_id ?></option>
                        <?php endforeach ?>

                        <!-- <?php if (empty($child_po_ids)): ?>

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

                        <?php endif ?> -->

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

    <form class="form-horizontal formRoot" action="<?= ($type == 'new') ? base_url("production/insert/budget") : base_url("production/update/budget/$edit_budget_id") ?>" method="POST">

        <div class="row">

            <div class="col-sm-2">
                
                <label for="date">Date:</label>
                <input type="text" name="date" class="form-control date" />

            </div>

            <?php if (($type == 'new') && (empty($budget_item_po_id['po_id']))): ?>

                <div class="col-sm-2">
                    
                    <label for="invoice_no">Invoice:</label>
                    <input type="text" name="invoice_no" readonly="" class="form-control" id="invoice_no" value="" />

                </div>

                <div class="col-sm-2">
                    
                    <label for="item_name">Item Name:</label>
                    <select class="form-control required" name="item_name" id="item_name">
                        <?php foreach ($items as $item): ?>
                            <option value="<?= $item->item_name ?>"><?= $item->item_name ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

                <div class="col-sm-2">
                    
                    <label for="item_code">Item Code:</label>
                    <select class="form-control required" name="item_code" id="item_code">
                        <?php foreach ($items as $item): ?>
                            <option value="<?= $item->item_code ?>"><?= $item->item_code ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

            <?php else: ?>

                <div class="col-sm-2">
                    
                    <label for="invoice_no">Invoice:</label>
                    <input type="text" name="invoice_no" readonly="" class="form-control" id="invoice_no" value="<?= !empty($parent_budget) ? $parent_budget->invoice_no : $budget_info->invoice_no ?>" />

                </div>

                <div class="col-sm-2">
                    
                    <label for="item_name">Item Name:</label>
                    <input type="text" name="item_name" readonly="" class="form-control" id="item_name" value="<?= !empty($parent_budget) ? $parent_budget->item_name : $budget_info->item_name ?>" />

                </div>

                <div class="col-sm-2">
                    
                    <label for="item_code">Item Code:</label>
                    <input type="text" name="item_code" readonly="" class="form-control" id="item_code" value="<?= !empty($parent_budget) ? $parent_budget->item_code : $budget_info->item_code ?>" />

                </div>

            <?php endif ?>

            <div class="col-sm-2">
                    
                <label for="existing_item_code">Existing Item:</label>
                <select class="form-control" id="existing_item_code" onchange="getExistingItemBudget(this.options[this.selectedIndex].value, $(this));">
                    <option value="">Select An Item</option>
                    <?php foreach ($production_budget_items as $production_budget_item): ?>
                        <option value="<?= $production_budget_item->item_code ?>"><?= $production_budget_item->item_code ?></option>
                    <?php endforeach ?>
                </select>

            </div>

            <div class="col-sm-2">
                <input type="hidden" name="po_id" readonly="" class="form-control" value="<?= !empty($parent_budget) ? $parent_budget->po_id : $budget_item_po_id['po_id'] ?>" />
            </div>

        </div>

        <br>

        <h4>Material Budget</h4>

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

                <?php if(!empty($material_budget)): ?>

                    <?php foreach ($material_budget as $key => $value): ?>

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
                            </td>
                            <td>
                                <input type="text" class="form-control row_unit_price required" name="material_details[<?= $key ?>][unit_price]" value="<?= $value->unit_price ?>"/>
                            </td>
                            <td class="col-sm-2">
                                <input type="text" readonly=""  class="form-control row_total required" name="material_details[<?= $key ?>][total]" value="<?= $value->total ?>"/>
                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else: ?>

                    <tr>

                        <td>
                            <select class="form-control required" name="material_details[0][purchase_item]">

                                <option>Select An Item</option>
                                <?php foreach ($purchase_item_names as $purchase_item_name): ?>
                                    <option value="<?= $purchase_item_name->item_name ?>"><?= $purchase_item_name->item_name ?></option>
                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <select class="form-control required" name="material_details[0][purchase_item_code]">

                                <option>Select An Item Code</option>
                                <?php foreach ($purchase_items as $purchase_item): ?>
                                    <option value="<?= $purchase_item->item_code ?>"><?= $purchase_item->item_code ?></option>
                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <input type="text" name="material_details[0][qty]"  class="form-control row_qty required" />
                        </td>
                        <td>
                            <input type="text" name="material_details[0][unit_price]"  class="form-control row_unit_price required" />
                        </td>
                        <td class="col-sm-2">
                            <input type="text" name="material_details[0][total]" readonly=""  class="form-control row_total required" />
                        </td>

                    </tr>

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

        <h4>Operational Budget</h4>

        <table id="operationalTable" class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Activity</th>
                    <th class="col-sm-2">Qty</th>
                    <th class="col-sm-2">Unit Price</th>
                    <th class="col-sm-2">Amount</th>
                </tr>

            </thead>

            <tbody id="operationalRows">

                <?php if(!empty($operation_budget)): ?>

                    <?php foreach ($operation_budget as $key => $value): ?>

                        <tr>

                            <td>
                                <select class="form-control required" name="operation_details[<?= $key ?>][activity]">

                                    <?php foreach ($activities as $activity): ?>
                                        <option <?= ($activity->activity == $value->activity) ? 'selected=""' : '' ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>
                                    <?php endforeach ?>

                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control row_qty required" name="operation_details[<?= $key ?>][qty]" value="<?= $value->qty ?>"/>
                            </td>
                            <td>
                                <input type="text" class="form-control row_unit_price required" name="operation_details[<?= $key ?>][unit_price]" value="<?= $value->unit_price ?>"/>
                            </td>
                            <td class="col-sm-2">
                                <input type="text" readonly=""  class="form-control row_total required" name="operation_details[<?= $key ?>][total]" value="<?= $value->total ?>"/>
                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else: ?>

                    <tr>

                        <td>
                            <select class="form-control required" name="operation_details[0][activity]">

                                <option>Select An Activity</option>
                                <?php foreach ($activities as $activity): ?>
                                    <option value="<?= $activity->activity ?>"><?= $activity->activity ?></option>
                                <?php endforeach ?>

                            </select>
                        </td>
                        <td>
                            <input type="text" name="operation_details[0][qty]"  class="form-control row_qty required" />
                        </td>
                        <td>
                            <input type="text" name="operation_details[0][unit_price]"  class="form-control row_unit_price required" />
                        </td>
                        <td class="col-sm-2">
                            <input type="text" name="operation_details[0][total]" readonly=""  class="form-control row_total required" />
                        </td>

                    </tr>

                <?php endif ?>

            </tbody>

            <tbody>

                <tr>

                    <td style="text-align: right;">Total Qty</td>
                    <td>
                        <input type="text" readonly name="total_operational_qty"  class="form-control" value="<?= (!empty($parent)) ? $parent->total_qty : "" ?>" />
                    </td>
                    <td style="text-align: right;">Total Amount</td>
                    <td class="col-sm-2">
                        <input type="text" name="total_operational_amount" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
                    </td>

                </tr>

            </tbody>

            <tfoot>

                <tr>
                    <td colspan="5"></td>
                    <td style="text-align: right;">
                        <input type="button" class="btn btn-danger btn-block" id="operationalAddrow" value="Add Row" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right;">Net Total Qty</td>
                    <td>
                        <input type="text" readonly name="total_qty"  class="form-control" value="<?= (!empty($parent)) ? $parent->total_qty : "" ?>" />
                    </td>
                    <td style="text-align: right;">Net Total Amount</td>
                    <td class="col-sm-2">
                        <input type="text" name="total_amount" readonly  class="form-control" value="<?= (!empty($parent)) ? $parent->total_amount : "" ?>" />
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
        $(".formRoot").validate();
        $(".date").datepicker().datepicker("setDate", new Date());

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
        }); // end of material rows

        // operational rows
        $("#operationalAddrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="operation_details[' + counter + '][activity]"><option>Select An Activity</option><?php foreach ($activities as $activity): ?><option value="<?= $activity->activity ?>"><?= $activity->activity ?></option><?php endforeach ?></td>';
            cols += '<td><input type="text" class="form-control row_qty required" name="operation_details[' + counter + '][qty]"/></td>';
            cols += '<td><input type="text" class="form-control row_unit_price required" name="operation_details[' + counter + '][unit_price]"/></td>';
            cols += '<td><input type="text" class="form-control row_total required" readonly="" name="operation_details[' + counter + '][total]"/></td>';
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
        }); // end of operational rows

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

    function getExistingItemBudget(item_code, item_code_td) 
    {
        var url = "<?= base_url('production/get/existing/item/budget') ?>";
        
        $.post(url, { item_code: item_code }, function(result) 
        {
            // console.log(result);

            var result            = JSON.parse(result);
            var productionBudget = result.production_budget;
            var materialBudget    = result.material_budget;
            var operationalBudget = result.operational_budget;

            var mcols = "";
            var pcols = "";

            $('input[name^="total_material_qty"]').val(productionBudget[0].total_material_qty);
            $('input[name^="total_material_amount"]').val(productionBudget[0].total_material_amount);
            $('input[name^="total_operational_qty"]').val(productionBudget[0].total_operational_qty);
            $('input[name^="total_operational_amount"]').val(productionBudget[0].total_operational_amount);
            $('input[name^="total_qty"]').val(productionBudget[0].total_qty);
            $('input[name^="total_amount"]').val(productionBudget[0].total_amount);

            $.each(materialBudget, function (i, item) 
            {
                mcols += '<tr><td><input type="text" class="form-control" readonly="" name="material_details[' + i + '][purchase_item]" value="' + item.purchase_item + '" /></td>';
                mcols += '<td><input type="text" class="form-control" readonly="" name="material_details[' + i + '][purchase_item_code]" value="' + item.purchase_item_code + '" /></td>';
                mcols += '<td><input type="text" class="form-control row_qty required" name="material_details[' + i + '][qty]" value="' + item.qty + '" /></td>';
                mcols += '<td><input type="text" class="form-control row_unit_price required" name="material_details[' + i + '][unit_price]" value="' + item.unit_price + '" /></td>';
                mcols += '<td><input type="text" class="form-control row_total required" name="material_details[' + i + '][total]" value="' + item.total + '" /></td></tr>';
            });

            $.each(operationalBudget, function (i, item) 
            {
                pcols += '<tr><td><input type="text" class="form-control" readonly="" name="operation_details[' + i + '][activity]" value="' + item.activity + '" /></td>';
                pcols += '<td><input type="text" class="form-control row_qty required" name="operation_details[' + i + '][qty]" value="' + item.qty + '" /></td>';
                pcols += '<td><input type="text" class="form-control row_unit_price required" name="operation_details[' + i + '][unit_price]" value="' + item.unit_price + '" /></td>';
                pcols += '<td><input type="text" class="form-control row_total required" name="operation_details[' + i + '][total]" value="' + item.total + '" /></td></tr>';
            });

            $("#materialRows").html(mcols);
            $("#operationalRows").html(pcols);
        });

    }

</script>
