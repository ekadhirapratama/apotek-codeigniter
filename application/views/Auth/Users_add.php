<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <div class="pvr-box">
                    <h5 class="pvr-header">
                        Tambah User
                        <div class="pvr-box-controls">
                            <i class="material-icons" id="ReloadData" data-box="refresh">refresh</i>
                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                        </div>
                    </h5>
                    <?php echo form_open_multipart(base_url().$this->uri->segment(1)."/".$this->uri->segment(2)); ?>

                     <div class="form-group">
                        <label class="col-md-4">Username</label>
                        <div class="form-group col-md-7">
                            <input class="form-control" type="text" name="username" placeholder="Username">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-md-4">Password</label>
                        <div class="form-group col-md-7">
                            <input class="form-control" type="text" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Cabang</label>
                        <div class="form-group col-md-7">
                        <select class="form-control select2" name="id_cabang">

                            <option selected>--Pilih--</option>
                            <?php
                            $this->db->order_by('nama', 'ASC');
                            // $this->db->select('no', 'nama');
                            $a = $this->db->get('data_cabang_pusat');
                            foreach ($a->result() as $a) {
                                echo '<option value="'.$a->no.'">'.$a->nama.'</option>';
                            }
                            ?>

                        </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4">Kategori</label>
                        <div class="form-group col-md-7">
                            <select class="form-control" type="text" name="kategori" >
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="member">Member</option>

                            </select> 
                        </div>
                    </div>

                    
                    
                        <div class="form-group col-md-7">
                            <input type="hidden" name="send" value="OK">
                       
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!--End Content-->




