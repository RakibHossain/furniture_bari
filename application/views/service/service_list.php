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
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>

            </div>

            <table id="datatable" class="table">

                <thead>

                    <tr class="filters">
                        <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Invoice No" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Delivery Date" disabled></th>
                        <th><input type="text" class="form-control date" placeholder="Followup Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Customer Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Due" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <th class="text-center">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                        $statusArr = ['0' => 'Out Of Condition', '1' => 'Pending', '2' => 'Processing', '3' => 'Complete', '4' => 'Not Response'];
                        foreach ($services as $key => $value) {
                    ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $value->invoice_no ?></td>
                            <td><?= date("m/d/Y", strtotime($value->date)) ?></td>
                            <td><?= date("m/d/Y", strtotime($value->delivery_date)) ?></td>
                            <td><?= date("m/d/Y", strtotime($value->followup_date)) ?></td>
                            <td><?= $value->customer_name ?></td>
                            <td><?= $value->mobile_no ?></td>
                            <td><?= $value->due ?></td>
                            <td><?= $statusArr[$value->status] ?></td>
                            <td>
                                <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                                    <a href="<?= base_url("service/delete/$value->id"); ?>" class="btn btn-sm btn-danger" data-id="<?= $value->id ?>">X</a>
                                <?php endif ?>
                                <a href="<?= base_url("service/edit/$value->id"); ?>" class="btn btn-sm btn-success" data-id="<?= $value->id ?>">View</a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script type="text/javascript">
    
    $(function()
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
