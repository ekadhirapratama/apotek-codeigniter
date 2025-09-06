<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <div class="pvr-box">
                    <h5 class="pvr-header">
                      <?php
                      $huruf = $this->uri->segment(3);
                      ?>
                        Data Pasien <?=$huruf?>
                        <div class="pvr-box-controls">
                            <i class="material-icons" id="ReloadData" data-box="refresh">refresh</i>
                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                        </div>
                    </h5>
                    <a href="javascript:TambahData('<?=$huruf?>')" class="btn btn-wd btn-primary">TAMBAH</a>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                           
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Nomor BPJS</th>
                       
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th class="text-center">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>

    </div>
</div>
<!--End Content-->

<!-- Modal Tambah-->
<div class="modal fade" id="ModalTambah">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="padding: 0 20px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pasien <?=$huruf?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="TambahData" action="" method="post">

              <div class="form-group">
                  <h5 style="float:right">Rekam Medik Terakhir : <span id="nomor"></span></h5>
                <label>Nomor:</label>
                <input type="number" class="form-control" name="nomor">
                 
              </div>
              <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama">
              </div>
                <div class="form-group">
                <label>NIK:</label>
                 <input type="text" class="form-control" name="nik" id="hanyaAngka" onkeydown="CekInput()" maxlength="16">
              </div>
              <div class="form-group">
                <label>Nomor BPJS:</label>
                 <input type="text" class="form-control" name="no_bpjs" id="hanyaAngka1" onkeydown="CekInput()">
              </div>
              <div class="form-group">
                <label>Alamat:</label>
                <textarea type="text" class="form-control" name="alamat" style="height: 100px"></textarea>
              </div>
              <div class="form-group">
                <label>Foto:</label>
                  <input class="form-control" type="file" name="foto">              
              </div>
            

              <div class="modal-footer">
                <input type="hidden" class="form-control" name="status" value="<?=$huruf?>">  
                <input type="hidden" name="update">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn btn-warning">SIMPAN</button>
              </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="ModalEdit">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="padding: 0 20px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pasien <?=$huruf?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="Edit" action="" method="post">

                <div class="form-group">
                <label>Nomor:</label>
                <input type="text" class="form-control" name="nomor" id="nomor" readonly>
              </div>
              <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama" id="nama">
              </div>
                <div class="form-group">
                <label>NIK:</label>
                 <input type="number" class="form-control" name="nik" id="nik" maxlength="16">
              </div>
               <div class="form-group">
                <label>Nomor BPJS:</label>
                 <input type="text" class="form-control" name="no_bpjs" id="no_bpjs" onkeydown="CekInput()">
              </div>
              <div class="form-group">
                <label>Alamat:</label>
                <textarea type="text" class="form-control" name="alamat" id="alamat" style="height: 100px"></textarea>
              </div>
               <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                <label>Foto:</label>
                  <input class="form-control" type="file" name="foto">              
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <a href="#" id="edit_foto" data-fancybox="gallery">
                    <button type="button" class="btn btn-info form-control">LIHAT FOTO</button>
                  </a>
                </div>
              </div>
              </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="update">
                    <input type="hidden" class="form-control" name="status" value="<?=$huruf?>">  
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-warning">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" language="javascript" >

    //DATATABLE
    $(function() {
       
       var hurufnya ='<?php echo $this->uri->segment(3);?>'
        var dataTable = $('#datatable').DataTable( {
           "createdRow": function( row, data, dataIndex ) {
          
          $( row ).find('td:eq(3)').attr('align', 'center');
        },
            "processing": true,
            "serverSide": true,
            "responsive": false,
            "autoWidth": false,

            "order": [[ 0, "desc" ]],
            "lengthMenu": [[10, 50, 100, 500, 999999999999], [10, 50, 100, 500, "All"]],
            
            "language": {
              "search": "Cari : ",
              "lengthMenu": "Tampilkan _MENU_ data per halaman.",
              "zeroRecords": "Tidak Ada Data.",
              "info": "Melihat halaman _PAGE_ dari _PAGES_.",
              "infoEmpty": "Data Tidak Tersedia.",
              "infoFiltered": "(Hasil dari _MAX_ total data.)",
              "paginate": {
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
              },
            },

            "ajax":{
                url :"<?php echo base_url(); ?>MasterData/PasienJson/"+hurufnya, 
                type: "post",
                error: function(){

                    alert('ERROR LOADING DATA');
 
                }
            }

        });
    });

    //RELOAD DATA
    $("#ReloadData").click(function(){
        $('#datatable').DataTable().ajax.reload();
    });


    //TAMBAH DATA

    function TambahData(idx) {
   
      $.post({
        url :"<?php echo base_url(); ?>MasterData/TambahPasien",
        data: {huruf:idx},
        success: function (success) {
          if (success) {
            var data = JSON.parse(success);
            $('form#TambahData #nomor').text(data.datanya);
       
            $('#ModalTambah').modal('show');
          };
        }
      });
    }
    $("form#TambahData").submit(function(event){
     
      event.preventDefault(); 
      var formData = new FormData($(this)[0]);
     
      $.post({
        url :"<?php echo base_url(); ?>MasterData/TambahPasien",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (success) {
          if (success == -1) {
            Gagal('NIK pasien sudah ada.');
          } else if (success == -2) {
            Gagal('Huruf Awalan Pasien Tidak <?php echo $this->uri->segment(3) ?> !!');
          } else if (success == 1) {
            Sukses('Data berhasil ditambahkan.');
            $('.modal').modal('hide');
            $("form#TambahData").trigger('reset');
            $('#datatable').DataTable().ajax.reload();
          };
        }
      });
     
      return false;
    });

    //EDIT DATA
    function Edit(idx) {
      $.post({
        url :"<?php echo base_url(); ?>MasterData/EditPasien",
        data: {id:idx},
        success: function (success) {
          if (success) {
            var data = JSON.parse(success);
            $('form#Edit #id').val(data.id);
            $('form#Edit #nama').val(data.nama);
            $('form#Edit #nik').val(data.nik);
            $('form#Edit #no_bpjs').val(data.no_bpjs);
            $('form#Edit #alamat').val(data.alamat);
            $('form#Edit #nomor').val(data.nomor);
            $('form#Edit #edit_foto').attr('href','<?php echo base_url('upload/'); ?>'+data.foto);
           
            $('#ModalEdit').modal('show');
          };
        }
      });
    }

    $("form#Edit").submit(function(event){
     
      event.preventDefault(); 
      var formData = new FormData($(this)[0]);
     
      $.post({
        url :"<?php echo base_url(); ?>MasterData/EditPasien",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (success) {
          if (success == 1) {
            Sukses('Data berhasil diubah.');
            $('.modal').modal('hide');
            $("form#EditData").trigger('reset');
            $('#datatable').DataTable().ajax.reload();
          } else if (success == -1) {
            Gagal('Data Sudah Ada.');
          } else {
            Gagal('Gagal.');
          };
        }
      });
     
      return false;
    });

    function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

 function CekInput() {
 
    setInputFilter(document.getElementById("hanyaAngka"), function(value) {
        return /^\d*$/.test(value); });
    setInputFilter(document.getElementById("hanyaAngka1"), function(value) {
        return /^\d*$/.test(value); }); 
        setInputFilter(document.getElementById("no_bpjs"), function(value) {
        return /^\d*$/.test(value); });
 }


</script>
