 <!--Begin Content-->
        <div class="content">

            <form class="form-horizontal" role="form" action="<?php echo base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3); ?>" method="post">  
            <div class="row">


                <?php 
                            edit_menu();
                ?>

                
    </div>

<?php foreach ($records->result() as $r) {
    # code...
?>
<div class="form-group col-md-7">
        <input type="hidden" name="send" value="OK">
        <input type="hidden" name="id" value="<?=$r->no;?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
<?php } ?>
</div>
</div>
</form>
</div>