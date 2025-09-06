<?php

function AppName() {
	return 'APOTEK';
}

function inputnya($input){
	 $ci = &get_instance();
	return $ci->input->post($input, TRUE);
}

function enumselect($table = '', $field = '')
    {
        $enums = array();
        if ($table == '' || $field == '') return $enums;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value) {
            $enums[$value] = $value; 
        }
        return $enums;
    }  

function PVR($uri_content,$data='') {
	$ci =& get_instance();
	$ci->load->view('PVR/Header');
	$ci->load->view('PVR/Menu');
	$ci->load->view($uri_content,$data);
	$ci->load->view('PVR/Footer');
}



function ShowData($table,$where,$show) {
        $ci =& get_instance();
        $query = $ci->db->get_where($table,$where);
        $row = $query->row();
        if ($query->num_rows() > 0) {
        	return $row->$show;
        } else {
        	return '-';
        }
        
}

function warning_message($massage,$url)
		{
			?>
				<script>
				<?php
				if($massage!=null)
				{
					echo 'alert("'.$massage.'");';
				}
				?>
					document.location="<?php echo $url; ?>";
				</script>
			<?php
		}


function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function Button($link,$class,$icon,$text,$target = '') {       
	if ($target !=='') {
       $tar = 'target="'.$target.'"';
    } else {
        $tar = '';
    }

    $button = '<a '.$tar.' href="'.$link.'" class="btn btn-sm btn-'.$class.'" style="margin-right: 5px; "><i class="fa '.$icon.'"></i> '.$text.'</a>';
    return $button;
}


function Button1($link,$class,$title,$icon,$target = '') {       
	if ($target !=='') {
       $tar = 'target="'.$target.'"';
    } else {
        $tar = '';
    }

    $button = '<a '.$tar.' href="'.$link.'" class="btn btn-sm btn-'.$class.'" title="'.$title.'" style="margin-right: 5px; "><i class="fa '.$icon.'"></i></a>';
    return $button;
}

function Button2($link,$class,$text,$target = '') {       
	if ($target !=='') {
       $tar = 'target="'.$target.'"';
    } else {
        $tar = '';
    }

    $button = '<a '.$tar.' href="'.$link.'" class="btn btn-sm btn-'.$class.'" style="margin-right: 5px; ">'.$text.'</a>';
    return $button;
}


function ButtonDelete($link) {
    $button = '<a onclick="Delete(\''.$link.'\')" href="#Deleted" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i> Hapus</a>';
    return $button;
}

function ButtonDelete1($link) {
    $button = '<a onclick="Delete(\''.$link.'\')" href="#Deleted" title="Hapus Data" class="btn btn-sm btn-danger" style="margin-right: 5px;"><i class="fa fa-remove"></i></a>';
    return $button;
}

function ButtonBayar($link,$text) {
    $button = '<a onclick="Bayar(\''.$link.'\')" href="#Bayar" title="Konfirmasi Pembayaran Shipment" class="btn btn-sm btn-success" style="margin-right: 5px;"><i class="fa fa-money"></i> '.$text.'</a>';
    return $button;
}
function ButtonTolak($link,$text) {
    $button = '<a onclick="Tolak(\''.$link.'\')" href="#Tolak" title="Tolak Pembayaran" class="btn btn-sm btn-danger" style="margin-right: 5px;"><i class="fa fa-ban"></i> '.$text.'</a>';
    return $button;
}



function is_login() {
	$ci =& get_instance();
	$user=$ci->session->userdata('username');
	$pass=$ci->session->userdata('password');

	if (empty($user) OR empty($pass)) {
	  	redirect(base_url().'Login', 'refresh');
	} else {
		return false;
	}
}

function is_level($level_user) {
	$ci =& get_instance();
	$kategori=$ci->session->kategori;

	if (in_array($kategori, $level_user)) {
	  	return 1;
	} else {
		return 0;
	}
}



function TglID($tgl) {
	if ($tgl == '0000-00-00') {
		return '-';
	} else {
		$date = strtotime($tgl);
    	return date('d-m-Y', $date);  
	}
         
}

function IDTgl($tgl) {
	if ($tgl == '0000-00-00') {
		return '00-00-0000';
	} else {
		$date = strtotime($tgl);
    	return date('Y-m-d', $date);  
	}
         
}

