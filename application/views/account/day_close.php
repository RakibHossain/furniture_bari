<h4>Account Day Close</h4>

<form class="form-horizontal formRoot" action="<?= base_url('admin/insert/account/day/close') ?>" method="POST">

    <div>
        <?php foreach ($account_balances as $key => $account_balance): ?>
            <input type="text" name="data[<?= $key ?>][date]" class="form-control date" />
            <input type="text" name="data[<?= $key ?>][account_id]" class="form-control" value="<?= $account_balance->id ?>" />
            <input type="text" name="data[<?= $key ?>][amount]" class="form-control" value="<?= $account_balance->amount ?>" />
        <?php endforeach ?>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Close Day Account</button>
    </div>

</form>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker().datepicker("setDate", new Date());
        $(".formRoot").validate();
    });

</script>
