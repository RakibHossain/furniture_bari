<!DOCTYPE html>
<html lang="en">

    <head>

    	<meta charset="utf-8">
        <meta http-equiv="refresh" content="86400">
    	<title><?= $title ?></title>

        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/datatables.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/select2.min.css') ?>" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

        <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>" ></script>
        <script type="text/javascript" src="<?= base_url('assets/js/datatables.min.js') ?>" ></script>
        <script type="text/javascript" src="<?= base_url('assets/js/jquery-validation/dist/jquery.validate.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>" ></script>
        <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>" ></script>
        <script type="text/javascript" src="<?= base_url('assets/js/select2.min.js') ?>" ></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">

            var idleMax  = 30; // Logout after 30 minutes of Idle
            var idleTime = 0;

            setInterval("timerIncrement()", 60000);  // 1 minute interval    
            
            $("body").mousemove(function(event) {
                idleTime = 0; // reset to zero
            });

            // count minutes
            function timerIncrement() 
            {
                idleTime = idleTime + 1;
                if (idleTime > idleMax) 
                { 
                    window.location = "<?= base_url('admin/logout') ?>";
                    // window.location = "../application/views/login.php";
                }
            }

            setInterval("checkUserAuth()", 1000);  // 1 minute interval

            function checkUserAuth() 
            {
                var url    = "<?= base_url('check/user/auth') ?>";
                var userID = "<?= $this->session->userdata['logged_in']['id'] ?>";

                $.post(url, {userID: userID}, function(result) 
                {
                    // console.log(result);
                    if (result == 0) 
                    {
                        window.location = "<?= base_url('admin/logout') ?>";
                    }
                });
            }

        </script>

    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-static-top">

            <?php include_once('navbar.php'); ?>
            
        </nav>

        <div class="row">
            
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2">

                <?php include_once('sidebar.php'); ?>
                
            </div>

            <div id="app-body" class="col-lg-9 col-md-9 col-sm-9 col-xs-9">

                <h1><?= $title ?></h1>
                <?php $this->view($page); ?>

            </div>

        </div>

    </body>

</html>
