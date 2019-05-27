<?php

    $parent_processes = '';
    $child_processes = '';

    if(isset($production_process))
    {
        if(!empty($production_process['parent']) && !empty($production_process['child']))
        {
            $parent_processes = $production_process['parent'];
            $child_processes = $production_process['child'];
        }
        else
        {
            redirect('production/create/new/process', 'refresh');
        }

    }

?>

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

<h4>Production Process Report</h4>

<div class="filterable">

    <div class="pull-right">
        <a href="<?= base_url('production/create/new/process') ?>" class="btn btn-info btn-xm"><span class="glyphicons glyphicons-plus"></span> Add New</a>
        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
    </div>

    <table class="table">

        <thead>

            <tr class="filters">
                <th><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control" placeholder="PO ID" disabled></th>
                <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                <th><input type="text" class="form-control" placeholder="Item" disabled></th>
                <th><input type="text" class="form-control" placeholder="Item Code" disabled></th>
                <th><input type="text" class="form-control" placeholder="Progress" disabled></th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($parent_processes as $key => $parent_process): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $parent_process->po_id ?></td>
                    <td><?= (!empty($parent_process->invoice_no)) ? $parent_process->invoice_no : "Stock" ?></td>
                    <td><?= $parent_process->item_name ?></td>
                    <td><?= $parent_process->item_code ?></td>
                    <td>
                        <?php 

                            $result = 0;
                            $count = 0;
                            $count_complete = 0;

                            foreach ($child_processes as $child_process)
                            {
                                if ($parent_process->id == $child_process->ji_production_process_id) 
                                {
                                    ++$count;

                                    if ($child_process->status == 'Complete') 
                                    {
                                        ++$count_complete;
                                    }

                                }

                            }

                            $result = floor(($count_complete * 100) / $count);
                            echo "$result %";

                        ?>
                    </td>
                    <td><a href="<?= base_url("production/edit/process/$parent_process->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("production/delete/process/$parent_process->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

    <div class="col-sm-offset-4">
        
        <?= $this->pagination->create_links(); ?>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
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

        $('.filterable .filters input').on('keyup change', function(e)
        {
            /* Ignore tab key */
            var code = e.keyCode || e.which;

            if (code == '9') return;
            
            /* Useful DOM data and selectors */
            var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');

            /* Worst filter function ever */
            var $filteredRows = $rows.filter(function()
            {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });

            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();

            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();

            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) 
            {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }

        });

    });

</script>
