<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		is_login();

	}

	function getbarangnya()
	{

		//if ($ddsup==0){$tbh="";}else{$tbh="and a.suplier='".$ddsup."'";}
			
		$rr = $this->db->query("SELECT * FROM data_barang_pusat ORDER BY `nama` ASC LIMIT 20")->result();
	
		$json = [];
		foreach($rr as $r) {
			// if ($ddsup==0){
			// 	$hrgjual=$r->harga_jual;
			// }else
			// {
			
			
			//$json[] = ['id'=>$r->id."_".$hrgjual."_".$B."_".$sb, 'text'=>$r->kdbrg." - ".addslashes($r->namabrg)];
			$json[] = ['id'=>$r->barcode, 'text'=>$r->barcode. ' - '.addslashes($r->nama)];
		}


		echo json_encode($json);
	}


function getbarang()
	{
		$ddsup=$_GET['ddsup']; 
		$idgol=$_GET['idgol'];
		$tbh="";
		//if ($ddsup==0){$tbh="";}else{$tbh="and a.suplier='".$ddsup."'";}
		if (!isset($_GET['q'])) {
		$rr = $this->db->query("select * from data_barang_pusat limit 20")->result();
		} else {
			$rr = $this->db->query("select * from data_barang_pusat  where (nama LIKE '%".$_GET['q']."%' OR barcode LIKE '%".$_GET['q']."%') order by nama LIMIT 20")->result();
		}
		$json = [];
		foreach($rr as $r) {
			// if ($ddsup==0){
			// 	$hrgjual=$r->harga_jual;
			// }else
			// {
				$hrgjual=$r->harga_beli;
			// }
			
			//$json[] = ['id'=>$r->id."_".$hrgjual."_".$B."_".$sb, 'text'=>$r->kdbrg." - ".addslashes($r->namabrg)];
			$json[] = ['id'=>$r->barcode."_".$hrgjual, 'text'=>$r->barcode. ' - '.addslashes($r->nama)];
		}


		echo json_encode($json);
	}

function getbarang_penjualan()
	{
		$ddsup=$_GET['ddsup']; 
		$idgol=$_GET['idgol'];
		$jenis = $_GET['jen'];
		$tbh="";
		//if ($ddsup==0){$tbh="";}else{$tbh="and a.suplier='".$ddsup."'";}
		if (!isset($_GET['q'])) {
		$rr = $this->db->query("select a.stok,b.nama, b.barcode,b.harga_jual,b.harga_grosir,b.harga_beli from setting_harga_cabang a join data_barang_pusat b on a.id_barang=b.barcode where id_cabang='".$this->session->cabang."' limit 20")->result();
	
		} else {
			$rr = $this->db->query("select a.stok,b.nama, b.barcode,b.harga_jual,b.harga_grosir,b.harga_beli from setting_harga_cabang a join data_barang_pusat b on a.id_barang=b.barcode where id_cabang='".$this->session->cabang."' and (b.nama LIKE '%".$_GET['q']."%' OR b.barcode LIKE '%".$_GET['q']."%') order by b.nama LIMIT 20")->result();
		}
		$json = [];
		foreach($rr as $r) {
			if ($jenis=='Eceran'){
				$hrgjual=$r->harga_jual;
			}else
			{
				$hrgjual=$r->harga_grosir;
			}
			
			//$json[] = ['id'=>$r->id."_".$hrgjual."_".$B."_".$sb, 'text'=>$r->kdbrg." - ".addslashes($r->namabrg)];
			$json[] = ['id'=>$r->barcode."_".$hrgjual."_".$r->stok."_".$r->harga_beli, 'text'=>$r->barcode. ' - '.addslashes($r->nama)];
		}


		echo json_encode($json);
	}

