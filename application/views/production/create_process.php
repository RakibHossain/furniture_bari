<?php

    $parent = '';
    $child = '';

    if(isset($edit_process))
    {
        if(!empty($edit_process['parent']) && !empty($edit_process['child']))
        {
            $parent = $edit_process['parent'];
            $child = $edit_process['child'];
        }
        else
        {
            redirect('production/create/process', 'refresh');
        }

    }

?>

<h4>Production Order Process</h4>

<?php if ($type == 'new_item'): ?>

    <form class="form-horizontal" id="formRoot" action="<?= base_url("production/fetch/item/activity/process") ?>" method="POST">

        <div class="row" style="margin-left: 10px;">

            <div class="col-sm-2">

                <div class="form-group">

                    <label for="item_name">Item Name:</label>
                    <select class="form-control required" name="item_name">

                        <?php foreach ($production_items as $production_item): ?>

                            <option value="<?= $production_item->item_name ?>"><?= $production_item->item_name ?></option>

                        <?php endforeach ?>

                    </select>

                </div>

            </div>

            <div class="col-sm-2" style="margin-top: 25px;">
                
                <button type="submit" class="btn btn-primary">Ok</button>

            </div>

        </div>

    </form>

    <br>

<?php elseif ($type == 'edit_production_process'): ?>

    <form class="form-horizontal" id="formRoot" action="<?= ($type == 'new') ? base_url("production/insert/process") : base_url("production/update/process/$edit_process_id") ?>" method="POST">

        <div class="checkbox col-sm-1">

            <label><input <?= ($parent->stock_status == 1) ? 'checked=""' : '' ?> type="checkbox" name="stock_status">Stock</label>
          
        </div>

        <div class="col-sm-2 col-sm-offset-1">
            
            <div class="form-group">

                <label for="process_id">PO ID:</label>
                <select class="form-control required" name="po_id">

                    <?php foreach ($po_ids as $po_id): ?>

                        <option <?= (!empty($parent)) && ($po_id->po_id == $parent->po_id) ? 'selected=""' : '' ?> value="<?= $po_id->po_id ?>"><?= $po_id->po_id ?></option>

                    <?php endforeach ?>

                </select>

            </div>

        </div>

        <div class="col-sm-2 col-sm-offset-1">

            <div class="form-group">

                <label for="item_name">Item Name:</label>
                <input type="text" readonly="" name="item_name" class="form-control" value="<?= (!empty($parent)) ? $parent->item_name : "$item_name" ?>" />

            </div>

        </div>

        <div class="col-sm-2 col-sm-offset-1">

            <div class="form-group">

                <label for="item_name">Item Code:</label>
                <input type="text" readonly="" name="item_code" class="form-control" value="<?= (!empty($parent)) ? $parent->item_code : "$item_code" ?>" />

            </div>

        </div>

        <table id="myTable" class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Activity Name</th>
                    <th class="col-sm-2">Status</th>
                    <th class="col-sm-2 text-center">Action</th>
                </tr>

            </thead>

            <tbody id="rows">

                <?php foreach ($child as $key => $value): ?>

                    <tr>

                        <td>
                            <select class="form-control required" name="details[<?= $key ?>][activity]">

                                <?php foreach ($activities as $activity): ?>

                                    <option <?= ($activity->activity == $value->activity) ? 'selected=""' : '' ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>

                        <td>

                            <select class="form-control required" name="details[<?= $key ?>][status]">

                                <?php if ($value->status == 'Pending'): ?>

                                    <option selected="" value="<?= $value->status ?>"><?= $value->status ?></option>
                                    <option value="Progress">Progress</option>
                                    <option value="Complete">Complete</option>

                                <?php elseif($value->status == 'Progress'): ?>

                                    <option value="Pending">Pending</option>
                                    <option selected="" value="<?= $value->status ?>"><?= $value->status ?></option>
                                    <option value="Complete">Complete</option>

                                <?php else: ?>

                                    <option value="Pending">Pending</option>
                                    <option value="Progress">Progress</option>
                                    <option selected="" value="<?= $value->status ?>"><?= $value->status ?></option>

                                <?php endif ?>

                            </select>

                        </td>

                        <td class="text-center"><input type="button" class="btn btn-del btn-danger" value="Delete"></td>

                    </tr>

                <?php endforeach ?>

            </tbody>

            <tfoot>

                <tr>
                    <td colspan="5"></td>
                    <td style="text-align: right;">
                        <input type="button" class="btn" id="addrow" value="Add New" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>
                    <td colspan="6"></td>
                </tr>

            </tfoot>

        </table>

    </form>

