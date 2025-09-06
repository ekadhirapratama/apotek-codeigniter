

<style type="text/css">
  .table th, .table td {
      padding: 0.3rem !important;
  }
</style>

<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <center>
                
                </center>
               
              
                
                <div class="row">
                   <?php 
                        foreach (range('A', 'Z') as $char) { ?>
                    <div class="col-xl-3 col-sm-6 mb-4">
                        <div class="card card-shadow ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-3">
                                        <?php
                                        if($char =='A' || $char =='E' || $char =='I' || $char =='I' || $char =='M'|| $char =='Q' || $char =='U' || $char =='Y') {
                                            $bg = 'danger';
                                        } else if($char =='B' || $char =='F' || $char =='J' || $char =='N' || $char =='R'|| $char =='V' || $char =='Z') {
                                            $bg ='primary';
                                        } else if($char =='C' || $char =='G' || $char =='K' || $char =='O' || $char =='S'|| $char =='W') {
                                            $bg ='warning';
                                        }
                                            else {
                                            $bg ='info';
                                        }
                                        ?>
                                        <span class="bg-<?=$bg?> text-center pvr-icon-box">
                                            <i class="icon-people text-light f-s-24"></i>
                                        </span>
                                    </div>
                                    <div class="col-9">
                                        <a href="<?php echo base_url(); ?>MasterData/Pasien/<?=$char?>"><h6 class="mt-1 mb-0"><?=$char?></h6></a>
                                        <?php
                                          $total = $this->db->get_where('pasien', array('status' => $char))->num_rows();
                                        ?>
                              
                                        <p class="mb-0"><?=$total?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php } ?>
                </div>

            </div>
        </div>
      </div>
    </div>

   