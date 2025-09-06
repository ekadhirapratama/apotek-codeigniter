<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->library('upload');
	}


	//Obat
	function getobat()
	{
        
		$akun_b = $this->db->query("select * from stok where nama_obat='".$_GET['id']."' ")->row_array();
	
		$satuan = $this->db->query("select * from satuan where id='".$akun_b['satuan'] ."' ")->row_array();
		$data_akun = array(
			'satuan' => $satuan['nama'],
			'qty'	 => $akun_b['qty']
		);


		echo json_encode($data_akun);
	}

	function Index() {
		PVR('Transaksi/Data');
	}
	
	public function TransaksiJson() {

		$req= $_REQUEST;

		$field = 'a.id,b.nama,b.nama,jumlah';
		$columns = explode(',',$field);

// 		$sql = "SELECT a.*,b.nama AS nama_pasien,c.nama_obat FROM transaksi a JOIN pasien b ON a.id_pasien=b.id JOIN obat c ON a.id_obat=c.id";
        $sql = "SELECT a.*,b.nama AS nama_pasien FROM transaksi a JOIN pasien b ON a.id_pasien=b.id ";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT a.*,b.nama AS nama_pasien FROM transaksi a JOIN pasien b ON a.id_pasien=b.id WHERE 1=1 ";

		if( !empty($req['search']['value']) ) {
			$p = 0;
			foreach ($columns as $key => $value) {
				$p++;
				if ($p==1) { $s = 'AND ('; } else { $s = 'OR'; }
				if ($p==COUNT($columns)) { $t = ')'; } else { $t = '';}
				$sql.= $s." ".$value." LIKE '%".$req['search']['value']."%'".$t." ";
			}
		}


		$query=$this->db->query($sql);
		$totalFiltered = $query->num_rows();

		$sql.="ORDER BY ". $columns[$req['order'][0]['column']]." ".$req['order'][0]['dir']." LIMIT ".$req['start']." ,".$req['length']." ";
	
		$query=$this->db->query($sql);

		$data = array();
		$no = 0+$req['start'];
		foreach ($query->result() as $row)
		{	
			$no++;
			$nestedData=array();

			$nestedData[] = $no;
			
			$nestedData[] = $row->nama_pasien;
			$obat = $this->db->get_where('detail_obat', array('id_transaksi'=> $row->id));
			
			$brg = '';
			$c=1;
			foreach ($obat->result() as $bar) {
				$brg .= $c++.'. '.ShowData('obat',array('id' => $bar->id_obat),'nama_obat').' ('.$bar->jumlah.')<br>';

			}


			$nestedData[] = $brg;
		
		
			$nestedData[] = TglID($row->tgl_transaksi);
	

			$button = '';
	        if($this->session->kategori == 'superadmin') {
			$button .= ButtonDelete(base_url().'Transaksi/HapusTransaksi/'.$row->id);
	        }
			$nestedData[] = $button;

			$data[] = $nestedData;
		}

		$json_data = array(
					"draw"            => intval( $req['draw'] ),
					"recordsTotal"    => intval( $totalData ),
					"recordsFiltered" => intval( $totalFiltered ), 
					"data"            => $data
					);

		echo json_encode($json_data);
	}


    public function TambahTransaksi()
	{	
	    $data2 = array(
	        	'id_pasien' 		=> inputnya('id_pasien'),
	        	'tgl_transaksi' 	=> date('Y-m-d'),
	        );
	        
	    $this->db->insert('transaksi',$data2);    
	    
	    $f=0;
	    $last_id = $this->db->insert_id();
		foreach($_POST['id_obat'] as $p) {
		    
	    $data = array(
	            'id_transaksi'      => $last_id,
	        	'id_obat' 			=> inputnya('id_obat')[$f],
	        	'jumlah' 			=> inputnya('jumlah')[$f],
	        	
	    );
	    
	   

 		$this->db->insert('detail_obat',$data);
	  
		$stok = $this->db->get_where('stok',array('nama_obat' => inputnya('id_obat')[$f]))->row()->qty;
	
     	$stoknya = $stok-inputnya('jumlah')[$f];

     	$data1['qty'] = $stoknya;
     	
        $this->db->where(array('nama_obat' => inputnya('id_obat')[$f]));
		$this->db->update('stok',$data1);
		
        $f++;
		}
	
		
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	}

	// public function EditTransaksi()
	// {	

	// 	if (isset($_POST['update'])) {
			
		
	//         $data = array(
	//         	'nama_obat' 		=> inputnya('nama_obat'),
	//         	'satuan' 		=> inputnya('satuan'),
	//         	'qty' 	=> inputnya('qty'),
	        

	//         );

	       
	// 		$this->db->where(array('id' => $_POST['id']));
	// 		$this->db->update('obat',$data);
			
	// 		if ($this->db->affected_rows()) {
	// 			echo 1;
	// 		} else {
	// 			echo 0;
	// 		}
	// 	} else {
	// 		$query = $this->db->get_where('obat',array('id' => $_POST['id']));
	// 		echo json_encode($query->row());
	// 	}
		
	// }

    public function HapusTransaksi()
	{	

		$id = $this->uri->segment(3); 
		
		$jumlah  = $this->db->get_where('detail_obat',array('id_transaksi' => $id))->result_array();
		foreach($jumlah as $j) {
		$stok = $this->db->get_where('stok',array('nama_obat' => $j['id_obat']))->row_array()['qty'];
	
     	$stoknya = $stok+$j['jumlah'];
     	
     	$data1['qty'] = $stoknya;
     	
     	$this->db->where(array('nama_obat' => $j['id_obat']));
		$this->db->update('stok',$data1);
		}
	
	

     			
     	

		$this->db->delete('transaksi',array('id' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}
	
	function get_obat()
	{
	

		$json = [];

	    $this->db->order_by('nama_obat','ASC');
	    $this->db->select('a.qty,b.id,b.nama_obat,c.nama as nama_satuan');
	    $this->db->from('stok a');
	    $this->db->join('obat b', 'a.nama_obat=b.id');
	    $this->db->join('satuan c','a.satuan=c.id');
		$rr = $this->db->get();
	   
		foreach($rr->result() as $r) {
		
			$json[] = ['id'=>$r->id, 'text'=>addslashes($r->nama_obat).' ('.addslashes($r->nama_satuan.')')];
		}


		echo json_encode($json);
	}


}
