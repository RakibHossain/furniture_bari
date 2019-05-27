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

<?php if ($this->session->flashdata('success_status')): ?>
    <div class="alert alert-success"> <?= $this->session->flashdata('success_status') ?> </div>
<?php elseif ($this->session->flashdata('error_status')): ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('error_status') ?> </div>
<?php endif ?>

<h4>Account Transfer</h4>

<form class="form-horizontal formRoot" action="<?= base_url('account/transfer/insert') ?>" method="POST">

    <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

    <table class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Date</th>
                <th class="col-sm-2">From Account</th>
                <th class="col-sm-2">To Account</th>
                <th class="col-sm-2">Amount</th>
                <th class="col-sm-3">Remarks</th>
            </tr>

        </thead>

        <tbody>

            <tr>

                <td>
                    <input type="text" name="date" readonly class="form-control required date" />
                </td>

                <td>
                    
                    <select class="form-control" name="from_account">
                        
                        <?php if ($this->session->userdata['logged_in']['role'] == 2): ?>

                            <option value="Cash In Mirpur">Cash In Mirpur</option>
                            <?php foreach ($accounts as $account): ?>

                                <?php 
                                    if ($account->account_name == 'Cash On MD') {
                                        continue;
                                    }
                                ?>
                                <?php if ($account->access_type == 1): ?>
                                    <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endif ?>

                            <?php endforeach ?>

                        <?php elseif ($this->session->userdata['logged_in']['role'] == 3): ?>

                            <option value="Cash In Factory">Cash In Factory</option>
                            <?php foreach ($accounts as $account): ?>

                                <?php 
                                    if ($account->account_name == 'Cash On MD') {
                                        continue;
                                    }
                                ?>
                                <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>

                            <?php endforeach ?>

                        <?php elseif ($this->session->userdata['logged_in']['role'] == 4): ?>

                            <option value="Cash In MDP">Cash In MDP</option>
                            <?php foreach ($accounts as $account): ?>

                                <?php 
                                    if ($account->account_name == 'Cash On MD') {
                                        continue;
                                    }
                                ?>
                                <?php if ($account->access_type == 1): ?>
                                    <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endif ?>

                            <?php endforeach ?>

                        <?php else: ?>

                            <?php foreach ($accounts as $account): ?>
                                <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                            <?php endforeach ?>

                        <?php endif ?>

                    </select>

                </td>

                <td>
                    
                    <select class="form-control" name="to_account">

                        <?php if ($this->session->userdata['logged_in']['role'] == 2): ?>

                            <option value="Cash In Mirpur">Cash In Mirpur</option>
                            <?php foreach ($accounts as $account): ?>

                                <?php 
                                    if ($account->account_name == 'Cash On MD') {
                                        continue;
                                    }
                                ?>
                                <?php if ($account->access_type == 1): ?>
                                    <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endif ?>

                            <?php endforeach ?>

                        <?php elseif ($this->session->userdata['logged_in']['role'] == 3): ?>

                            <option value="Cash In Factory">Cash In Factory</option>
                            <?php foreach ($accounts as $account): ?>

                                <?php 
                                    if ($account->account_name == 'Cash On MD') {
                                        continue;
                                    }
                                ?>
                                <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>

                            <?php endforeach ?>

                        <?php elseif ($this->session->userdata['logged_in']['role'] == 4): ?>

                            <option value="Cash In MDP">Cash In MDP</option>
                            <?php foreach ($accounts as $account): ?>

                                <?php 
                                    if ($account->account_name == 'Cash On MD') {
                                        continue;
                                    }
                                ?>
                                <?php if ($account->access_type == 1): ?>
                                    <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                                <?php endif ?>

                            <?php endforeach ?>

                        <?php else: ?>

                            <?php foreach ($accounts as $account): ?>
                                <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>
                            <?php endforeach ?>

                        <?php endif ?>

                    </select>

                </td>

                <td>
                    <input type="text" name="amount" class="form-control required" />
                </td>

                <td>
                    <textarea cols="20" rows="3" class="form-control" name="remark"></textarea>
                </td>

                <td>
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </td>

            </tr>

        </tbody>

    </table>

</form>

<h4>Transfer Report</h4>

<div class="filterable">

    <div class="pull-right">

        <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        
    </div>

    <table id="datatable" class="table">

        <thead>

            <tr class="filters">
                <th width="6%"><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control filter-date" placeholder="Date" disabled></th>
                <th><input type="text" class="form-control" placeholder="From Account" disabled></th>
                <th><input type="text" class="form-control" placeholder="To Account" disabled></th>
                <th><input type="text" class="form-control" placeholder="Amount" disabled></th>
                <th><input type="text" class="form-control" placeholder="Balance(From)" disabled></th>
                <th><input type="text" class="form-control" placeholder="Balance(To)" disabled></th>
                <th><input type="text" class="form-control" placeholder="Remark" disabled></th>
            </tr>

        </thead>

        <tbody>
        
            <?php foreach ($transfer_reports as $key => $transfer_report): ?>

                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= date("m/d/Y", strtotime($transfer_report->date)) ?></td>
                    <td><?= $transfer_report->from_account ?></td>
                    <td><?= $transfer_report->to_account ?></td>
                    <td><?= $transfer_report->amount ?></td>
                    <td><?= $transfer_report->balance_from ?></td>
                    <td><?= $transfer_report->balance_to ?></td>
                    <td><?= $transfer_report->remark ?></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".formRoot").validate();
        $(".filter-date").datepicker();
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
