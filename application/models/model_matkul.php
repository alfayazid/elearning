<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

	class Model_matkul extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
  

    public function tampil_matkul(){
      return $this->db->query("select `tbl_matkul`.`nama_matkul` AS `nama_matkul`,`tbl_matkul`.`enroll` AS `enroll`,`tbl_user`.`nama` AS `nama`,`tbl_matkul`.`id` AS `id` from (`tbl_matkul` join `tbl_user` on((`tbl_user`.`id` = `tbl_matkul`.`id_dosen`)))")->result();
    }

    
    public function tampil_matkul_dosen($user_id){
        
        return $this->db->query("select * from tbl_matkul where id_dosen=$user_id");
    }

		
  
  	function get_matkul_detail($id){
        return $this->db->query("select * from tbl_matkul where id=$id ")->result();
    }

     function insert_matkul($data){
        $query = $this->db->insert('tbl_matkul',$data);
        return $query;
    }

    function update_matkul($id,$data){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_user',$data);
        return $query;
    }
	}  