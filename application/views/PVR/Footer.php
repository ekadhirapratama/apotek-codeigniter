
<!--Begin Footer-->
        <footer class="footer">
            <div class="container">
                <nav>
                    <p class="copyright text-center">
                        © <span id="writeCopyrights"></span> 2020
                        <a href="<?=base_url()?>" target="_blank">APOTEK</a>
                    </p>
                </nav>
            </div>
        </footer>
        <!--End Footer-->
    </div>
    <!--EndMain Panel-->
</div>
<!--End wrapper-->

<!-- begin scroll to top btn -->
<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-scroll-to-top btn-sm animated invisible text-light" data-color="purple" data-click="scroll-top"><i
        class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</body>
<!--End Body-->

<script type="text/javascript">

var date = new Date();
date.setDate(date.getDate());

    $(function(){
        $('.datepicker').each(function(i) {
            this.class = 'datepicker' + i;
        }).datepicker({
            
            format: "dd-mm-yyyy",
            autoclose   : true,
            todayBtn    : false,
            fontAwesome : true,
         
        });
        $('.select2').select2();

    });
    
    $(function(){
        $('.datepicker1').each(function(i) {
            this.class = 'datepicker' + i;
        }).datepicker({
            endDate: "today",
             startDate: date,
            format: "dd-mm-yyyy",
            autoclose   : true,
            todayBtn    : false,
            fontAwesome : true,
         
        });
        $('.select2').select2();

    });
    
    
    // $.fn.modal.Constructor.prototype._enforceFocus = function() {};

    // CKEDITOR.replace('ckeditor');
    // CKEDITOR.replace('ckeditor2');
    // CKEDITOR.replace('ckeditor3');
    // CKEDITOR.replace('ckeditor4');

    // function Cleaner(v) {
    //     var str = v.value;
    //     var res = str.replace(/[ ,.]/g, "");
    //     var res = res.toUpperCase();
    //     v.value = res;
    // }


	function showNotification(pesan) {
	    "use strict";
	    var color = Math.floor((Math.random() * 4) + 1);
	    $.notify({
	        icon   : "icon-bell icons",
	        message: pesan
	    }, {
	        type     : type[ color ],
	        timer    : 8000,
	        placement: {
	            from : 'top',
	            align: 'center'
	        }
	    });
	}

    function Sukses(txt) {
    	swal("BERHASIL!", txt, "success");
    }

    function Gagal(txt) {
    	swal("GAGAL!", txt, "error");
    }

    function Delete(url) {
		swal({
			title: "Yakin Dihapus?",
			text: "Anda akan menghapus data dari database!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {

			$.get(url, function( data ) {
				if (data == 1) {
					swal("Terhapus!", "Data anda berhasil di hapus.", "success");
					setTimeout(function() {location.reload();
}, 1500);
				} 
				
				else {
					swal("Belum Terhapus!", "COBA LAGI.", "warning");
				}
			});
			
		}
		});
	}

      function Delete1(url) {
        swal({
            title: "Yakin Dihapus?",
            text: "Anda akan menghapus data dari database!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            $.get(url, function( data ) {
                if (data == 1) {
                    swal("Terhapus!", "Data anda berhasil di hapus.", "success");
                    location.reload();
                } 
                
                else {
                    swal("Belum Terhapus!", "COBA LAGI.", "warning");
                }
            });
            
        }
        });
    }
	
	function Bayar(url) {
		swal({
			title: "Yakin Bayar?",
// 			text: "Anda akan menerima barang dari Pusat!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {

			$.get(url, function( data ) {
				if (data == 1) {
					swal("Dibayar!", "Shipment berhasil dibayar.", "success");
					$('#datatable').DataTable().ajax.reload();
				} else if(data==2) {
				   	swal("Belum Terhapus!", "STOK BARANG KURANG DARI 0!", "warning");
				} else {
					swal("Belum Diterima!", "COBA LAGI.", "warning");
				}
			});
			
		}
		});
	}

    function Tolak(url) {
        swal({
            title: "Yakin Tolak?",
//          text: "Anda akan menerima barang dari Pusat!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            $.get(url, function( data ) {
                if (data == 1) {
                    swal("Ditolak!", "Pembayaran Shipment berhasil ditolak.", "success");
                    $('#datatable').DataTable().ajax.reload();
                } else if(data==2) {
                    swal("Belum Terhapus!", "STOK BARANG KURANG DARI 0!", "warning");
                } else {
                    swal("Belum Diterima!", "COBA LAGI.", "warning");
                }
            });
            
        }
        });
    }

    // function IDTgl(dateObject) {
    //     if (dateObject == '0000-00-00') {
    //         return '';
    //     } else {
    //         var d = new Date(dateObject);
    //         var day = d.getDate();
    //         var month = d.getMonth() + 1;
    //         var year = d.getFullYear();
    //         if (day < 10) {
    //             day = "0" + day;
    //         }
    //         if (month < 10) {
    //             month = "0" + month;
    //         }
    //         var date = day + "-" + month + "-" + year;

    //         return date;
    //     }
    // };

     function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
</script>

</html>