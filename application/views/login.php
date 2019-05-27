<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Login Page</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    
    </head>

    <body>

        <div class="container">

            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">     

                <center><h2><?= ORG_NAME ?></h2></center>

                <?php if ($this->session->flashdata('error_status')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= $this->session->flashdata('error_status') ?>   
                    </div>
                <?php endif; ?>

                <div class="panel panel-info">

                    <div class="panel-heading">
                        <div class="panel-title text-center">Sign In</div>
                    </div>

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form action="" method="POST" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="password">
                            </div>

                            <div style="margin-top:10px" class="form-group">

                                <div class="col-sm-12 controls">
                                    <button type="submit" class="btn btn-success">Login</button>
                                </div>
                                
                            </div>

                        </form>     

                    </div>

                </div>

            </div>

        </div>

    </body>

    <footer>
        <!-- <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.1.1.min.js') ?>" ></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>" ></script>
    </footer>

</html>
