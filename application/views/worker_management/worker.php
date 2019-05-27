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

<h4>Workers</h4>

<div class="filterable">

    <div class="pull-right">

        <a href="<?= base_url('worker/create') ?>" class="btn btn-info btn-xm"><span class="glyphicons glyphicons-plus"></span> Add New</a>
        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        
    </div>

    <table id="datatable" class="table order-list">

        <thead>

            <tr class="filters">
                <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                <th><input type="text" class="form-control" placeholder="Balance" disabled></th>
                <th><input type="text" class="form-control" placeholder="Type" disabled></th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($workers as $key => $worker): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $worker->name ?></td>
                    <td><?= $worker->balance ?></td>
                    <td><?= $worker->type ?></td>
                    <td>
                        <a href="<?= base_url("worker/edit/$worker->id") ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url("worker/delete/$worker->id") ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>

<script type="text/javascript">
    
    $(function () 
    {
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
