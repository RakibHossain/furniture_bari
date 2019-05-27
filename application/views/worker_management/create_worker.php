<?php if ($type == 'edit'): ?>

    <h4>Edit Worker</h4>

    <form class="form-horizontal" id="new-worker" action="<?= base_url("worker/update/$edit_worker->id") ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Name</th>
                    <th class="col-sm-3">Balance</th>
                    <th class="col-sm-3">Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="name" class="form-control required" value="<?= $edit_worker->name ?>" />
                    </td>

                    <td>
                        <input type="text" name="balance" readonly="" class="form-control required" value="<?= $edit_worker->balance ?>" />
                    </td>

                    <td>
                        
                        <select class="form-control" name="type">

                            <?php foreach ($worker_types as $worker_type): ?>

                                <option value="<?= $worker_type->type ?>"><?= $worker_type->type ?></option>

                            <?php endforeach ?>   

                        </select>

                    </td>

                </tr>

                <tr>
                    
                    <td>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php else: ?>

    <h4>Add Worker</h4>

    <form class="form-horizontal" id="worker-type" action="<?= base_url('worker/insert/type') ?>" method="POST">

        <table class="table">

            <thead>

                <tr>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td class="col-sm-3">Add Worker Type: </td>

                    <td class="col-sm-2">
                        <input type="text" name="type" class="form-control required" />
                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <form class="form-horizontal" id="new-worker" action="<?= base_url('worker/insert') ?>" method="POST">

        <table class="table order-list">

            <thead>

                <tr>
                    <th class="col-sm-2">Name</th>
                    <th class="col-sm-3">Balance</th>
                    <th class="col-sm-3">Type</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        <input type="text" name="name" class="form-control required" />
                    </td>

                    <td>
                        <input type="text" name="balance" class="form-control" />
                    </td>

                    <td>
                        
                        <select class="form-control" name="type">

                            <option>Select A Type</option>
                            <?php foreach ($worker_types as $worker_type): ?>

                                <option value="<?= $worker_type->type ?>"><?= $worker_type->type ?></option>

                            <?php endforeach ?>   

                        </select>

                    </td>

                </tr>

                <tr>
                    
                    <td>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $("#worker-type").validate();
        $("#new-worker").validate();

    });

</script>
