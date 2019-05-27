<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <h3>Report Details</h3>

        <div class="pull-right">

            <button class="btn btn-info btn-xm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

        </div>

        <table class="table order-list">

            <thead>

                <tr>
                    
                    <?php foreach ($expanse_categories as $expanse_category): ?>

                        <?php if ($type == 'expanse'): ?>

                            <th class="col-sm-1"><?= $expanse_category->expanse_category_name ?></th>

                        <?php elseif ($type == 'purchase'): ?>

                            <th class="col-sm-1"><?= $expanse_category->item_name ?></th>

                        <?php else: ?>

                            <th class="col-sm-1"><?= $expanse_category->type ?></th>

                        <?php endif ?>

                    <?php endforeach ?>
                    
                </tr>

            </thead>

            <tbody>

                <tr>

                    <?php foreach ($expanse_categories as $expanse_category): ?>

                        <?php if ($type == 'expanse'): ?>

                            <?php foreach ($expanse_report_details as $expanse_report_detail): ?>

                                <?php if ($expanse_category->expanse_category_name == $expanse_report_detail->expanse_category): ?>

                                    <td><?= $expanse_report_detail->amount ?></td>

                                    <?php break; ?>

                                <?php else: ?>

                                    <td>0</td>

                                <?php endif ?>

                            <?php endforeach ?>

                        <?php elseif ($type == 'purchase'): ?>

                            <?php foreach ($expanse_report_details as $expanse_report_detail): ?>

                                <?php if ($expanse_category->item_name == $expanse_report_detail->expanse_category): ?>

                                    <td><?= $expanse_report_detail->amount ?></td>

                                    <?php break; ?>

                                <?php else: ?>

                                    <td>0</td>

                                <?php endif ?>

                            <?php endforeach ?>

                        <?php else: ?>

                            <?php foreach ($expanse_report_details as $expanse_report_detail): ?>

                                <?php if ($expanse_category->type == $expanse_report_detail->expanse_category): ?>

                                    <td><?= $expanse_report_detail->amount ?></td>

                                    <?php break; ?>

                                <?php else: ?>

                                    <td>0</td>

                                <?php endif ?>

                            <?php endforeach ?>

                        <?php endif ?>

                    <?php endforeach ?>

                </tr>

            </tbody>

        </table>

    </div>

</div>
