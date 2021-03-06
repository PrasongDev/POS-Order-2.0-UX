
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title><?php echo isset($title) ? $title . ' | Stock & POS manager' : 'Stock & POS manager'; ?></title>    
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <meta name="robots" content="noindex, nofollow">

        <?php
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->css('style.css');
        echo $this->assets->plugins_css('sweetalert/sweetalert.css');

        echo $this->assets->plugins_js('jquery/jquery.min.js');
        echo $this->assets->plugins_js('bootstrap/js/tether.min.js');
        echo $this->assets->plugins_js('bootstrap/js/bootstrap.min.js');
        ?>

    </head>

    <body>
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" >
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>

        <section id="wrapper">
            <div class="login-register" style="background-color: #1565C0; padding: 6vw 0 0 0; position: absolute; margin-bottom: -1000px">        
                <div class="login-box card">
                    <div class="card-block">
                        <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo base_url() . 'admin/login/dologin'; ?>">
                            <div class="text-center" style="font-size: 40px;"><i class="fa fa-unlock-alt"></i></div>
                            <h3 class="box-title m-b-20 text-center">เข้าสู่ระบบ Admin</h3>
                            <h3 class="box-title m-b-20 text-center">POS | Order | Stock Manager</h3>

                            <div class="text-center" id="flash_message4500">
                                <?php
                                if ($this->session->flashdata('flash_message') != '') {
                                    ?>
                                    <?php
                                    echo $this->session->flashdata('flash_message');
                                    ?>
                                    <br>
                                    <?php
                                }
                                ?>                                
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" required="" placeholder="Password"> 
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button style="padding: 10px 15px 10px 15px;" class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>
                                </div>
                            </div>                          
                        </form>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12" style="color: silver">
                        Powered by © <a href="http://www.pos.apsth.com/" target="_blank" style="color: white">APS</a>  2017 - 2018, V.2.0-UX All right reserved. 
                    </div>
                </div>
            </div>

        </section>

        <?php
        
        echo $this->assets->js('jquery.slimscroll.js');
        echo $this->assets->js('waves.js');
        echo $this->assets->js('sidebarmenu.js');
        echo $this->assets->plugins_js('sticky-kit-master/dist/sticky-kit.min.js');
        echo $this->assets->plugins_js('sparkline/jquery.sparkline.min.js');
        echo $this->assets->js('custom.min.js');
        echo $this->assets->plugins_js('styleswitcher/jQuery.style.switcher.js');
        echo $this->assets->plugins_js('sweetalert/sweetalert.min.js');
        echo $this->assets->js('flash-message.js');
        
        ?>

       
    </body>

</html>