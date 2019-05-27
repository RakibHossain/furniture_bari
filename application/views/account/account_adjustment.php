<h4>Account Adjustment</h4>

<form class="form-horizontal formRoot" action="<?= base_url('admin/account/adjustment/insert') ?>" method="POST">

    <table class="table order-list">

        <thead>

            <tr>
                <th class="col-sm-2">Account Name</th>
                <th class="col-sm-3">Amount</th>
                <th class="col-sm-3">Date</th>
                <th class="col-sm-3"></th>
            </tr>

        </thead>

        <tbody>

            <tr>

                <td>
                    
                    <select class="form-control" name="account_name">

                        <?php foreach ($accounts as $account): ?>

                            <option value="<?= $account->account_name ?>"><?= $account->account_name ?></option>

                        <?php endforeach ?>  

                    </select>

                </td>

                <td>
                    <input type="text" name="amount" class="form-control required" />
                </td>

                <td>
                    <input type="text" name="date" class="form-control required date" />
                </td>

                <td>
                    <button type="submit" class="btn btn-primary">Save</button>
                </td>

            </tr>

        </tbody>

    </table>

</form>

<table class="table table-condensed table-hover">

    <thead>

        <tr>
            <th>Date</th>
            <th>Account Name</th>
            <th>Amount</th>
        </tr>

    </thead>

    <tbody>

        <tr>

            <?php foreach ($account_adjustments as $account_adjustment): ?>

                <tr>
                    <td><?= $account_adjustment->date ?></td>
                    <td><?= $account_adjustment->account_name ?></td>
                    <td><?= $account_adjustment->amount ?></td>
                </tr>

            <?php endforeach ?>

        </tr>        

    </tbody>

</table>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker().datepicker("setDate", new Date());
        $(".formRoot").validate();
    });

</script>
