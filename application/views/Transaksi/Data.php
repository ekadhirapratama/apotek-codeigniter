<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <div class="pvr-box">
                    <h5 class="pvr-header">
                        Data Transaksi
                        <div class="pvr-box-controls">
                            <i class="material-icons" id="ReloadData" data-box="refresh">refresh</i>
                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                        </div>
                    </h5>

                    <button type="button" class="btn btn-wd btn-primary" data-toggle="modal" data-target="#ModalTambah" style="margin-bottom: 20px">
                        TAMBAH
                    </button>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                           
                           
                            <th>Nama Pasien</th>
                            <th>Obat</th>
                          
                            <th>Tgl Transaksi</th>
                           
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="TambahData" action="" method="post">

              <div class="form-group">
                <label>Nama Pasien:</label>
                <select type="text" class="form-control select2" name="id_pasien" required>
                      <option value="">--Pilih Pasien--</option>
                  <?php
                  $pasien = $this->db->get('pasien');

                  foreach ($pasien->result() as $p) {
                    echo '<option value="'.$p->id.'">'.$p->nama.'</option>';
                    # code...
                  }
                  ?>
                </select>
              </div>
             
               <table class="table table-bordered">
          <tr>
            <td colspan="3"><a class="btn btn-success" onclick="Add1()" style="color: white">Tambah Obat</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" onclick="Remove1()" style="color: white">Hapus</a></td>
          </tr>
          <tbody id="obatnya">

          </tbody>
       
         </table>
          
              <!--  <div class="form-group">-->
              <!--  <label>Jumlah:</label>-->
              <!--   <input type="text" class="form-control" name="jumlah" id="hanyaAngka" onkeydown="CekInput()" required>-->
              <!--</div>-->
          

              <div class="modal-footer">

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
                <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="Edit" action="" method="post">

                    <div class="form-group">
                <label>Nama Obat:</label>
                <input type="text" class="form-control" name="nama_obat" id="nama_obat">
              </div>
              <div class="form-group">
                <label>Satuan:</label>
                <select type="text" class="form-control select2" name="satuan" id="satuan">
                  <option value="Mg">Mg</option>
                </select>
              </div>
                <div class="form-group">
                <label>Qty:</label>
                 <input type="number" class="form-control" name="qty" id="qty">
              </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="update">
                   
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
       
        var dataTable = $('#datatable').DataTable( {
           "createdRow": function( row, data, dataIndex ) {
          
          $( row ).find('td:eq(4)').attr('align', 'center');
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
                url :"<?php echo base_url(); ?>Transaksi/TransaksiJson", 
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
    $("form#TambahData").submit(function(event){
     
      event.preventDefault(); 
      var formData = new FormData($(this)[0]);
     
      $.post({
        url :"<?php echo base_url(); ?>Transaksi/TambahTransaksi",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (success) {
          if (success == -1) {
            Gagal('Obat sudah ada.');
          }else if (success == 1) {
            Sukses('Data berhasil ditambahkan.');
            $('.modal').modal('hide');
            $("form#TambahData").trigger('reset');
        //   location.reload();
          setTimeout(function() {
    location.reload();
}, 2000);
          };
        }
      });
     
      return false;
    });

    //EDIT DATA
    function Edit(idx) {
      $.post({
        url :"<?php echo base_url(); ?>Transaksi/EditObat",
        data: {id:idx},
        success: function (success) {
          if (success) {
            var data = JSON.parse(success);
            $('form#Edit #id').val(data.id);
            $('form#Edit #nama_obat').val(data.nama_obat);
            $('form#Edit #satuan').val(data.satuan);
            $('form#Edit #qty').val(data.qty);
        
            $('#ModalEdit').modal('show');
          };
        }
      });
    }

    $("form#Edit").submit(function(event){
     
      event.preventDefault(); 
      var formData = new FormData($(this)[0]);
     
      $.post({
        url :"<?php echo base_url(); ?>Transaksi/EditObat",
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
 }

 function cek_database(r){
      var id = $("#id_obat"+r).val();
      $.ajax({

        url: '<?php echo base_url(); ?>Transaksi/getobat',
        data:"id="+id,

        success: function (data) {
         var json = data,
         obj = JSON.parse(json);
        
         $('#stok'+r).val(obj.qty);
        
       }
     });
    }
  
    
     var jml1 = 0;
     var a = 0;
     var b = 0;
   
    function Remove1() {
      $("#obatnya #records"+jml1).fadeOut();
      $("#obatnya #records"+jml1).remove();

      if (jml1 > 0) {
        jml1 -= 1;
      }
  };

  function Add1() {
    
      jml1 += 1;
      a += 1;
      b += 1;
    

      $('#obatnya').append('<div id="records'+jml1+'">'+
      '<div class="form-group">'+
      '<label>Obat:</label><select type="text" class="get_obat" name="id_obat[]" id="id_obat'+jml1+'" onchange="cek_database('+jml1+')"  required></select>'+
      '</div>'+
       '<div class="form-group">'+
      '<label>Stok:</label><input type="text" class="form-control" name="stok[]" id="stok'+jml1+'" readonly>'+
      '</div>'+
      '<div class="form-group">'+
      '<label>Jumlah:</label><input type="text" class="form-control" name="jumlah[]">'+
      '</div><hr style="border-top: 4px solid blue;" >'+
      
      '</div>');
      
      
      
         $(".get_obat").select2({
      placeholder: '',
      ajax: {
          url: '<?php echo base_url(); ?>Transaksi/get_obat',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
          return {results: data};
          },
          cache: true
        }
      });
      
       
      
  };
  
  
  

</script>
