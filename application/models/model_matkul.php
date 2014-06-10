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
	
    function Lihat_Soal($id_mk)
        {
            $tampil = $this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where id_matkul='$id_mk'  group by 
            tbl_soal.no_soal order by id_soal");
            return $tampil;
        }

    function Judul_MK($id_mk)
        {
            $matkul=$this->db->query("SELECT nama_matkul FROM tbl_matkul INNER JOIN tbl_soal ON tbl_matkul.id = tbl_soal.id_matkul INNER JOIN tbl_namasoal ON tbl_soal.no_soal = tbl_namasoal.id_namasoal  where id='$id_mk' group by nama_matkul");
            return $matkul;
        }

    function Tampilkan_Soal($id_mk,$no_soal)
        {
            $query_total=$this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where 
            id_matkul='$id_mk' AND no_soal='$no_soal' order by RAND()");
            return $query_total;
        }

        function Hitung_Hasil($id_mk,$no_soal)
        {
            $query=$this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where 
            id_matkul='$id_mk' AND no_soal='$no_soal'");
            return $query;
        }

        function Simpan_Hasil($datainput)
        {
            $this->db->insert('tbl_hasil',$datainput);
        }




}  