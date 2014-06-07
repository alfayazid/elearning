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
		redirect('rest_client/list_user');
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
			//echo $query; 
			
			redirect('rest_client'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 


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



	public function login(){ 
		//$this->load->view('barang/script'); 
		$this->load->view('login'); 
	}   

	/* * fungsi untuk menambahkan brang ke data base */ 
	
	public function proses_login(){ 
		$data = array( 	
						'username' => $this->input->post('username'), 
						'password' => $this->input->post('password'), 
						
					); 
		$query = $this->rest->post('login/format/php',$data); 
		if($query) { 
			redirect('dashboard');
			//echo "<script>alert('Tambah Barang Berhasil')</script>"; 
			
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
				redirect('rest_client/login');
			} 
	}

	public function logout() {
   			$this->session->sess_destroy();
	   		redirect('rest_client/login');
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
		$data = array(	'status' => $this->input->post('status')
						
					);   

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
			
		
		//$this->load->view('dashboard',$data); 

		$data['output']	=$this->load->view('list_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}

	public function tambah_matkul(){ 
		
		$data['judul'] = 'Tambah Mata Kuliah';
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
			//echo $query; 
			
			redirect('rest_client/tampil_matkul'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 
	









	
	public function getUsers()
	{
		echo '<pre>';
		print_r($this->rest->get('users/format/json'));
		echo '</pre>';
	}
	
	/**
	 * 
	 * Access API "users" using GET through json_decode
	 */
	public function getUsersJson()
	{
		echo '<pre>';
		print_r(json_decode(file_get_contents($this->config->item('rest_server').'users/format/json')));
		echo '</pre>';		
	}
	
	/**
	 * 
	 * Access API "user" using GET through Phil's rest client
	 */
	public function getUser($id)
	{
		echo '<pre>';
		print_r($this->rest->get('user/id/'.$id.'/format/json'));
		echo '</pre>';
	}

	
	
	/**
	 * 
	 * Access API "user" using DELETE through Phil's rest client
	 */
	public function delUser()
	{
		echo '<pre>';
		print_r($this->rest->delete('user/id/2/format/json'));
		echo '</pre>';
	}

	/**
	 * 
	 * Access API "helloWorld" using GET through Phil's rest client
	 */
	public function helloWorld()
	{
		echo '<pre>';
		print_r($this->rest->get('helloWorld/format/json'));
		echo '</pre>';
	}

	/**
	 * 
	 * Access API "contacts" using GET through Phil's rest client
	 */	
	public function getContacts()
	{
		echo '<pre>';
		print_r($this->rest->get('contacts/format/json'));
		echo '</pre>';		
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