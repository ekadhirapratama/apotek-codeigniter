<?php
if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem !! ');

class Voucher_model extends CI_Model{
    public function __construct(){
      $this->load->database();	
    }


    	// GET VOUCHERs
	function getVoucher($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("diskon");

		if($what == "semua"){
			if($res->num_rows() == 0){ 
				$result = array(0); 
			}
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = 0;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}
 }
