<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	}

	public function Index()
	{	

		if (isset($_POST['login'])) {
			$data = array(
				'username' => $this->input->post('username',TRUE),
				'password' => md5($this->input->post('password',TRUE)),
				
				);

			
			
			$query = $this->db->get_where('user',$data);
			$row = $query->row();

			if ($query->num_rows() == 1) {

				$data = array(
					'username' => $this->input->post('username',TRUE),
					'password' => md5($this->input->post('password',TRUE)),
					'nama' => $row->nama,
					'kategori' => $row->kategori,
					
					'userid' => $row->no,
					
					);

				
				$this->session->set_userdata($data);
				
				echo "<script>window.location.href='".base_url()."Dashboard'</script>";

			} else {
				echo "<script>alert('LOGIN GAGAL'); window.history.back()</script>";
			}

		} else {
			$user=$this->session->username;
			$pass=$this->session->password;

			$data = array(
				'username' => $user,
				'password' => $pass
				);

			$query = $this->db->get_where('user',$data);
			$row = $query->row();

			if ($query->num_rows() > 0) {

				$data = array(
					'username' => $user,
					'password' => $pass,
					'nama' => $row->nama,
					'kategori' => $row->kategori,
					'userid' => $row->no,
					
					);


				$this->session->set_userdata($data);
				
				echo "<script>window.location.href='".base_url()."Dashboard'</script>";

			} else {
				$this->load->view('Login');
			}
			
		}
		
	}

	public function Logout()
	{	
		$logout = $this->session->sess_destroy();
		echo '<script src="'.base_url().'assets/plugins/jquery/jquery-3.2.1.min.js"></script>';
		echo '<script src="'.base_url().'assets/plugins/sweetalert/sweetalert.min.js"></script>';
		echo '<link type="text/css" href="'.base_url().'assets/plugins/sweetalert/sweetalert.css">';

		echo '<script type="text/javascript">
			  	$(function() {
			  		swal("BERHASIL LOGOUT!", "Anda Berhasil Mengahiri Sesi", "success");
			  	});
			  	window.setTimeout(
		          function(){
		            location.href = "'.base_url().'/Login";
		          },
		          1500
		        );
			  </script>';
	}


	//USER
	public function Users()
	{	
		is_login();
		PVR('Auth/Users');

	}

	public function Usersjson()
	{	
		is_login();
		$req= $_REQUEST;

		$field = 'no,username,password,kategori';
		$columns = explode(',',$field);

		$sql = "SELECT * FROM user";
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
				$sql.= $s." ".$value." LIKE '".$req['search']['value']."%'".$t." ";
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
			$nestedData[] = $row->username;
			$nestedData[] = $row->password;
			$nestedData[] = $row->kategori;

			$btn = '';
		
			$btn .= Button(base_url().$this->uri->segment(1)."/Users_edit/".$row->no,'warning','fa-edit','EDIT');
			$btn .= ButtonDelete(base_url().'Login/Users_hapus/'.$row->no);
			$nestedData[] = $btn;

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

	public function Users_add()
	{	
		is_login();

		if ($this->input->post('send') == '') {
			PVR('Auth/Users_add');
		}  else {

			if($this->input->post('username') != '') {
		$cek = $this->db->get_where('user',array('username' => $this->input->post('username',TRUE)));

		if ($cek->num_rows() > 0) {
			echo -1;
			return false;
		}

		if($this->input->post('kategori') == 'superadmin') {
			$akses = '10,55,56,57,58,59,61,62,63,64,65,66,67,68,69,70,71';
		} else {
			$akses = '59,61,63,65,66,67,68,69,70,71,72';
		}
	
		$data = array(
				'username' => $this->input->post('username',TRUE),
				'password' => md5($this->input->post('password',TRUE)),
				'kategori' => $this->input->post('kategori',TRUE),
				'id_cabang' => $this->input->post('id_cabang',TRUE),
				'aksesmenu' => $akses
		); 
	
			// print_r($data); return false;
		$this->db->insert('user',$data);

			$url=base_url()."Login/Users";
		warning_message("DATA BERHASIL DISIMPAN",$url);

	} else {
		$url=base_url()."Login/Users_add";
		warning_message("Ada Form yang belum diisi",$url); 
	}
}
}

	public function Users_edit() {
	if ($this->input->post('send') == '') {

			$data['records'] = $this->db->get_where('user', array('no' => $this->uri->segment(3)));
			PVR('Auth/Users_edit', $data);
		} else {

			if($this->input->post('send') != '') {
				$data = array(
				'username' => $this->input->post('username',TRUE),
				'password' => md5($this->input->post('password',TRUE)),
				'kategori' => $this->input->post('kategori',TRUE),
				'id_cabang' => $this->input->post('id_cabang',TRUE),
				);
			

			// print_r($data);
			$this->db->where(array('no' => $this->input->post('id',TRUE)));
			$this->db->update("user",$data);

			$url=base_url()."Login/Users";
					warning_message("DATA BERHASIL DISIMPAN",$url);
				

			} 
		}
		
	}

	public function Users_hapus()
	{	
		is_login();
		$id = $this->uri->segment(3);
		$this->db->delete('user',array('no' => $id));

		if ($this->db->affected_rows()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}

	public function GantiPassword()
	{	
		is_login();
		if (isset($_POST['save'])) {
			
			$data = array(
				'password' => md5($this->input->post('passbaru',TRUE))
				 );

			if ($this->input->post('passbaru') !== $this->input->post('passbaru')) {
				echo -2;
				return false;
			}
			$cek = $this->db->get_where('users',array('username' => $this->session->userdata('username'),'password' => md5($this->input->post('passlama',TRUE))));

			if ($cek->num_rows() == 0) {
				echo -1;
				return false;
			} else {
				$this->db->where('username',$this->session->userdata('username'));
				
				
				$update = $this->db->update('users',$data);

				if ($this->db->trans_status() === TRUE) {
					echo 1;
				} else {
					echo 0;
				}
			}

			
		} else {
			PVR('Auth/GantiPassword');

		}
		
	}

	

	public function AksesMenu() {
	if ($this->input->post('send') == '') {

			$data['records'] = $this->db->get_where('user', array('no' => $this->uri->segment(3)));
			PVR('Auth/Akses_menu', $data);
		} else {

	
		$a = $this->input->post('cek[]',TRUE);
		$s = implode(',', $a);
				$data = array(
			
				'aksesmenu' => $s,
				);
			

			// print_r($data); return false;
			$this->db->where(array('no' => $this->input->post('id',TRUE)));
			$this->db->update("user",$data);

			$url=base_url()."Login/Users";
					warning_message("DATA BERHASIL DISIMPAN",$url);
				

			
		}
		
	}



}