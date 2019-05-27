<style type="text/css">

    .filterable 
    {
        margin-top: 15px;
    }

    .filterable .filters input[disabled] 
    {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }

    .filterable .filters input[disabled]::-webkit-input-placeholder 
    {
        color: #333;
    }

    .filterable .filters input[disabled]::-moz-placeholder 
    {
        color: #333;
    }

    .filterable .filters input[disabled]:-ms-input-placeholder 
    {
        color: #333;
    }
    
</style>

<h4>Account Withdraw</h4>

<form class="form-horizontal formRoot" action="<?= base_url('admin/account/withdraw/insert') ?>" method="POST">

    <table class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Date</th>
                <th class="col-sm-3">Amount</th>
                <th class="col-sm-3">Account</th>
                <th class="col-sm-3">Remark</th>
            </tr>

        </thead>

        <tbody>

            <tr>

                <td>
                    <input type="text" name="date" class="form-control required date" />
                </td>

                <td>
                    <input type="text" name="amount" class="form-control required" />
                </td>

                <td>
                    <select class="form-control" name="account_name">
                        <?php foreach ($accounts as $account): ?>
                            <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                        <?php endforeach ?>
                    </select>
                </td>

                <td>
                    <textarea cols="30" rows="2" class="form-control required" name="remark"></textarea>
                </td>

                <td class="pull-right">
                    <button type="submit" class="btn btn-primary btn-block">Withdraw</button>
                </td>

            </tr>

        </tbody>

    </table>

</form>

<div class="filterable">

    <div class="pull-right">

        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        
    </div>

    <table id="datatable" class="table table-condensed table-hover">

        <thead>

            <tr class="filters">
                <th><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control date" placeholder="Withdraw Date" disabled></th>
                <th><input type="text" class="form-control" placeholder="Withdraw Amount" disabled></th>
                <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                <th><input type="text" class="form-control" placeholder="Balance Status" disabled></th>
                <th><input type="text" class="form-control" placeholder="Remarks" disabled></th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($withdraws as $key => $withdraw): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $withdraw->date ?></td>
                    <td><?= $withdraw->amount ?></td>
                    <td><?= $withdraw->account_name ?></td>
                    <td><?= $withdraw->balance ?></td>
                    <td><?= $withdraw->remark ?></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".formRoot").validate();
        $(".date").datepicker().datepicker("setDate", new Date());

        // click on filter button
        $('.filterable .btn-filter').click(function()
        {
            var $panel   = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody   = $panel.find('.table tbody');

            if ($filters.prop('disabled') == true) 
            {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } 
            else 
            {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }

        });

        // // custom filter event
        // $('.filterable .filters input').on('keyup change', function(e)
        // {
        //     /* Ignore tab key */
        //     var code = e.keyCode || e.which;

        //     if (code == '9') return;
            
        //     /* Useful DOM data and selectors */
        //     var $input = $(this),
        //     inputContent = $input.val().toLowerCase(),
        //     $panel = $input.parents('.filterable'),
        //     column = $panel.find('.filters th').index($input.parents('th')),
        //     $table = $panel.find('.table'),
        //     $rows = $table.find('tbody tr');

        //     /* Worst filter function ever */
        //     var $filteredRows = $rows.filter(function()
        //     {
        //         var value = $(this).find('td').eq(column).text().toLowerCase();
        //         return value.indexOf(inputContent) === -1;
        //     });

        //     /* Clean previous no-result if exist */
        //     $table.find('tbody .no-result').remove();

        //     /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        //     $rows.show();
        //     $filteredRows.hide();

        //     /* Prepend no-result row if all rows are filtered */
        //     if ($filteredRows.length === $rows.length) 
        //     {
        //         $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        //     }

        // });

        // DataTable
        var table = $('#datatable').DataTable();
     
        // Apply the search
        table.columns().every(function () {
            var datatableColumn = this;
            var searchTextBoxes = $(this.header()).find('input');

            searchTextBoxes.on('keyup change', function () {

                if (datatableColumn.search() !== this.value) {
                    datatableColumn.search(this.value).draw();
                }

            });

        });

    });

</script>