function Rupiah($nilai, $pecahan = 0) {
    return number_format((float)$nilai, $pecahan, ',', '.');     
}

function Rupiah1($nilai, $pecahan = 0) {
    return number_format((float)$nilai, $pecahan, ',', ',');     
}

function ToRomawi($integer)
{
	$integer = intval($integer);
	$result = '';

	$lookup = array('M' => 1000,
	'CM' => 900,
	'D' => 500,
	'CD' => 400,
	'C' => 100,
	'XC' => 90,
	'L' => 50,
	'XL' => 40,
	'X' => 10,
	'IX' => 9,
	'V' => 5,
	'IV' => 4,
	'I' => 1);

	foreach($lookup as $roman => $value){
		$matches = intval($integer/$value);
		$result .= str_repeat($roman,$matches);
		$integer = $integer % $value;
	}

	return $result;
}

function Bulan() {
	$bln = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember',
	);
	return $bln;
}

function NamaBulan($m) {
	$bln = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember',
	);
	return $bln[$m];
}

function Kalender($tanggalDiDb)
{ $bln   = array('');
if (isset($tanggalDiDb)) {
	$date=explode("-",$tanggalDiDb);
}
	
	if ($tanggalDiDb == null){
		$tanggal="-";
	} else if ($date[2] == '00'){
		$tanggal="-";
	}
	else{
		switch($date[1])
		{
			case 1 : $bln=array("Januari");break;
			case 2 : $bln=array("Februari");break;
			case 3 : $bln=array("Maret");break;
			case 4 : $bln=array("April");break;
			case 5 : $bln=array("Mei");break;
			case 6 : $bln=array("Juni");break;
			case 7 : $bln=array("Juli");break;
			case 8 : $bln=array("Agustus");break;
			case 9 : $bln=array("September");break;
			case 10 : $bln=array("Oktober");break;
			case 11 : $bln=array("November");break;
			case 12 : $bln=array("Desember");break;
			default : break;
		}
		$tanggal=$date[2]." ".$bln[0]." ".$date[0];
	}
	return $tanggal;
}

function saldo_pembelian($jmla,$id_utang)
		{
			$ci = &get_instance();
			$jmlcic=0;
			$jmltamcic=0;
			$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='cicil_utang' and tipe=0")->result();
			foreach($cic as $cic)
			{
				$jmlcic=$cic->jml;
			}		
			$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='tambah_utang' and tipe=0")->result();
			foreach($cic as $cic)
			{
				$jmltamcic=$cic->jml;
			}			
			return (($jmla+$jmltamcic)-$jmlcic);
		}

function saldo_penjualan($jmla,$id_utang)
{
	$ci = &get_instance();
	$jmlcic=0;
	$jmltamcic=0;
	$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='cicil_piutang' and tipe=2")->result();
	foreach($cic as $cic)
	{
		$jmlcic=$cic->jml;
	}		
	$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='tambah_piutang' and  tipe=2")->result();
	foreach($cic as $cic)
	{
		$jmltamcic=$cic->jml;
	}			
	return (($jmla+$jmltamcic)-$jmlcic);
}

function saldo_retbeli($jmla,$id_utang)
{
	$ci = &get_instance();
	$jmlcic=0;
	$jmltamcic=0;
	$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='cicil_utang' and tipe=1")->result();
	foreach($cic as $cic)
	{
		$jmlcic=$cic->jml;
	}		
	$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='tambah_utang' and tipe=1")->result();
	foreach($cic as $cic)
	{
		$jmltamcic=$cic->jml;
	}			
	return (($jmla+$jmltamcic)-$jmlcic);
}
function saldo_retjual($jmla,$id_utang)
{
	$ci = &get_instance();
	$jmlcic=0;
	$jmltamcic=0;
	$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='cicil_utang' and tipe=3")->result();
	foreach($cic as $cic)
	{
		$jmlcic=$cic->jml;
	}		
	$cic=$ci->db->query("select sum(jml) as jml from transaksi_barang where id_utang='".$id_utang."' AND jenis='tambah_utang' and  tipe=3")->result();
	foreach($cic as $cic)
	{
		$jmltamcic=$cic->jml;
	}			
	return (($jmla+$jmltamcic)-$jmlcic);
}

