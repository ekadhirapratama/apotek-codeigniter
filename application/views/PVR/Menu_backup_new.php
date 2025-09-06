<!-- Begin wrapper -->
<!--<div class="wrapper">-->
    <div class="">
    <!--Begin Sidebar-->
    <div class="sidebar" data-color="blue" data-image="">
        <div class="sidebar-wrapper">
            <!--Begins Logo start-->
            <div class="logo">
                <a href="<?php echo base_url(); ?>Dashboard">
                    <center>
                        <!-- <img src="<?php echo base_url(); ?>assets/img/logo.png"/> -->
                    </center>
                </a>
            </div>

            <?php
             $user=$this->session->username;

        $pass=$this->session->password;
            ?>
            <!--End Logo start-->

            <!--Begins User Section-->
            <div class="user">
                <div class="photo">
                    <img src="<?php echo base_url(); ?>assets/img/user.png"/>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#pvr_user_nav" class="collapsed">
                            <span><?php echo $this->session->username; ?>
                                <b class="caret"></b>
                            </span>
                    </a>
                    <div class="collapse m-t-10" id="pvr_user_nav">
                        <ul class="nav">
                            <li>
                                <a class="profile-dropdown" href="<?php echo base_url(); ?>Login/GantiPassword">
                                    <span class="sidebar-mini"><i class="icon-lock-open"></i></span>
                                    <span class="sidebar-normal">Ganti Password</span>

                                </a>
                            </li>
                            <li>
                                <a class="profile-dropdown" href="<?php echo base_url(); ?>Login/Logout">
                                    <span class="sidebar-mini"><i class="icon-logout"></i></span>
                                    <span class="sidebar-normal">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--End User Section-->

            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>Dashboard">
                        <i class="material-icons">home</i>
                        <p>Dashboard</p>
                    </a>
                </li>
               
                    
                <?php setting_menu($user,$pass); ?>

                <?php
if (is_level(array('superadmin')) == 1) {
?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>Login/Users">
                        <i class="material-icons">account_circle</i>
                        <p>USER</p>
                    </a>
                </li>
<?php
}
?>
                            
                        <!-- </ul>
                    </div> -->
                </ul>
                    <!-- </div> -->
                
<br>
        </div>
    </div>
    <!--End Sidebar-->

    <!--Begin Main Panel-->
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" data-color="purple"
                                class="btn btn-fill btn-round btn-icon d-none d-lg-block">
                            <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                            <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                        </button>
                    </div>
                    <a class="navbar-brand" id="page_header_title" href="<?php echo base_url(); ?>Dashboard">
                        <i class="material-icons">apps</i>
                        <?php echo AppName(); ?>
                    </a>
                </div>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button  style="font-size: 14px; font-weight: bold;" class="btn btn-danger" id="sekarang"></button>
                        </li>
                        <li class="nav-item">
                            <button  style="font-size: 14px; font-weight: bold;" class="btn btn-info">
                                <?php echo $this->session->kategori; ?>
                            </button>
                        </li>
                        
                        <li class="nav-item dropdown dropdown-slide">
                            <a class="nav-link" href="<?php echo base_url(); ?>Login/Logout" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">power_settings_new</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar 