<ul class="nav navbar-nav">

    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url(); ?>assets/logo.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/logo.png" class="" alt="User">

                <p>
                    <?php echo $this->session->userdata('nama'); ?>
                    <small>Online</small>
                </p>
                
            </li>

            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="<?php echo base_url(); ?>Login/GantiPassword" class="btn btn-default btn-flat">Ganti Password</a>
                </div>
                <div class="pull-right">
                    <a href="<?php echo base_url(); ?>Login/Logout" class="btn btn-default btn-flat">Logout</a>
                </div>
            </li>
        </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->
    <li>
        <a href="<?php echo base_url(); ?>Login/Logout"><i class="fa fa-sign-out"></i></a>
    </li>
</ul>