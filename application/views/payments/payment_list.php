<style type="text/css">

    .filterable 
    {
        margin-top: 15px;
    }

    .filterable .panel-heading .pull-right 
    {
        margin-top: -20px;
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

        <div class="panel panel-primary filterable">

            <div class="panel-heading">

                <h3 class="panel-title">&nbsp;</h3>
                <div class="pull-right">
                    <a href="<?= base_url('admin/payment') ?>" class="btn btn-default btn-xs"><span class="glyphicons glyphicons-plus"></span> Add New</a>
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>

            </div>
            
            <table id="datatable" class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="User" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Payment Type" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Reference No" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Account" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                        <th class="text-center">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($data as $key => $value): ?>
                        
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= date("m/d/Y", strtotime($value->date)) ?></td>
                            <td><?= $value->name ?></td>
                            <td>
                                <?php if ($value->receive_status == 1): ?>
                                    <span style="color: green;"><?= $value->order_no ?></span>
                                <?php else: ?>
                                    <span style="color: red;"><?= $value->order_no ?></span>
                                <?php endif ?>  
                            </td>
                            <td><?= $value->payment_type ?></td>
                            <td><?= $value->reference_no ?></td>
                            <td><?= $value->account_name ?></td>
                            <td><?= $value->amount ?></td>
                            <td>
                                <a href="<?= base_url("admin/payment/edit/$value->id") ?>" class="btn btn-sm btn-success" data-id='<?=$value->id?>'><i class="fa fa-edit"></i></a>
                                <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                                    <button class="btn btn-sm btn-danger delete_row" data-id="<?=$value->id?>"><i class="fa fa-trash"></i></button>
                                <?php endif ?>
                            </td>
                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script type="text/javascript">

    $(document).ready(function()
    {
        //$(".date").datepicker({ dateFormat: 'yy-mm-dd' });
        $(".date").datepicker();

        $('.delete_row').on('click', function()
        {
            var retConf = confirm('Are you sure you want to delete this row?');
            
            if(!retConf)
            {
                return false;
            }

            var id    = $(this).attr('data-id');
            var rowNo = $(this).parents('tr').index();

            $.ajax({
                type: 'POST',
                url: "<?= base_url('admin/payment/delete') ?>",
                async: true,
                data: {'id': id},
                success: function(data) 
                {
                    if(data == 'ok')
                    {
                        $('.table').find('tbody').find('tr').eq(rowNo).remove();
                    }

                },

            });

        });

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
