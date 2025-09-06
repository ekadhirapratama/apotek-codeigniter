<!--Begin Content-->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pvr-wrapper">
                <div class="pvr-box">
                    <h5 class="pvr-header">
                        Data User
                        <div class="pvr-box-controls">
                            <i class="material-icons" id="ReloadData" data-box="refresh">refresh</i>
                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                        </div>
                    </h5>

                    <button type="button" class="btn btn-wd btn-primary" data-toggle="modal" data-target="#ModalTambah" style="margin-bottom: 20px">
                        TAMBAH
                    </button>

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                           
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Username</th>
                         
                     
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
<!--End Content-->

<!-- Modal Tambah-->
<div class="modal fade" id="ModalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 0 20px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="TambahData" action="" method="post">

                <div class="modal-body">
                 

                  <div class="form-group">
                    <label>Nama :</label>
                    <input type="text" class="form-control" name="nama">
                  </div>

                  <div class="form-group">
                    <label>Username (Dipakai saat login) :</label>
                    <input type="text" class="form-control" name="username" required>
                  </div>

                  <div class="form-group">
                    <label>Password :</label>
                    <input type="text" class="form-control" name="password" required>
                  </div>

                  <div class="form-group">
                    <label>Kategori :</label>
                    <select class="form-control" name="kategori" required>
                        <option value="operator">Operator</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                  </div>
                  
                  
                </div>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 0 20px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="Edit" action="" method="post">

                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama :</label>
                    <input type="text" class="form-control" name="nama" id="nama" readonly>
                  </div>

                  <div class="form-group">
                    <label>Username :</label>
                    <input type="text" class="form-control" name="username" id="username" readonly>
                  </div>

                  <div class="form-group">
                    <label>Password :</label>
                    <input type="text" class="form-control" name="password" id="password">
                    <p>Kosongkan bila tidak igin mengganti password.</p>
                  </div>

                  <div class="form-group">
                    <label>Kategori :</label>
                    <select class="form-control" name="kategori" id="kategori" required>
                        <option value="operator">Operator</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                  </div>
                  
                  
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="update">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-warning">PERBARUI</button>
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
            "order": [[ 1, "asc" ]],
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
                url :"<?php echo base_url(); ?>MasterData/UserJson", 
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
        url :"<?php echo base_url(); ?>MasterData/TambahUser",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (success) {
          if (success == -1) {
            Gagal('Username sudah ada.');
          }else if (success == 1) {
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
        url :"<?php echo base_url(); ?>MasterData/EditUser",
        data: {id:idx},
        success: function (success) {
          if (success) {
            var data = JSON.parse(success);
            $('form#Edit #id').val(data.no);
            $('form#Edit #nama').val(data.nama);
            $('form#Edit #username').val(data.username);
            $('form#Edit #kategori').val(data.kategori);
           
            $('#ModalEdit').modal('show');
          };
        }
      });
    }

    $("form#Edit").submit(function(event){
     
      event.preventDefault(); 
      var formData = new FormData($(this)[0]);
     
      $.post({
        url :"<?php echo base_url(); ?>MasterData/EditUser",
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



</script>
