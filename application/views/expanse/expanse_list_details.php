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

<div class="row">
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="filterable">

            <div class="pull-right">

                <a href="<?= base_url('admin/create/new/expanse') ?>" class="btn btn-info btn-xm"><span class="glyphicons glyphicons-plus"></span> Add New</a>
                <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
            
            <table id="datatable" class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Expense Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Expense Category" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Description" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                        <th class="text-center">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($expanses as $key => $expanse): ?>

                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= (!empty($expanse->date)) ? date("m/d/Y", strtotime($expanse->date)) : '' ?></td>
                            <td><?= $expanse->expanse_name ?></td>
                            <td><?= $expanse->expanse_category ?></td>
                            <td><?= $expanse->description ?></td>
                            <td><?= $expanse->account ?></td>
                            <td><?= $expanse->amount ?></td>
                            <td><a href="<?= base_url("admin/new/expanse/edit/$expanse->expanse_id") ?>" class="btn btn-success"><i class="fa fa-edit"></a></td>
                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

            <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                
                <?= $this->pagination->create_links(); ?>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function ()
    {
        $(".date").datepicker();

        // click on filter button
        $('.filterable .btn-filter').click(function()
        {
            var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');

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
