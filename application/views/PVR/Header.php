<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
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
    <link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" id="themecolor"/>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>
    <!-- BEGIN PAGE LEVEL STYLE -->
    <link href="<?php echo base_url(); ?>assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet"/>
    
    <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet"/>

    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/build/css/intlTelInput.css">


    <!-- END PAGE LEVEL STYLE -->
    <!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/waitMe/waitMe.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pvr_lite_app.js" id="appjs"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>

    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
 
    <script src="<?php echo base_url(); ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/my.js"></script>
    <script src="<?php echo base_url(); ?>assets/build/js/intlTelInput.js"></script>

    <script type="text/javascript">
          window.setTimeout("waktu()",1000); 
          function waktu() { 
            var tanggal = new Date(); 
            setTimeout("waktu()",1000);
            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            var tglku = tanggal.getDate();

            if (tglku < 10) {
                tglku = '0'+tglku;
            }
            var tgl = tglku+' '+months[tanggal.getMonth()]+' '+tanggal.getFullYear();

            var menit = tanggal.getMinutes();
            var detik = tanggal.getSeconds();

            if (menit < 10 ) {
              menit = '0'+menit;
            }

            if (detik < 10 ) {
              detik = '0'+detik;
            }
            var jam = tanggal.getHours()+':'+menit+':'+detik;

            if (tgl < 10 ) {
              tgl = '0'+tgl;
            }

            $('#sekarang').html(tgl+' '+jam);
          }

        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });

    </script>

    <!-- END PAGE LEVEL JS -->

    <style type="text/css">
        .logo {
            width: 100%;
        }

        .logo img {
            max-width: 50%;
        }

        .select2, .select2-search {
            width: 100% !important;
        }
        .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }

         body{
    font-size: 14px !important;
  }
    </style>
</head>
<!--Body Begins-->
 <!-- class="sidebar-mini" -->
 <?php
 
 $uri = $this->uri->segment(1);
 $uri2 = $this->uri->segment(2);
if ($uri == 'Dashboard' or $uri2 == 'Daftar' or  $uri2 == 'DetailShipment' or $uri2 == 'Payment' or $uri2 == 'ReturPenjualan_retur') {
    echo '<body class="sidebar-mini">';
} else {
    echo '<body>';
}
?>

<!--Begin Loading-->
<div class="preloader">
    <div class="loading">
        <h2>
            Loading...
        </h2>
        <span class="progress"></span>
    </div>
</div>
<!--End Loading-->