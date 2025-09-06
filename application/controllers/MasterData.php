<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterData extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->library('upload');
	}

	//Satuan
	function Satuan() {
		PVR('Master/Satuan');
	}
	
	public function SatuanJson() {

		$req= $_REQUEST;

		$field = 'id,nama';
		$columns = explode(',',$field);

		$sql = "SELECT * FROM satuan";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT * FROM satuan WHERE 1=1 ";

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
			
			$nestedData[] = $row->nama;
			

			$button = '';
			if($this->session->kategori == 'superadmin') {
			$button = Button('javascript:Edit('.$row->id.')','warning','fa-edit','EDIT');
			$button .= ButtonDelete(base_url().'MasterData/HapusSatuan/'.$row->id);
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


    public function TambahSatuan()
	{	

	      $data = array(
	        	'nama' 		=> inputnya('nama'),
	        	
	        );

	     
 			$this->db->insert('satuan',$data);
     

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	}

	public function EditSatuan()
	{	

		if (isset($_POST['update'])) {
			
		
	        $data = array(
	        	'nama' 		=> inputnya('nama'),
	          );

	       
			$this->db->where(array('id' => $_POST['id']));
			$this->db->update('satuan',$data);
			
			if ($this->db->affected_rows()) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$query = $this->db->get_where('satuan',array('id' => $_POST['id']));
			echo json_encode($query->row());
		}
		
	}

    public function HapusSatuan()
	{	

		$id = $this->uri->segment(3); 
		

		$this->db->delete('satuan',array('id' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}

	//Obat
	function Obat() {
		PVR('Master/Obat');
	}
	
	public function ObatJson() {

		$req= $_REQUEST;

		$field = 'id,nama_obat,id';
		$columns = explode(',',$field);

		$sql = "SELECT * FROM obat";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT * FROM obat WHERE 1=1 ";

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
			
			$nestedData[] = $row->nama_obat;
		
			$button = '';
			if($this->session->kategori == 'superadmin') {
			$button = Button('javascript:Edit('.$row->id.')','warning','fa-edit','EDIT');
			$button .= ButtonDelete(base_url().'MasterData/HapusObat/'.$row->id);
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


    public function TambahObat()
	{	

	      $data = array(
	        	'nama_obat' 		=> inputnya('nama_obat'),
	        );

	     
 			$this->db->insert('obat',$data);
     

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	}

	public function EditObat()
	{	

		if (isset($_POST['update'])) {
			
		
	        $data = array(
	        	'nama_obat' 		=> inputnya('nama_obat'),
	        
	        );

	       
			$this->db->where(array('id' => $_POST['id']));
			$this->db->update('obat',$data);
			
			if ($this->db->affected_rows()) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$query = $this->db->get_where('obat',array('id' => $_POST['id']));
			echo json_encode($query->row());
		}
		
	}

    public function HapusObat()
	{	

		$id = $this->uri->segment(3); 
		

		$this->db->delete('obat',array('id' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}
	
	//Stok Obat
	function Stok() {
		PVR('Master/Stok');
	}
	
	public function StokJson() {

		$req= $_REQUEST;

		$field = 'a.id,b.nama_obat,c.nama,qty,a.id';
		$columns = explode(',',$field);

		$sql = "SELECT a.*,b.nama_obat AS obat,c.nama AS nama_satuan FROM stok a JOIN obat b ON a.nama_obat=b.id JOIN satuan c ON a.satuan=c.id";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT a.*,b.nama_obat AS obat,c.nama AS nama_satuan FROM stok a JOIN obat b ON a.nama_obat=b.id JOIN satuan c ON a.satuan=c.id WHERE 1=1 ";

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
			
			$nestedData[] = $row->obat;
			$nestedData[] = $row->nama_satuan;
			$nestedData[] = $row->qty;
	

			$button = '';
			if($this->session->kategori == 'superadmin') {
			$button = Button('javascript:Edit('.$row->id.')','warning','fa-edit','EDIT');
			$button .= ButtonDelete(base_url().'MasterData/HapusStok/'.$row->id);
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


    public function TambahStok()
	{	
	    
	       $stok = $this->db->get_where('stok',array('nama_obat' => inputnya('nama_obat'), 'satuan' => inputnya('satuan')));
	       
	       if($stok->num_rows()>0) {
	           
	           $data = array(
	        	'nama_obat' 		=> inputnya('nama_obat'),
	        	'satuan' 	    	=> inputnya('satuan'),
	        	'qty' 	            => inputnya('qty')+$stok->row()->qty,
	   
	        );
	        
	        $this->db->where(array('nama_obat' =>inputnya('nama_obat'),'satuan' => inputnya('satuan')));
			$this->db->update('stok',$data);
	        
	       } else {
	           
	      $data = array(
	        	'nama_obat' 		=> inputnya('nama_obat'),
	        	'satuan' 	    	=> inputnya('satuan'),
	        	'qty' 	            => inputnya('qty'),
	   
	        );
	        
 			$this->db->insert('stok',$data);
	        
	       }

	     

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	}

	public function EditStok()
	{	

		if (isset($_POST['update'])) {
			
		
	        $data = array(
	        	'nama_obat' 		=> inputnya('nama_obat'),
	        	'satuan' 	    	=> inputnya('satuan'),
	        	'qty' 	            => inputnya('qty'),
	        

	        );

	       
			$this->db->where(array('id' => $_POST['id']));
			$this->db->update('stok',$data);
			
			if ($this->db->affected_rows()) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$query = $this->db->get_where('stok',array('id' => $_POST['id']));
			echo json_encode($query->row());
		}
		
	}

    public function HapusStok()
	{	

		$id = $this->uri->segment(3); 
		

		$this->db->delete('stok',array('id' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}
	
	//Pasien
	function Pasien() {
	
		PVR('Master/Pasien');
	
	}
	
	public function PasienJson() {

		$req= $_REQUEST;

		$field = 'id,nomor,nama,nik,foto';
		$columns = explode(',',$field);

		$huruf = $this->uri->segment(3);

		$sql = "SELECT * FROM pasien WHERE 1=1 AND status='".$huruf."' ";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT * FROM pasien WHERE 1=1 AND status='".$huruf."' ";

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
			$nestedData[] = $row->no_bpjs;
			$nestedData[] = $row->alamat;
	
			if ($row->foto !== '') {
						 
			$foto = '<img src="'.base_url().'upload/'.$row->foto.'" class="img img-thumbnail img-responsive" width="100px">';
			} else {
			$foto = '-';
			}
			$nestedData[] = $foto;
			
            
			$button = '';
			if($this->session->kategori == 'superadmin') {
			$button = Button('javascript:Edit('.$row->id.')','warning','fa-edit','EDIT');
			$button .= ButtonDelete(base_url().'MasterData/HapusPasien/'.$row->id);
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


     public function TambahPasien()
	{	

			if (isset($_POST['update'])) {

			$namanya = substr(inputnya('nama'), 0,1);
			$nama_kapital = strtoupper($namanya);
			// echo inputnya('status');
			 if($nama_kapital!=inputnya('status')) {
			 	echo -2;
			 	return false;
			 }	

			$config['upload_path'] = './upload/';  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $config['encrypt_name'] = TRUE; 
            $this->load->library('upload');  
            $this->upload->initialize($config);
           if (!$this->upload->do_upload('foto')) {
                	$foto = '';
			    	// $this->upload->display_errors();
			    } else {
		    	 $data = $this->upload->data();  
	        	 $foto = $data['file_name'];
		      	 $config['image_library'] = 'gd2';  
                 $config['source_image'] = './upload/'.$data["file_name"];  
                 $config['create_thumb'] = FALSE;  
                 $config['maintain_ratio'] = FALSE;  
                 $config['quality']= '70%';
                 $config['width']= 600;
                 $config['height']= 600;
                 $config['new_image'] = './upload/'.$data["file_name"];  
                 $this->load->library('image_lib', $config);  
                 $this->image_lib->resize();  

			    }

			   


	        $data1=array(
	        	'nomor' 	=> inputnya('nomor'),
	        	'nama' 		=> inputnya('nama'),
	        	'nik' 		=> inputnya('nik'),
	        	'no_bpjs' 		=> inputnya('no_bpjs'),
	        	'alamat' 	=> inputnya('alamat'),
	        	'foto'		=>  $foto,
	        	'status'	=> inputnya('status'),

	        );

	     
 			$this->db->insert('pasien',$data1);
     

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	} else {
	        $this->db->select('nomor');
			$this->db->order_by('id','DESC');
			$query = $this->db->get_where('pasien',array('status' => $_POST['huruf']));
			if($query->num_rows() > 0) {
			$this->db->select('nomor');
			$this->db->order_by('id','DESC');
			$query1 = $this->db->get_where('pasien',array('status' => $_POST['huruf']))->row()->nomor;
			} else {
			$query1='0';
			}
			$data['datanya'] = $query1;
			echo json_encode($data);
		}

	}

	public function EditPasien()
	{	

		if (isset($_POST['update'])) {
			
			$data1 = array_merge($_POST);
			unset($data1['update']);
			unset($data1['id']);

			$config['upload_path'] = './upload/';  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $config['encrypt_name'] = TRUE; 
            $this->load->library('upload');  
            $this->upload->initialize($config);
           if (!$this->upload->do_upload('foto')) {
                	// $foto = '';
			    	$this->upload->display_errors();
			    } else {
		    	 $data = $this->upload->data();  
	        	 $foto = $data['file_name'];
		      	 $config['image_library'] = 'gd2';  
                 $config['source_image'] = './upload/'.$data["file_name"];  
                 $config['create_thumb'] = FALSE;  
                 $config['maintain_ratio'] = FALSE;  
                 $config['quality']= '70%';
                 $config['width']= 600;
                 $config['height']= 600;
                 $config['new_image'] = './upload/'.$data["file_name"];  
                 $this->load->library('image_lib', $config);  
                 $this->image_lib->resize();  

			    }

	       
			$this->db->where(array('id' => $_POST['id']));
			$this->db->update('pasien',$data1);
			
			if ($this->db->affected_rows()) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$query = $this->db->get_where('pasien',array('id' => $_POST['id']));
			echo json_encode($query->row());
		}
		
	}

    public function HapusPasien()
	{	

		$id = $this->uri->segment(3); 
		$gbr = $this->db->get_where('pasien', array('id' => $this->uri->segment(3)))->row_array();
		
	if($gbr['foto'] !='') {
		    	unlink('upload/'.$gbr['foto']);
		}

		$this->db->delete('pasien',array('id' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}
	
	//USER
	public function User() {
	    PVR('Auth/Users');
	}
	public function UserJson() {

		$req= $_REQUEST;

		$field = 'no,nama,kategori';
		$columns = explode(',',$field);

		$sql = "SELECT * FROM user WHERE 1=1 ";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;

		$sql = "SELECT * FROM user WHERE 1=1 ";

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
			$nestedData[] = $row->nama;
			$nestedData[] = $row->kategori;
			$nestedData[] = $row->username;
			
			

			$button = '';
			if($this->session->kategori == 'superadmin') {
			$button = Button('javascript:Edit('.$row->no.')','warning','fa-edit','EDIT');
			$button .= ButtonDelete(base_url().'MasterData/HapusUser/'.$row->no);
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


    public function TambahUser()
	{	
		$data = array_merge($_POST);

		$qcek = $this->db->get_where('user',array('username' => $_POST['username']));
		if ($qcek->num_rows() > 0 ) {
			echo -1;
			return false;
		}
		
	    unset($data['password']);
		$data['password'] = md5($_POST['password']);
        $insert = $this->db->insert("user",$data);

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}

	}

	public function EditUser()
	{	
		is_login();
		if (isset($_POST['update'])) {
			
			$data = array_merge($_POST);
			unset($data['update']);
			unset($data['password']);
            unset($data['id']);
			if ($_POST['password'] != '') {
				unset($data['password']);
				$data['password'] = md5($_POST['password']);
			}

			$this->db->where('no',$_POST['id']);
			$update = $this->db->update('user',$data);
		

			if ($this->db->trans_status() === TRUE) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$query = $this->db->get_where('user',array('no' => $_POST['id']));
			echo json_encode($query->row());

		}
		
	}


    public function HapusUser()
	{	

		$id = $this->uri->segment(3); 
		$this->db->delete('user',array('no' => $id));
                                                                                
		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}



}