function setting_menu($user,$pas)
		{
			$ci=& get_instance();
			// $sql = "select * from table"; 
			// $query = $ci->db->query($sql);
			// $row = $query->result();
			// $sql="SELECT * FROM user WHERE username='$user' AND password='$pas'";
			// $query= $ci->db->query($sql);
			// $row = $query->result();
			$r = $ci->session->userdata('aksesmenu');
			// $data=mysqli_query("select * from user where username='$user' and password='$pas'");
			// $da=mysqli_fetch_array($data);
			// foreach($row as $r){


			// }
			$word=$r;

			$word=explode(",", $word);
			$jword=count($word)-1;
			for($j=0;$j<=$jword;$j++)
			{
				// $tempa=mysql_query("select * from menu where id_menu='".$word[$j]."' order by urut");
				// $tempa = "";
				$tempa = $ci->db->query("SELECT * from menu where id_menu='".$word[$j]."'");
			
				$data = $tempa->result();
				// print_r($data);
				$jum = $tempa->num_rows();
				// $jum=mysql_num_rows($tempa);
				if($jum > 0)
				{
					foreach($data as $dt){}
					$level=$dt->parent;
					$name=$dt->nama;
					$id=$dt->id_menu;
					while($level >= 0)
					{
						if($level != 0 )
						{
							$q_nmp = $ci->db->query("select * from menu where id_menu='".$level."'  order by urut ASC");

							$nmp = $q_nmp->result();
							$q_nmc = $ci->db->query("select * from menu where id_menu='".$id."' AND nama='".$name."'  order by urut ASC");

							$nmc = $q_nmc->result();
							// $nmp=mysql_fetch_array(mysql_query(""));
							// $nmc=mysql_fetch_array(mysql_query(""));
							foreach($nmp as $nmp){

							}
							foreach($nmc as $nmc){

							}
							$namap=$nmp->nama;
							$am[$namap][]=$nmc->nama;
							
							$level=$nmp->id_menu;
							$level=$nmp->parent;
							$name=$nmp->nama;
							$id=$nmp->id_menu;
						}else
							{
								$level_1[]=$name;
								$level=-1;
							}
					}
				}
			}
			$level_1 = array_unique($level_1);
			$remove_null_number = true;
			
			echo menu(0,$h="",$am,$level_1);	
		}

		function menu($parent=0,$hasil,$sub,$lev1)
		{
				if(!empty($lev1))
				{
					$lev1=array_unique($lev1);
					// if($parent==0)
					// {
					// 	$hasil .= '<li class="nav-item has-sub-menu">';
					// }else
					// 	{
					// 		$hasil .= '<ul class="treeview-menu">';
					// 	}
					
				
					foreach($lev1 as $h)
					{
						if(!empty($sub[$h]))
						{
							$icont=icon($h);
							

								$hasil .='<li class="nav-item has-sub-menu">
                    <a class="nav-link" data-toggle="collapse" href="#">
                        <i class="material-icons">'.$icont.'</i>
                        <p>
                            '.$h.'
                            <b class="caret"></b>
                        </p>
                    </a>';
                    $hasil .=' <div class="collapse sub-menu" id="pvr_applications">
									<ul class="nav">';
								
						}else
							{
								
								$link=cari_link_salah($h,$parent);
								$link=base_url().$link;
								
								$hasil .='<li class="nav-item">
				                                <a class="nav-link sub_link" href="'.$link.'">
				                                    <i class="material-icons">keyboard_arrow_right</i>
				                                    <span class="sidebar-normal">'.$h.'</span>
				                                </a>
				                            </li>';
		
							}

						if(!empty($sub[$h]))
						{
							$par=search_parent($h);
							$hasil = menu($par,$hasil,$sub,$sub[$h]);
							$hasil .='</ul></div></li>';
						}

						// $hasil .= "</li>";
					}
					
					// if(!empty($lev1))
					// {
					// 	$hasil .= "</ul33>";
					// }
				}

				return $hasil;	
		}

		function icon($nama)
		{
			if($nama=="Back Office")
			{
				return "work";
			}else
				if($nama=="Master Data")
				{
					return "apps";
				}else
				if($nama=="Transaksi")
				{
					return "shopping_cart";
				}else
					if($nama=="Karyawan")
					{
						return "people";
					}else
					if($nama=="Setting")
					{
						return "settings";
					}else
						if($nama=="Laporan")
						{
							return "list";
						}else
						if($nama=="Report")
						{
							return "list";
						}if($nama=="Laporan Keuangan")
						{
							return "list";
						}else
							{
								return "view_list";
							}
		}

		function search_parent($nama)
		{
			$ci = &get_instance();
			$query=$ci->db->query("select id_menu from menu where nama='".$nama."'");
			$data=$query->result();
			foreach($data as $dt){}
			return $dt->id_menu;
		}

		function cari_link_salah($no,$parent)
		{
			$ci = &get_instance();
			$query=$ci->db->query("select segment1,segment2 from menu where nama='".$no."' and parent='".$parent."' order by urut ASC");

			$data=$query->result();
			foreach($data as $dt){}
			return $dt->segment1."/".$dt->segment2;
		}


		function edit_menu()
		{
			echo edit_menu_user(0,$h="");
		}
		
		function edit_menu_user($parent=0,$hasil)
		{
		$ci = &get_instance();
			$w = $ci->db->query("SELECT * from menu where parent='".$parent."' order by id_menu");
			// print_r($parent);
			if($parent!=0)
			{
				$hasil .= "";
			}

			foreach($w->result() as $h)
			{
				$x=$ci->db->query("SELECT * from menu where parent='".$h->id_menu."' order by id_menu");
				if(($x->num_rows())>0)
				{
					// if($h->parent==0)
					// {
					// 	$hasil .="<div class='col-md-4'><table class='table table-bordered'>";
					// }
					$icont=icon($h->nama);
							// $hasil .='
							// 	<tr><th colspan="2">
							// 		<i style="margin-right:5px" class="fa '.$icont.'"></i>
							// 		<span>'.$h->nama.'</span></th></tr>';


									$hasil .='<div class="col-lg-4">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">

                                '.$h->nama.'
                               
                            </h5>';
                          


				}else
					{
						$cek=cek_status_menu($h->id_menu);
						// $hasil .='<tr><td><i style="margin-right:5px" class="fa fa-file-text-o"></i>'.$h->nama.' </td><td><input name="cek[]" id="cek" value="'.$h->id_menu.'" '.$cek.' type="checkbox"/></td></tr>';

						$hasil .=' <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="cek[]" id="cek" type="checkbox" value="'.$h->id_menu.'" '.$cek.'>
                                            <span class="form-check-sign"></span>
                                            '.$h->nama.'
                                        </label>
                                    </div>';
					}
					
				$hasil =edit_menu_user($h->id_menu,$hasil);
				$hasil .= "";
				if($h->parent==0)
				{
						$hasil .="</div></div></div>";
				}
			}
			if($parent!=0)
			{
				$hasil .= "";
			}
			return $hasil;
		}


		function cek_status_menu($id_menu)
		{
			$ci = &get_instance();
			$menu_user=$ci->db->query("select aksesmenu from user where no='".$ci->uri->segment(3)."' ");
			foreach($menu_user->result() as $menu_user)
			{
				$menu1=$menu_user->aksesmenu;
			}
			
			$akses=explode(",",$menu1);
			$status="";
			foreach($akses as $akses)
			{
					if($akses==$id_menu)
					{
							$status="checked";
					}
			}
			
			return $status;
		}


	
function cetak($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function sukses_message($pesan,$url) {
    echo '<script type="text/javascript">alert("'.$pesan.'"); window.location.href="'.$url.'";</script>';
}

function gagal_message($pesan) {
    echo '<script type="text/javascript">alert("'.$pesan.'"); window.history.back();</script>';
}

function lacakkiriman($idshipment) {
	$ci = &get_instance();
	// $trx = $this->func->getTransaksi($_GET["orderid"],"semua","orderid");
	$trx = $ci->db->query('select * from shipment where id_shipment="'.$idshipment.'" ')->row();
	$ekspedisi = ShowData('ekspedisi_lokal',array('id_ekspedisi' => $trx->ekspedisi), 'nama');

	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "waybill=".$trx->awb_ekspedisi."&courier=".$ekspedisi,
	CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
		"key: 4dc58955e4568ecfb3705b82a7a85f25"
	),
	));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);

	curl_close($curl);

	return $response;
}

function ubahTgl($format, $tanggal="now", $bahasa="id"){
		$en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
	}




