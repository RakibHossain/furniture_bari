<h4>Stock Adjustment</h4>

<form class="form-horizontal formRoot" action="<?= base_url("stock/insert/adjustment") ?>" method="POST">

    <table id="myTable" class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Item Category</th>
                <th class="col-sm-2">Item Name</th>
                <th class="col-sm-2">Item Code</th>
                <th class="col-sm-1">Qty</th>
                <th class="col-sm-2">Unit Price</th>
                <th class="col-sm-2">Total</th>
            </tr>

        </thead>

        <tbody id="rows">

            <tr>
                <td>
                    <select class="form-control" name="details[0][item_category]">

                        <option value="Sales Item">Sales Item</option>
                        <option value="Purchase Item">Purchase Item</option>

                    </select>
                </td>
                <td>
                    <select class="form-control" name="details[0][item_name]">

                        <option>Select Item Name</option>
                        <?php foreach ($items as $item): ?>

                            <option value="<?= $item->item_name ?>"><?= $item->item_name ?></option>

                        <?php endforeach ?>

                    </select>
                </td>
                <td>
                    <select class="form-control required" name="details[0][item_code]">

                        <option>Select Item Code</option>
                        <?php foreach ($items as $item): ?>

                            <option value="<?= $item->item_code ?>"><?= $item->item_code ?></option>

                        <?php endforeach ?>

                    </select>
                </td>
                <td>
                    <input type="text" name="details[0][qty]"  class="form-control row_qty required"/>
                </td>
                <td>
                    <input type="text" name="details[0][unit_price]"  class="form-control row_unit_price required"/>
                </td>
                <td>
                    <input type="text" name="details[0][total]" readonly=""  class="form-control row_total required"/>
                </td>

            </tr>

        </tbody>

        <tfoot>

            <tr>
                <td colspan="5"></td>
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

        $(".formRoot").validate();

        var counter = 100;

        $("#addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="details[' + counter + '][item_category]"><option value="sales item">Sales Item</option><option value="purchase item">Purchase Item</option></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][item_name]"><option>Select Item Name</option><?php foreach ($items as $item): ?><option value="<?= $item->item_name ?>"><?= $item->item_name ?></option><?php endforeach ?></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][item_code]"><option>Select Item Code</option><?php foreach ($items as $item): ?><option value="<?= $item->item_code ?>"><?= $item->item_code ?></option><?php endforeach ?></td>';
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

        $("#rows").on("click", '.btn-del', function (event) 
        {
            $(this).closest("tr").remove();
            calculateGrandTotal();
        });

    });

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

        $('input[name^="total_qty"]').val(totalQty);
        $('input[name^="total_amount"]').val(totalAmount.toFixed(2));

    }

</script>
