<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Created on Aug 26, 2011 by Damiano Venturin @ Squadra Informatica

class Rest_Client extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		
		// Load the configuration file
		$this->load->config('rest');
		
		// Load the rest client
		$this->load->spark('restclient/2.0.0');		
		$this->rest->initialize(array('server' => $this->config->item('rest_server')));
		//$this->rest->initialize(array('server' => 'http://localhost/codeigniter-rest-example/index.php/rest_server/'));
	}
	
	public function index()
	{
		//$data['methods_list'] = $this->displayAPI();
		//$this->load->view('restDoc',$data);
		if($this->session->userdata('logged_in')!="") {
			if($this->session->userdata('logged_in')!="" && $this->session->userdata('status')=="Aktif") {				
			$this->session->set_flashdata('akun', 'Akun anda belum aktif');
			redirect('rest_client/list_user');
			}

			else if($this->session->userdata('logged_in')!="" && $this->session->userdata('status')=="Tidak Aktif") {				
			$this->session->set_flashdata('akun', 'Akun anda belum aktif');
			redirect('rest_client/logout');
			}
		}

		else if ($this->session->userdata('logged_in')=="") {
			redirect('rest_client/login');
		}
	}
	
	/**
	 * 
	 * Produces a human readable list of methods available on the server side
	 */
	public function displayAPI()
	{
		//get methods list
        $methods_html = '';
        $methods = (array) $this->rest->get('API/format/json');
        
        //show the docstring for the method
        if(count($methods['functions'])>0)
        {
        	foreach ( $methods['functions'] as  $method) {	    
				if(empty($method->docstring))
				{
					$methods_html .= '<dt>'.$method->function.'</dt><dd>No description available</dd>';
				} else {
					$methods_html .= '<dt>'.$method->function.'</dt><dd>'.$method->docstring.'</dd>';
				}
        	}	
        	$methods_html .= '</dl>';
        }
        	
		echo '<pre>';
		print_r($methods);
		echo '</pre>';         

       	return $methods_html;				
	}		

	/**
	 * 
	 * Access API "users" using GET through Phil's rest client
	 */



	/**
	FUNGSI REGISTER
	*/


	public function form_register(){ 
		//$this->load->view('barang/script'); 
		$this->load->view('form_register'); 
	}   

	/* * fungsi untuk menambahkan brang ke data base */ 
	
	public function register_rest(){ 
		$data = array( 	'level' => $this->input->post('level'), 
						'nama' => $this->input->post('nama'), 
						'username' => $this->input->post('username'), 
						'password' => $this->input->post('password'),
						'status' => $this->input->post('status')
						
					); 
		$query = $this->rest->post('register/mboh/1/format/php',$data); 
		if($query) { 
			redirect('rest_client/login'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	/**
	FUNGSI ADMIN
	*/

	public function proses_ubah(){ 
		$id = $this->input->post('id');   
		$data = array('status' => $this->input->post('status')); 
		
		$query = $this->rest->post('ubah/id/'.$id.'/format/php',$data); 
		if($query) { 
			//echo $query; 
			
			redirect('rest_client/list_user'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	public function list_user() { 
		$query =$this->rest->get('alluser/format/json');
		$data['user']=$query; 
			
		
		//$this->load->view('dashboard',$data); 

		$data['output']	=$this->load->view('list_user',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}


	public function detail_user($id){ 
		$data['user'] = $this->rest->get('user/id/'.$id.'/format/json'); 
		$data['output']	=$this->load->view('detail_user',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}   

	
	
	public function proses_edit_user(){ 

		$id = $this->input->post('id');   
		$data = array('status' => $this->input->post('status'));   
		if($query = $this->rest->post('update_user/id/'.$id.'/format/php',$data))
		{ 
			
			redirect('rest_client/list_user');
		} 
		else 
			{ 
				echo "<script>alert('Gagal coy'); window.close ();</script>"; 
			}   
	}


	public function tampil_matkul() { 
		$query =$this->rest->get('matkul/format/json');
		$data['matkul']=$query; 
		$data['output']	=$this->load->view('list_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}



	public function tambah_matkul(){ 
		
		$data['judul'] = 'Tambah Mata Kuliah';
		$data['dosen'] = $this->model_user->tampil_dosen();
		$data['output']	=$this->load->view('tambah_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
		
	}   

	/* * fungsi untuk menambahkan brang ke data base */ 
	
	
	public function proses_tambah_matkul(){ 
		$data = array( 	'nama_matkul' => $this->input->post('nama_matkul'), 
						'enroll' => $this->input->post('enroll')
						
					); 
		$query = $this->rest->post('tambah_matkul/coba/1/format/php',$data); 
		if($query) { 
			redirect('rest_client/tampil_matkul'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	/**
	FUNGSI LOGIN
	**/

	public function login(){ 
		
		if($this->session->userdata('logged_in')=="") {
			$this->load->view('login'); 
		}

		else if($this->session->userdata('logged_in')!="") {
			redirect('rest_client');
		}
	}   

	public function proses_login(){ 
		$data = array( 	
						'username' => $this->input->post('username'), 
						'password' => $this->input->post('password'), 
						
					); 

		$query = $this->rest->post('login/format/php',$data); 
		$user = $this->input->post('username');
		$login = $this->db->query("select * from tbl_user where username='$user'");
          if($login->num_rows()>0)
            {
            foreach($login->result() as $qad)
            {
              $sess_data['logged_in'] = 'yesGetMeLoginBaby';
              $sess_data['id_user'] = $qad->id;
              $sess_data['nama'] = $qad->nama;
              $sess_data['user'] = $qad->username;
              $sess_data['password'] = $qad->password;
              $sess_data['level'] = $qad->level;
              $sess_data['status'] = $qad->status;
              $this->session->set_userdata($sess_data);
            }
            
          }

		
		redirect('rest_client');
	}



	public function logout() {
			if($this->session->userdata('logged_in')!="" && $this->session->userdata('status')=="Tidak Aktif") {				
			$this->session->set_flashdata('akun', 'Akun anda belum aktif');
		}
   			$this->session->sess_destroy();
	   		redirect('rest_client/login');
  		} 



  	
	


	/** 
	Funntion Dosen 
	**/

	public function tampil_matkul_dosen() { 
		$query =$this->rest->get('matkul_dosen/format/json');
		$data['matkul_dosen']=$query; 
		$data['output']	=$this->load->view('list_matkul_dosen',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}


	/**
	SOAAAL
	**/

	function lihatsoal()
	{
		
		
		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}

		
		$query =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');
		$judul =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');

		//$query =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');
		//$judul =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');
		$data['query']=$query; 
		$data['judul']=$judul; 

		
		$data['output']	=$this->load->view('lihat_soal',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}


	


	function ikutites()
	{
		
		
		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}
		$no_soal='';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$no_soal='';
		}
		else
		{
    			$no_soal = $this->uri->segment(4);
		}
		
		$data["judul"]=$this->model_matkul->Judul_MK($id_mk);
		$data["soal"] = $this->model_matkul->Tampilkan_Soal($id_mk,$no_soal);
		$data["jumlah"] = $data["soal"]->num_rows;
		
		
		$data['output']	=$this->load->view('mulai_tes',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
		
		
	}

	function hasiltes()
	{
		
		$data=array();
		$jumlah = $this->input->post('banyak_soal');
		$jawaban= $this->input->post('pilih');
		$matkul = $this->input->post('matkul');
		$id_mk = $this->input->post('id_mk');
		$no_soal = $this->input->post('no_soal');
		$query=$this->model_matkul->Hitung_Hasil($id_mk,$no_soal);
		$data["hit_hasil"]=$query;
		$benar=0;
		$salah=0;
		foreach($query->result() as $hasil)
		{
			$jwb=$jawaban;
			$id=$hasil->id_soal;
			if($jwb[$id]==$hasil->kunci)
			{
				$benar++;
			}
			else {
				$salah++;
			}
		}
		$nilai=sprintf("%2.1f",$benar/$jumlah*100);
		if($nilai<60){
			$pesan="Belajarlah lebih baik lagi, sehingga bisa sukses di kemudian hari.";
		}
		else{
			$pesan="Selamat dan tingkatkan lagi.";
		}
		$datainput=array();
		$datainput["id_mk"]=$this->input->post('id_mk');
		$datainput["no_soal"]=$this->input->post('no_soal');
		$datainput["username"]=$this->session->userdata('user');
		$datainput["salah"]=$salah;
		$datainput["benar"]=$benar;
		$datainput["hasil"]=$nilai;
		if ($id_mk=="" AND $no_soal==""){
			echo "Ouuuppppzzzz,,,soalnya belum dikerjakan boz!!!!";
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/tampil_matkul'>";
		}
		else{
			$this->model_matkul->Simpan_Hasil($datainput);
		?>
		<script type="text/javascript" language="javascript">
		alert("<?php echo $this->session->userdata('user'); ?> telah mengikuti tes soal online <?php echo $matkul; ?>\n- Dengan total jawaban benar <?php echo $benar; ?> dan total jawaban salah <?php echo $salah; ?>.\n- Anda memperoleh nilai <?php echo $nilai; ?>\n- Pesan : <?php echo $pesan; ?>");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/tampil_matkul'>";
		}
	}





	
	/**
	 * 
	 * Access API "API" using GET through Phil's rest client
	 */		
	public function getApi()
	{
		echo '<pre>';
		print_r($this->rest->get('API/format/json'));
		echo '</pre>';		
	}		
}

/* End of rc.php */