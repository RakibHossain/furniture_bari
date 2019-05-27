<h4>Production Item Wise Activity</h4>

<div class="row">

    <div class="col-sm-2 col-sm-offset-10">
        <a href="<?= base_url("production/create/item/activity") ?>" class="btn btn-info">Create A New</a>
    </div>
    
</div>

<table class="table order-list">

    <thead>

        <tr>
            <th class="col-sm-2">Item</th>
            <th class="col-sm-3 text-center">Action</th>
        </tr>

    </thead>

    <tbody>

        <?php foreach ($activities as $activity): ?>

            <tr>
                <td><?= $activity->item_name ?></td>
                <td><a href="<?= base_url("production/edit/item/activity/$activity->id") ?>" class="btn btn-success">Edit</a></td>
                <td><a href="<?= base_url("production/delete/item/activity/$activity->id") ?>" class="btn btn-danger">Delete</a></td>
            </tr>

        <?php endforeach ?>

    </tbody>

</table>
