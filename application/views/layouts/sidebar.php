<div class="nav-side-menu">

    <div class="brand"><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a></div>

    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">

            <?php if ($this->session->userdata['logged_in']['role'] != 6): ?>
                
                <li data-toggle="collapse" data-target="#user" class="collapsed item">
                    <a href="#"><i class="fa fa-users fa-lg" aria-hidden="true"></i> User <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="user">
                    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                        <li><a href="<?= base_url('admin/user/type') ?>"> User Types</a></li>
                        <li><a href="<?= base_url('admin/user') ?>"> Users</a></li>
                    <?php endif ?>
                    <li><a href="<?= base_url('user/activity') ?>"> User Activity</a></li>
                </ul>

                <li data-toggle="collapse" data-target="#sales" class="collapsed item">
                    <a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Sales <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="sales">
                    <li><a href="<?= base_url('sales/create/item') ?>"><i class="fa fa-cog" aria-hidden="true"></i>Create Sales Item</a></li>
                    <li><a href="<?= base_url('sales/create/person') ?>"><i class="fa fa-cog" aria-hidden="true"></i>Create Sales Person</a></li>
                    <li><a href="<?= base_url('sales/create/order-by') ?>"><i class="fa fa-cog" aria-hidden="true"></i>Create New Order By</a></li>
                    <li><a href="<?= base_url('sales/create/delivery-by') ?>"><i class="fa fa-cog" aria-hidden="true"></i>Create New Delivery By</a></li>
                    <li><a href="<?= base_url('sales/create/factory') ?>"><i class="fa fa-cog" aria-hidden="true"></i>Create New Factory</a></li>
                    <li><a href="<?= base_url('admin/invoice/list') ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Invoice List</a></li>
                    <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                        <li><a href="<?= base_url('admin/reports/invoice') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Invoice Report</a></li>
                        <li><a href="<?= base_url('admin/invoice/graph/reports') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Invoice Graph Report</a></li>
                    <?php endif ?>
                    <li><a href="<?= base_url('admin/invoice/summery/reports/current-month') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Invoice Summery Report</a></li>  
                </ul>

                <li data-toggle="collapse" data-target="#payment" class="collapsed item">
                    <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> Payments<span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="payment">
                    <li><a href="<?= base_url('admin/payment/type') ?>"><i class="fa fa-cog" aria-hidden="true"></i>Payment Type</a></li>
                    <li><a href="<?= base_url('admin/payment/list') ?>"><i class="fa fa-tasks" aria-hidden="true"></i>Payment List</a></li>
                    <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                        <li><a href="<?= base_url('admin/reports/payment') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Payment Report</a></li>
                        <li><a href="<?= base_url('admin/payment/graph/reports') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Payment Graph Report</a></li>
                    <?php endif ?>
                    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                        <li><a href="<?= base_url('admin/payment/summery/reports/current-month') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Payment Summery Report</a></li>
                    <?php endif ?>
                </ul>

                <li data-toggle="collapse" data-target="#service" class="collapsed item">
                    <a href="#"><i class="fa fa-taxi" aria-hidden="true"></i> Service <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="service">
                    <li><a href="<?= base_url('service/create') ?>">Create Service</a></li>
                    <li><a href="<?= base_url('service/list') ?>">Service List</a></li>  
                </ul>

                <li data-toggle="collapse" data-target="#expense" class="collapsed item">
                    <a href="#"><i class="fa fa-money" aria-hidden="true"></i> Expense <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="expense">
                    <li><a href="<?= base_url('admin/expanse') ?>"> Create A New Expense</a></li>
                    <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                        <li><a href="<?= base_url('admin/expanse/list') ?>"> Expense List</a></li>
                    <?php endif ?>
                    <li><a href="<?= base_url('admin/expanse/list/details') ?>"> Expense List Details</a></li>
                    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                        <li><a href="<?= base_url('admin/expanse/report/current-month') ?>"> Expense Report</a></li>
                        <li><a href="<?= base_url('admin/expanse/summery/report') ?>"> Expense Summery Report</a></li>
                    <?php endif ?>
                </ul>

                <li data-toggle="collapse" data-target="#account" class="collapsed item">
                    <a href="#"><i class="fa fa-university" aria-hidden="true"></i> Account <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="account">
                    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                        <li><a href="<?= base_url('admin/account') ?>"> Create A New Account</a></li>
                        <li><a href="<?= base_url('account/create/reference') ?>"> Create A New Reference</a></li>
                        <li><a href="<?= base_url('admin/account/adjustment') ?>"> Account Adjustment</a></li>
                        <li><a href="<?= base_url('admin/account/withdraw') ?>"> Account Withdraw</a></li>
                    <?php endif ?>
                    <li><a href="<?= base_url('account/transfer') ?>"> Account Transfer</a></li>
                    <li><a href="<?= base_url('account/cashinflow') ?>"> Account Cash Inflow</a></li>
                    <li><a href="<?= base_url('admin/account/balance/reports/view') ?>"> Account Balance Reports</a></li>
                    <li><a href="<?= base_url('admin/account/current/balance') ?>"> Account Current Balance</a></li>
                    <!-- <li><a href="<?= base_url('admin/account/day/close') ?>"> Account Day Close</a></li> -->
                    <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                        <li><a href="<?= base_url('account/incoming/reports/current-month') ?>"> Account Monthly Incoming Reports</a></li>
                        <li><a href="<?= base_url('account/outgoing/reports/current-month') ?>"> Account Monthly Outgoing Reports</a></li>
                    <?php endif ?>
                </ul>
                
                <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 3) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                    <li data-toggle="collapse" data-target="#purchase" class="collapsed item">
                        <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchase <span class="arrow"></span></a>
                    </li>
    
                    <ul class="sub-menu collapse" id="purchase">
                        <li><a href="<?= base_url('purchase/item') ?>"> Purchase Item</a></li>
                        <li><a href="<?= base_url('purchase/bill') ?>"> Bills</a></li>
                        <li><a href="<?= base_url('purchase/pay/bill') ?>"> Pay Bills</a></li>
                        <li><a href="<?= base_url('purchase/supplier') ?>"> Supplier</a></li>
                        <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                            <li><a href="<?= base_url('purchase/supplier/report') ?>"> Supplier Report</a></li>
                            <li><a href="<?= base_url('purchase/report') ?>"> Purchase Report</a></li>
                        <?php endif ?>
                        <!-- <li><a href="<?= base_url('purchase/summery/report/current-month') ?>"> Purchase Summery Report</a></li> -->
                    </ul>
    
                    <li data-toggle="collapse" data-target="#worker-management" class="collapsed item">
                        <a href="#"><i class="fa fa-male" aria-hidden="true"></i> Worker Management <span class="arrow"></span></a>
                    </li>
    
                    <ul class="sub-menu collapse" id="worker-management">
                        <li><a href="<?= base_url('worker/workers') ?>"> Workers</a></li>
                        <li><a href="<?= base_url('worker/bill') ?>"> Bills</a></li>
                        <li><a href="<?= base_url('worker/pay/bill') ?>"> Pay Bills</a></li>
                        <?php if ($this->session->userdata['logged_in']['role'] == 1): ?>
                            <li><a href="<?= base_url('worker/bill/report') ?>"> Worker Bill Report</a></li>
                            <li><a href="<?= base_url('worker/paybill/report') ?>"> Worker Paybill Report</a></li>
                            <!-- <li><a href="<?= base_url('worker/summery/report/current-month') ?>"> Worker Summery Report</a></li> -->
                        <?php endif ?>
                    </ul>
                
                <?php endif ?>

                <li data-toggle="collapse" data-target="#production" class="collapsed item">
                    <a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i> Production <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="production">
                    <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>
                        <li><a href="<?= base_url('production/activity') ?>"> Activity</a></li>
                        <li><a href="<?= base_url('production/item/activity') ?>"> Item wise Activity</a></li>
                        <li><a href="<?= base_url('production/process') ?>"> Production Order</a></li>
                        <li><a href="<?= base_url('production/budget') ?>"> Budget</a></li>
                        <li><a href="<?= base_url('production/cost') ?>"> Cost</a></li>
                    <?php else: ?>
                        <li><a href="<?= base_url('production/process') ?>"> Production Order</a></li>
                    <?php endif ?>
                </ul>

                <?php if (($this->session->userdata['logged_in']['role'] == 1) || ($this->session->userdata['logged_in']['role'] == 5)): ?>

                    <li data-toggle="collapse" data-target="#stock" class="collapsed item">
                        <a href="#"><i class="fa fa-stack-overflow" aria-hidden="true"></i> Stock <span class="arrow"></span></a>
                    </li>

                    <ul class="sub-menu collapse" id="stock">
                        <li><a href="<?= base_url('stock/create/adjustment') ?>"> Stock Adjustment</a></li>
                        <li><a href="<?= base_url('stock/report') ?>"> Stock Report</a></li>
                    </ul>

                <?php endif ?>

                <li data-toggle="collapse" data-target="#marketing" class="collapsed item">
                        <a href="#"><i class="fa fa-stack-overflow" aria-hidden="true"></i> Marketing <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="marketing">
                    <li><a href="<?= base_url('marketing/send/sms/view') ?>"> Send Marketing SMS</a></li>
                    <li><a href="<?= base_url('marketing/list/sms') ?>"> Marketing SMS List</a></li>
                    <li><a href="<?= base_url('marketing/send/single/sms/view') ?>"> Send SMS</a></li>
                </ul>

            <?php else: ?>

                <li data-toggle="collapse" data-target="#sales" class="collapsed item">
                    <a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i> Sales <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="sales">
                    <li><a href="<?= base_url('admin/reports/invoice') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Invoice Report</a></li>  
                </ul>

                <li data-toggle="collapse" data-target="#service" class="collapsed item">
                    <a href="#"><i class="fa fa-taxi" aria-hidden="true"></i> Service <span class="arrow"></span></a>
                </li>

                <ul class="sub-menu collapse" id="service">
                    <li><a href="<?= base_url('service/create') ?>">Create Service</a></li>
                    <li><a href="<?= base_url('service/list') ?>">Service List</a></li>  
                </ul>

            <?php endif ?>

        </ul>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
        $('.item').click(function()
        {
            $('.item').removeClass("active");
            $(this).addClass("active");
        });

    });

</script>