function getbarang_po()
	{
	
		$tbh="";
		
		if($_GET['jen'] == 'ReturGudang') {
		    	$rr = $this->db->query("select a.stok,b.nama, b.barcode from setting_harga_cabang a join data_barang_pusat b on a.id_barang=b.barcode where id_cabang='".$this->session->cabang."' limit 20")->result();
		    	
		} else {
		        $rr = $this->db->query("select * from data_barang_pusat limit 20")->result();
		}
		//if ($ddsup==0){$tbh="";}else{$tbh="and a.suplier='".$ddsup."'";}
		if (!isset($_GET['q'])) {
	      	
		if($_GET['jen'] == 'ReturGudang') {
		    	$rr = $this->db->query("select a.stok,b.nama, b.barcode from setting_harga_cabang a join data_barang_pusat b on a.id_barang=b.barcode where id_cabang='".$this->session->cabang."' limit 20")->result();
		    	
		} else {
		        $rr = $this->db->query("select * from data_barang_pusat limit 20")->result();
		}
		} else {
		    if($_GET['jen'] == 'ReturGudang') {
		     
			$rr = $this->db->query("select a.stok,b.nama, b.barcode from setting_harga_cabang a join data_barang_pusat b on a.id_barang=b.barcode where id_cabang='".$this->session->cabang."' and (nama LIKE '%".$_GET['q']."%' OR barcode LIKE '%".$_GET['q']."%') order by nama LIMIT 20")->result();
		    } else {
		    $rr = $this->db->query("select * from data_barang_pusat  where (nama LIKE '%".$_GET['q']."%' OR barcode LIKE '%".$_GET['q']."%') order by nama LIMIT 20")->result();  
		    }
		}
		$json = [];
		foreach($rr as $r) {
		
			
			//$json[] = ['id'=>$r->id."_".$hrgjual."_".$B."_".$sb, 'text'=>$r->kdbrg." - ".addslashes($r->namabrg)];
			$json[] = ['id'=>$r->barcode."_".$r->stok, 'text'=>$r->barcode. ' - '.addslashes($r->nama)];
		}


		echo json_encode($json);
	}

function getbarang_cabang()
	{
	
		$tbh="";
		//if ($ddsup==0){$tbh="";}else{$tbh="and a.suplier='".$ddsup."'";}
		if (!isset($_GET['q'])) {
		$rr = $this->db->query("select * from setting_harga_cabang where id_cabang='".$this->session->cabang."' limit 20")->result();
		echo $this->db->last_query();
// 		ShowData('accjurnal',array('invoice' => $this->uri->segment(3)), 'id');

		} else {
			$rr = $this->db->query("select * from data_barang_pusat  where (nama LIKE '%".$_GET['q']."%' OR barcode LIKE '%".$_GET['q']."%') order by nama LIMIT 20")->result();
		}
		$json = [];
		foreach($rr as $r) {
		
			
			//$json[] = ['id'=>$r->id."_".$hrgjual."_".$B."_".$sb, 'text'=>$r->kdbrg." - ".addslashes($r->namabrg)];
			$json[] = ['id'=>$r->barcode."_".$r->stok, 'text'=>$r->barcode. ' - '.addslashes($r->nama)];
		}


		echo json_encode($json);
	}


function item_add() {
	$data = $_POST;
		$invoice=$data['invoice']; $data['jam']= date("Y-m-d H:i:s");
		$data = array (
			'invoice' => $_POST['invoice'],
			'kdbrg' => $_POST['kdbrg'],
			'qty' => $_POST['qty'],
			'hrg' => $_POST['hrg'],
			'disc' => $_POST['disc'],
			'jam' => date("Y-m-d H:i:s"),
			'tipe' => $_POST['tipe'],
		);
		$this->db->insert("transaksi_barang_detail",$data);
		$rr = $this->db->query("select * from transaksi_barang_detail where invoice='".$invoice."' order by id asc")->result();
		include "admin_func.php";
	}

function item_hapus() {
	$invoice = $_POST['invoice'];

	$rr = $this->db->query("select * from transaksi_barang_detail where invoice='".$invoice."' order by id asc")->result();

	
		$this->db->where('id', $_POST['id']);
		$this->db->delete('transaksi_barang_detail');
	
		include "admin_func.php";
	}


function item_detil() {
	$item_id = $_POST['id'];
	$rr = $this->db->query("select a.*, a.qty*a.hrg-a.qty*a.hrg*a.disc/100 as jml, b.namabrg, c.satuan from transaksi_barang_detail a join barang b on b.kdbrg=a.kdbrg left join barang_satuan c on c.id=b.satuan where a.id='".$item_id."'")->result();
	foreach($rr as $r) {}
	echo json_encode($r);
}

function item_update() {
		$invoice=$_POST['invoice'];
		$id=$_POST['id'];
		$data = array (
			'qty' => $_POST['qty'],
			'hrg' => $_POST['hrg'],
			'disc' => $_POST['disc'],
		);
		$this->db->where("id",$id);
		$this->db->update("transaksi_barang_detail",$data);
		$rr = $this->db->query("select * from transaksi_barang_detail where invoice='".$invoice."' order by id asc")->result();
		include "admin_func.php";
}

}