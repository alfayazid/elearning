<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

	class Model_matkul extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
  

    public function tampil_matkul(){
      return $this->db->query("select * from tbl_matkul ")->result();
    }

		
  
  	function get_matkul_detail($id){
        return $this->db->query("select * from tbl_matkul where id=$id ")->result();
    }

    function update_matkul($id,$data){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_user',$data);
        return $query;
    }
	}  