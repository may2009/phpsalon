<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad extends CI_Controller {


	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('ad_model');
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
		else {
			$menu = $this->session->userdata('admin');
			 if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access ad page.",'class' => 'danger'));
				 redirect(base_url().'dashboard');
			 }
		}
 	}
	
	public function index() {
		$template['page'] = 'Ad/ad';
		$template['page_title'] = "Ad";
	      
	      if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			$config = $this->set_upload_options();
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('image')) {
				//$result = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', array('message' => 'Error Occured While Uploading Files','class' => 'danger'));
				//echo $this->upload->display_errors();
			}
			else {
			
			//$data['image'] = base_url().$config['upload_path']."/".$_FILES['image']['name'];
			$upload_data = $this->upload->data();
			$data['image'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
			$result = $this->ad_model->save_ad($data);
			
			if($result == "Exist") {
			$this->session->set_flashdata('message', array('message' => 'Ad already exist','class' => 'danger'));
			   }
			
			else {	
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Ad Saved successfully','class' => 'success'));
			   }
			
     		redirect(base_url().'ad');
		}
		  }
		else {
			$template['data'] = $this->ad_model->get_ad();
   			$this->load->view('template', $template);
		}
	}
	

 public function edit_ad() {
		
		$template['page'] = 'Ad/edit-ad';
		$template['page_title'] = "Edit Ad";
		
		$id = $this->uri->segment(3);
		$template['data'] = $this->ad_model->get_single_ad($id);
		if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			if(isset($_FILES['image'])) {
				$config = $this->set_upload_options();
			
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('image')) {
					unset($data['image']);
				}
				else {
					//$data['image'] = base_url().$config['upload_path']."/".$_FILES['image']['name'];
					$upload_data = $this->upload->data();
					$data['image'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
				}
			}
			
			$result = $this->ad_model->update_ad($data, $id);
			
			
				
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Ad Updated Successfully','class' => 'success'));
			 
			
		
     		redirect(base_url().'ad');
		}
		else {
   			$this->load->view('template', $template);
		}
	}

public function delete_ad() {
		$id = $this->uri->segment(3);
		$result = $this->ad_model->delete_ad($id);
		$this->session->set_flashdata('message', array('message' => 'Ad Deleted Successfully','class' => 'success'));
     	redirect(base_url().'ad');
	}

public function view_single_ad() {
		$id = $_POST['id'];
		$template['data'] = $this->ad_model->get_single_ad($id);
		$this->load->view('Ad/view-ad-popup',$template);
	}

 private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/ad';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}	
	
}