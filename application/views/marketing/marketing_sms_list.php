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

<?php if ($this->session->flashdata('success_status')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success_status') ?></div>
<?php elseif ($this->session->flashdata('error_status')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error_status') ?></div>
<?php endif ?>

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
                        <th><input type="text" class="form-control date" placeholder="Date" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Subject" disabled></th>
                        <th><input type="text" class="form-control" placeholder="To customer" disabled></th>
                    </tr>

                </thead>

                <tbody>

                    <?php 

                    $to_customer = [
                        0 => "All users",
                        1 => "Last 1 month users",
                        2 => "Last 4 months users",
                        3 => "Last 6 months users",
                        4 => "Last 1 year users",
                    ];

                    foreach ($sms_lists as $key => $sms_list): ?>
                        
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= date("m/d/Y", strtotime($sms_list->send_sms_date)) ?></td>
                            <td><?= $sms_list->subject ?></td>
                            <td><?= $to_customer[$sms_list->to_customer] ?></td>
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
        $(".date").datepicker();
        
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
