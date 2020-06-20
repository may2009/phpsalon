<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('user_model');
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
		else {
			$profile = $this->router->fetch_method();
			if($profile != 'profile') {
			$menu = $this->session->userdata('admin');
			 if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access user page.",'class' => 'danger'));
				 redirect(base_url().'dashboard');
			 }
			}
		}
 	}
	
	public function profile() {
		
		$template['page'] = 'User/profile';
		$template['page_title'] = "User Profile";
		$id = $this->session->userdata('logged_in')['id'];
		$template['data'] = $this->user_model->get_single_profile($id);
		if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			if(isset($_FILES['profile_pic'])) {
				$config = $this->set_upload_options();
			
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('profile_pic')) {
					unset($data['profile_pic']);
				}
				else {
					$data['profile_pic'] = $config['upload_path']."/".$_FILES['profile_pic']['name'];
				}
			}
			
			$result = $this->user_model->update_user($data, $id);
			if($result == "Exist") {
			$this->session->set_flashdata('message', array('message' => 'Customer already exist','class' => 'danger'));
			   }
				
			else {	
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Profile Updated Successfully','class' => 'success'));
			   }
			
			
     		redirect(base_url().'user/profile');
		}
		else {
   			$this->load->view('template', $template);
		}
		
	}

  	public function view_user() {
		$template['page'] = 'User/view-user';
		$template['page_title'] = "View User";
		$template['data'] = $this->user_model->get_user();
		$this->load->view('template',$template);
	}
	
	public function view_single_user() {
		$id = $_POST['id'];
		$template['data'] = $this->user_model->get_single_user($id);
		$this->load->view('User/view-user-popup',$template);
	}
	
	private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/profile_pic';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}

}	

