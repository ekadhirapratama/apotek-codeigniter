<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <div class="pvr-box">
                    <h5 class="pvr-header">
                        Edit User
                        <div class="pvr-box-controls">
                            <i class="material-icons" id="ReloadData" data-box="refresh">refresh</i>
                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                        </div>
                    </h5>
                    <?php echo form_open_multipart(base_url().$this->uri->segment(1)."/".$this->uri->segment(2)); 
                    foreach ($records->result() as $r) {
     
                    ?>


                     <div class="form-group">
                        <label class="col-md-4">Username</label>
                        <div class="form-group col-md-7">
                            <input class="form-control" type="text" name="username" placeholder="Username" value="<?=$r->username?>">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-md-4">Password</label>
                        <div class="form-group col-md-7">
                            <input class="form-control" type="text" name="password" placeholder="Password">
                            <a>*Kosongkan bila tidak ingin mengganti password</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Cabang</label>
                        <div class="form-group col-md-7">
                        <select class="form-control select2" name="id_cabang" value="<?=ShowData('data_cabang_pusat',array('no' => $r->id_cabang), 'nama');?>">

                            <option selected>--Pilih--</option>
                            <?php
                            $this->db->order_by('nama', 'ASC');
                            // $this->db->select('no', 'nama');
                            $a = $this->db->get('data_cabang_pusat');
                            foreach ($a->result() as $a) {
                              if($a->no == $r->id_cabang) {
                                $selected = 'selected';
                              } else {
                                $selected = '';
                              }

                                echo '<option value="'.$a->no.'" '.$selected.'>'.$a->nama.'</option>';
                            }
                            ?>

                        </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Kategori</label>
                        <div class="form-group col-md-7">
                            <select class="form-control" type="text" name="kategori">

                                <option value="superadmin" <?php if ($r->kategori == 'superadmin' ) echo 'selected' ; ?> >Super Admin</option>
                                <option value="admin"<?php if ($r->kategori == 'admin' ) echo 'selected' ; ?>>Admin</option>
                                <option value="operator"<?php if ($r->kategori == 'operator' ) echo 'selected' ; ?>>Operator</option>
                                <option value="member"<?php if ($r->kategori == 'member' ) echo 'selected' ; ?>>Member</option>

                            </select> 
                        </div>
                    </div>
              <?php } ?>
                    
                    
                        <div class="form-group col-md-7">
                            <input type="hidden" name="send" value="OK">
                            <input type="hidden" name="id" value="<?=$r->no;?>">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!--End Content-->




