<h4>Account Current Balances</h4>

<table class="table table-condensed table-hover">

    <thead>

        <tr>
            <th>Account Name</th>
            <th>Balance</th>
        </tr>

    </thead>

    <tbody>

        <?php foreach ($account_balances as $account_balance): ?>

            <tr>
                <td><?= $account_balance->account_name ?></td>
                <td><?= $account_balance->amount ?></td>
            </tr>

        <?php endforeach ?>

    </tbody>

</table>
