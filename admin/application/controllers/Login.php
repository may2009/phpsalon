<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		
		$this->load->helper(array('form'));
		
		$this->load->model('login_model');
		
		
		
		if($this->session->userdata('logged_in')) { 
			redirect(base_url().'dashboard');
		}
 	}
	/*public function test() {
		$data['firstname'] = "ragu";
		$data['username'] = "ragu";
		$data['password'] = "ragu";
		$this->load->view('customer-email-template', $data);
	}*/
	public function index(){
		
		$template['page_title'] = "Login";
		if(isset($_POST)) {
			$this->load->library('form_validation');
			
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
			
			                  
			if($this->form_validation->run() == TRUE) {
				redirect(base_url().'dashboard');
			}
			
			
		}
		
		
			
		
		$this->load->view('Templates/header', $template);
		$this->load->view('Login/login_form');
		$this->load->view('Templates/footer');
		
	}
	
	function check_database($password) {
		$username = $this->input->post('username');
		$result = $this->login_model->login($username, $password);
		
	
		if($result) {
			$sess_array = array();
			foreach($result as $row) {
			  $sess_array = array(
			    'id' => $row->id,
			    'username' => $row->username,
			    'user_type'=> $row->user_type,
			    'created_user' =>$row->created_user
			    
			     );
			  $this->session->set_userdata('logged_in',$sess_array);
			  $this->session->set_userdata('admin',$row->user_type);
			   $this->session->set_userdata('id',$row->id);
			 // $this->session->set_userdata('user','$user->id');
		    }
		    return TRUE;
		}
		else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
		
		
	}
}
