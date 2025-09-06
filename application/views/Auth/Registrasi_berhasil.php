
<!DOCTYPE html>
<html class="no-js chrome" lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?php echo AppName(); ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta name="robots" content="noindex">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-grid.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-reboot.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet"/>
</head>
<body class="theme-orange" style="overflow: auto;">
<div class="animated slideInLeft auth_v2">
    <div class="auth_v2_box" style="max-width: 900px !important">
          
           
        
        <div class="text-center">

                <!-- <img alt="" src="<?php echo base_url(); ?>/assets/img/logo.png" style="max-width: 200px"> -->
          
        <h4>Check Your Email</h4>
        <p>Login to start shipping, scheduling pickups, tracking shipments and more!</p>
        <a  href="<?=base_url()?>" class="btn btn-primary">Continue</a>
        </div>
       
    </div>
</div>
<div class="auth_bg"></div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery.backstretch/jquery.backstretch.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<!-- BEGIN PAGE LEVEL JS -->
<script src="<?php echo base_url(); ?>assets/js/pvr_lite_login_v1.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<script type="text/javascript">
// $(function() {
//     $.backstretch("<?php echo base_url(); ?>assets/img/bg.jpg");
// });
function Notification() {
    swal("Silahkan hubungi ADMINISTRATOR. Untuk merubah password anda.");
}
</script>
</html>
