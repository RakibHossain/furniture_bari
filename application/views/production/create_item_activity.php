<?php

    $parent = '';
    $child = '';

    if(isset($edit_activities))
    {
        if(!empty($edit_activities['parent']) && !empty($edit_activities['child']))
        {
            $parent = $edit_activities['parent'];
            $child = $edit_activities['child'];
        }
        else
        {
            redirect('production/create/item/activity', 'refresh');
        }

    }

?>

<?php if ($type == 'new'): ?>

    <h4>Create Production Activity Item</h4>

    <form class="form-horizontal" id="formRoot" action="<?= base_url("production/insert/item/activity") ?>" method="POST">

        <div class="col-sm-2">

            <div class="form-group">

                <label for="item_name">Item Name:</label>
                <select class="form-control" name="item_name">

                    <?php foreach ($items as $item): ?>

                        <option value="<?= $item->item_name ?>"><?= $item->item_name ?></option>

                    <?php endforeach ?>

                </select>

            </div>

        </div>

        <table id="myTable" class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Activity Name</th>
                    <th class="col-sm-2 text-center">Action</th>
                </tr>

            </thead>

            <tbody id="rows"></tbody>

            <tfoot>

                <tr>
                    <td colspan="5"></td>
                    <td style="text-align: right;">
                        <input type="button" class="btn" id="new-addrow" value="Add New" />
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

    <h4>Edit Production Activity Item</h4>

    <form class="form-horizontal" id="formRoot" action="<?= base_url("production/update/item/activity/$edit_activity_id") ?>" method="POST">

        <div class="col-sm-2">

            <div class="form-group">

                <label for="item_name">Item Name:</label>
                <select class="form-control" name="item_name">

                    <?php foreach ($items as $item): ?>

                        <option <?= ($item->item_name == $parent->item_name ? 'selected=""' : '') ?> value="<?= $item->item_name ?>"><?= $item->item_name ?></option>

                    <?php endforeach ?>

                </select>

            </div>

        </div>

        <table id="myTable" class="table">

            <thead>

                <tr>
                    <th class="col-sm-2">Activity Name</th>
                    <th class="col-sm-2 text-center">Action</th>
                </tr>

            </thead>

            <tbody id="rows">

                <?php foreach ($child as $key => $value): ?>

                    <tr>

                        <td>
                            <select class="form-control" name="details[<?= $key ?>][activity]">

                                <?php foreach ($activities as $activity): ?>

                                    <option <?= ($activity->activity == $value->activity ? 'selected=""' : '') ?> value="<?= $activity->activity ?>"><?= $activity->activity ?></option>

                                <?php endforeach ?>

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
                        <input type="button" class="btn" id="edit-addrow" value="Add New" />
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

        var counter = 100;

        $("#new-addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select class="form-control required" name="details[' + counter + '][activity]"><?php foreach ($activities as $activity): ?><option value="<?= $activity->activity ?>"><?= $activity->activity ?></option><?php endforeach ?></td>';
            cols += '<td class="text-center"><input type="button" class="btn btn-del btn-danger" value="Delete"></td>';

            newRow.append(cols);

            $("#rows").append(newRow);

            counter++;

        });

        $("#edit-addrow").on("click", function () 
        {
            var newRow = $("<tr>");
            var cols = "";

            //cols += '<td><input type="text" class="form-control required" name="details[' + counter + '][activity]"/></td>';
            cols += '<td><select class="form-control required" name="details[' + counter + '][activity]"><?php foreach ($activities as $activity): ?><option value="<?= $activity->activity ?>"><?= $activity->activity ?></option><?php endforeach ?></td>';
            cols += '<td class="text-center"><input type="button" class="btn btn-del btn-danger" value="Delete"></td>';

            newRow.append(cols);

            $("#rows").append(newRow);

            counter++;

        });

        $("#rows").on("click", '.btn-del', function (e) 
        {
            $(this).closest("tr").remove();
        });

    });

</script>
