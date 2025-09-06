<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_login();
	}


	//PASIEN
	function PasienData() {
		PVR('PasienData/Pasien');
	}
	
	

	public function PasienJson() {

		$req= $_REQUEST;

		$field = 'id_kategori,nama';
		$columns = explode(',',$field);

		$sql = "SELECT * FROM pasien";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT * FROM pasien WHERE 1=1 ";

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
			$nestedData[] = $row->nomor;
			$nestedData[] = $row->nama;
			$nestedData[] = $row->nik;
			$nestedData[] = $row->alamat;
			$nestedData[] = $row->foto;
			

			$button = '';
			$button = Button('javascript:Edit('.$row->id.')','warning','fa-edit','EDIT');
			$button .= ButtonDelete(base_url().'MasterData/HapusPasien/'.$row->id);
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


    public function TambahPasien()
	{	
		$data = array_merge($_POST);

		$qcek = $this->db->get_where('kategori',array('nama' => $_POST['nama']));
		if ($qcek->num_rows() > 0 ) {
			echo -1;
			return false;
		}

        $insert = $this->db->insert("kategori",$data);

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	}

	public function EditPasien()
	{	

		if (isset($_POST['update'])) {
			
			$data = array_merge($_POST);
			unset($data['update']);
			unset($data['id']);

			$this->db->where(array('id_kategori' => $_POST['id']));
			$this->db->update('kategori',$data);

			if ($this->db->affected_rows()) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$query = $this->db->get_where('kategori',array('id_kategori' => $_POST['id']));
			echo json_encode($query->row());
		}
		
	}

    public function HapusPasien()
	{	

		$id = $this->uri->segment(3); 
		$this->db->delete('kategori',array('id_kategori' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}

}
