<h4>Activity's List</h4>

<?php if ($type == 'new'): ?>

    <form class="form-horizontal" id="newForm" action="<?= base_url('production/insert/activity') ?>" method="POST">

        <table class="table">

            <tbody>

                <tr>

                    <td class="col-sm-2">Activity Name: </td>

                    <td class="col-sm-2">
                        <input type="text" name="activity" class="form-control required" />
                    </td>

                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

    <table class="table table-condensed table-hover">

        <thead>

            <tr>
                <th>#</th>
                <th>Activity Name</th>
                <th class="text-center">Action</th>
            </tr>

        </thead>

        <tbody>

            <?php $i = 0; foreach ($activities as $activity): ?>

                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= $activity->activity ?></td>
                    <td><a href="<?= base_url("production/edit/activity/$activity->id") ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="<?= base_url("production/delete/activity/$activity->id") ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

<?php else: ?>

    <form class="form-horizontal" id="editForm" action="<?= base_url("production/update/activity/$edit_activity->id") ?>" method="POST">

        <table class="table">

            <tbody>

                <tr>

                    <td class="col-sm-2">Activity Name: </td>
                    <td class="col-sm-2">
                        <input type="text" name="activity" class="form-control required" value="<?= $edit_activity->activity ?>" />
                    </td>
                    <td style="text-align: left;">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </td>

                </tr>

            </tbody>

        </table>

    </form>

<?php endif ?>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $(".date").datepicker();
        $(".date").datepicker("setDate", new Date());

        $("#newForm").validate();
        $("#editForm").validate();

    });

</script>
