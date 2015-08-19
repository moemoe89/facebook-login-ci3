<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		
		if($this->session->userdata('login') == true){
			redirect('welcome/profile');
		}
		
		
		if ($this->facebook->logged_in())
		{
			$user = $this->facebook->user();

			if ($user['code'] === 200)
			{
				$this->session->set_userdata('login',true);
				$this->session->set_userdata('user_profile',$user['data']);
				redirect('welcome/profile');
			}

		}
		
		 else {
	
			$contents['link'] = $this->facebook->login_url();
		
			$this->load->view('welcome_message',$contents);
		
	
		}
	}
	
	public function profile(){
		if($this->session->userdata('login') != true){
			redirect('');
		}
		$contents['user_profile'] = $this->session->userdata('user_profile');
		$this->load->view('profile',$contents);
		
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('');
		
	}
	
}