<?php else: ?>

    <form class="form-horizontal" id="formRoot" action="<?= ($type == 'new') ? base_url("production/insert/process") : base_url("production/update/process/$edit_process_id") ?>" method="POST">

        <div class="checkbox col-sm-1">

            <label><input type="checkbox" name="stock_status" id="stock-status" />Stock</label>
          
        </div>

        <div class="col-sm-2 col-sm-offset-1">
            
            <div class="form-group">

                <label for="invoice_no">Invoice No:</label>
                <select class="form-control" name="invoice_no" id="invoice-no">

                    <option>Select An Invoice</option>
                    <?php foreach ($invoices as $invoice): ?>

                        <option <?= (!empty($parent)) && ($invoice->order_no == $parent->invoice_no) ? 'selected=""' : '' ?> value="<?= $invoice->order_no ?>"><?= $invoice->order_no ?></option>

                    <?php endforeach ?>

                </select>
                
            </div>

        </div>

        <div class="col-sm-2 col-sm-offset-1">

            <div class="form-group">

                <label for="item_name">Item Name:</label>
                <select class="form-control" name="item_name" id="item-name"></select>

            </div>

        </div>

        <div class="col-sm-2 col-sm-offset-1">
            
            <div class="form-group">

                <label for="item_code">Item Code:</label>
                <select class="form-control" name="item_code" id="item-code"></select>

            </div>

        </div>

        <table id="myTable" class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Activity Name</th>
                    <th class="col-sm-2">Status</th>
                    <th class="col-sm-2 text-center">Action</th>
                </tr>

            </thead>

            <tbody id="rows">
                
                <?php foreach ($item_activities as $key => $item_activity): ?>

                    <tr>

                        <td>
                            <select class="form-control required" name="details[<?= $key ?>][activity]">

                                <?php foreach ($activities as $activity): ?>

                                    <option <?= ($activity->activity == $item_activity->activity) ? 'selected=""' : '' ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                                <?php endforeach ?>

                            </select>
                        </td>

                        <td>
                            
                            <select class="form-control required" name="details[<?= $key ?>][status]">

                                <option value="Pending">Pending</option>
                                <option value="Progress">Progress</option>
                                <option value="Complete">Complete</option>

                            </select>

                        </td>

                        <td class="text-center"><input type="button" class="btn btn-del btn-danger" value="Delete"></td>

                    </tr>

                <?php endforeach ?>

            </tbody>

            <tfoot>

                <tr>
                    <td colspan="5"></td>
                    <td style="text-align: right;">
                        <input type="button" class="btn" id="addrow" value="Add New" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary">Save</button>
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

        $("#formRoot").validate();

        $("#stock-status").on("click", function (e) 
        {
            $("#invoice-no").toggle();

            var url1 = "<?= base_url('production/stock/fetch/item/activity/process/itemname') ?>";
            var url2 = "<?= base_url('production/stock/fetch/item/activity/process/itemcode') ?>";

            $.post(url1, function(result) 
            {
                $("#item-name").html(result);
                
            });

            $.post(url2, function(result) 
            {
                $("#item-code").html(result);
                
            });

        });

        $("#invoice-no").on("change", function (e) 
        {
            e.preventDefault();  // stops the jump when an anchor clicked.

            var invoice_no = $(this).val();
            var url1 = "<?= base_url('production/fetch/item/activity/process/itemname') ?>";
            var url2 = "<?= base_url('production/fetch/item/activity/process/itemcode') ?>";

            $.post(url1, { invoice_no: invoice_no }, function(result) 
            {
                $("#item-name").html(result);
                
            });

            $.post(url2, { invoice_no: invoice_no }, function(result) 
            {
                $("#item-code").html(result);
                
            });

        });

        var counter = 100;

        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="details[' + counter + '][activity]"><?php foreach ($activities as $activity): ?><option value="<?= $activity->activity ?>"><?= $activity->activity ?></option><?php endforeach ?></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][status]"><option value="Pending">Pending</option><option value="Progress">Progress</option><option value="Complete">Complete</option></select></td>';
            cols += '<td class="text-center"><input type="button" class="btn btn-del btn-danger" value="Delete"></td>';

            newRow.append(cols);

            $("#rows").append(newRow);

            counter++;

        });

        $("#rows").on("click", '.btn-del', function (e) 
        {
            $(this).closest("tr").remove();
        });

        $("#stock").on("click", function (e) 
        {
            $('select[name^="invoice_no"]').val('');
            $("#invoice").toggle();
        });

    });

</script>
