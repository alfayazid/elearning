<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_Model extends CI_Model {

	

	public function getLoginData($data)
	{
		$login['username'] = $data['username'];
		$login['password'] = $data['password'].'AppSimpeg32';
		$cek = $this->db->get_where('tbl_user', $login);
		if($cek->num_rows()>0)
		{
			foreach($cek->result() as $qad)
			{
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['id'] = $qad->id;
				$sess_data['username'] = $qad->username;
				$sess_data['password'] = $qad->password;
				$sess_data['level'] = $qad->level;
				$sess_data['status'] = $qad->status;
				$this->session->set_userdata($sess_data);
			}
			//header('location:'.base_url().'');
			redirect('rest_client/list_user');
		}
		else
		{
			$this->session->set_flashdata('result_login', "Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.");
			header('location:'.base_url().'');
		}
	}
}

/* End of file app_login_model.php */
/* Location: ./application/models/app_login_model.php */