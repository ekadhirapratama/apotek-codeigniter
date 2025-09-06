<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <div class="pvr-box">
                    <h5 class="pvr-header">
                        Ganti Password
                        <div class="pvr-box-controls">
                            <i class="material-icons" id="ReloadData" data-box="refresh">refresh</i>
                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                        </div>
                    </h5>
                    <form id="GantiPassword" action="" method="post">
                        <input type="hidden" name="save">
                        <div class="form-group">
                          <label>Password Lama :</label>
                          <input type="password" class="form-control" name="passlama" id="passlama">
                        </div>

                        <div class="form-group">
                          <label>Password Baru :</label>
                          <input type="password" class="form-control" name="passbaru" id="passbaru">
                        </div>

                        <div class="form-group">
                          <label>Ulangi Password :</label>
                          <input type="password" class="form-control" name="passbaru2" id="passbaru2">
                        </div>

                        <button type="submit" class="btn btn-warning">SIMPAN PERUBAHAN</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
<!--End Content-->

<script type="text/javascript" language="javascript" >

//TAMBAH DATA
$("form#GantiPassword").submit(function(event){
 
  event.preventDefault(); 
  var formData = new FormData($(this)[0]);
 
  $.post({
    url: '<?php echo base_url(); ?>Auth/GantiPassword',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (success) {
      if (success == -1) {
        Gagal('Password Lama Anda Salah.');
      }else if (success == -2) {
        Gagal('Password Baru Tidak Sama.');
      }else if (success == 0) {
        Gagal('Ganti Password Gagal.');
      }else if (success == 1) {
        Sukses('Ganti Password Berhasil.');
        window.setTimeout(
          function(){
            location.reload(true);
          },
          2000
        );
      };
    }
  });
 
  return false;
});

</script>