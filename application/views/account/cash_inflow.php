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

<h4>Cash Inflow</h4>

<div class="filterable">

    <div class="pull-right">
        <a href="<?= base_url('account/create/cashinflow') ?>" class="btn btn-info btn-xm"><span class="glyphicons glyphicons-plus"></span> Add New</a>
        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
    </div>

    <table id="datatable" class="table">

        <thead>

            <tr class="filters">
                <th><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                <th><input type="text" class="form-control" placeholder="User" disabled></th>
                <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                <th><input type="text" class="form-control" placeholder="Payment Type" disabled></th>
                <th><input type="text" class="form-control" placeholder="Reference No." disabled></th>
                <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                    <th class="text-center">Action</th>
                <?php endif ?>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($cash_inflows as $key => $cash_inflow): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $cash_inflow->date ?></td>
                    <td><?= $cash_inflow->user_name ?></td>
                    <td><?= $cash_inflow->account_name ?></td>
                    <td><?= $cash_inflow->payment_type ?></td>
                    <td><?= $cash_inflow->reference_no ?></td>
                    <td><?= $cash_inflow->amount ?></td>
                    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                        <td>
                            <a href="<?= base_url("account/edit/cashinflow/$cash_inflow->id") ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url("account/delete/cashinflow/$cash_inflow->id") ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    <?php endif ?>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
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
