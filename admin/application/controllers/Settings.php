<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {


	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('settings_model');
		$this->load->model('shop_model');
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
		else {
			$menu = $this->session->userdata('admin');
			 if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access settings page.",'class' => 'danger'));
				 redirect(base_url().'dashboard');
			 }
		}
 	}
	
	public function home_slider() {
		$template['page'] = 'Settings/home-slider';
		$template['page_title'] = "Slider";
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
			$result = $this->settings_model->save_slider($data);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Slider saved successfully','class' => 'success'));
			}
			
     		redirect(base_url().'settings/home_slider');
		}
	
		else {
			$template['data'] = $this->settings_model->get_slider();
   			$this->load->view('template', $template);
		}
	}
	
		

 private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/slider';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}	
	
	public function delete_slider() {
		$id = $this->uri->segment(3);
		$result = $this->settings_model->delete_slider($id);
		$this->session->set_flashdata('message', array('message' => 'Slider Deleted Successfully','class' => 'success'));
     	redirect(base_url().'settings/home_slider');
	}
 
 public function edit_slider() {
		
		$template['page'] = 'Settings/edit-slider';
		$template['page_title'] = "Edit Slider";
		
		$id = $this->uri->segment(3);
		$template['data'] = $this->settings_model->get_single_slider($id);
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
					$upload_data = $this->upload->data();
					$data['image'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
					//$data['image'] = base_url().$config['upload_path']."/".$_FILES['image']['name'];
				}
			}
			
			$result = $this->settings_model->update_slider($data, $id);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Slider Updated Successfully','class' => 'success'));
     		redirect(base_url().'settings/home_slider');
		}
		else {
   			$this->load->view('template', $template);
		}
	}	

public function view_single_slider() {
		$id = $_POST['id'];
		$template['data'] = $this->settings_model->get_single_slider($id);
		$this->load->view('Settings/view-slider-popup',$template);
	}

/*----------------*/
/* Whats New */
/*----------------*/
public function whats_new() {
		$template['page'] = 'Settings/whats-new';
		$template['page_title'] = "What's New";
		if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			$config = $this->set_upload_options();
			$config['upload_path'] = 'assets/uploads/whats_new';
			
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
			$result = $this->settings_model->save_whats_new($data);
			$this->session->set_flashdata('message', array('message' => 'Whats new saved successfully','class' => 'success'));
			}
			
     		redirect(base_url().'settings/whats_new');
		}
	
		else {
			$template['data'] = $this->settings_model->get_whats_new();
			$template['shops'] = $this->shop_model->get_shops();
   			$this->load->view('template', $template);
		}
	}
	
	public function delete_whats_new() {
		$id = $this->uri->segment(3);
		$result = $this->settings_model->delete_whats_new($id);
		$this->session->set_flashdata('message', array('message' => 'Whats new deleted successfully','class' => 'success'));
     	redirect(base_url().'settings/whats_new');
	}
 
 public function edit_whats_new() {
		
		$template['page'] = 'Settings/edit-whats-new';
		$template['page_title'] = "Edit What's New";
		
		$id = $this->uri->segment(3);
		
		if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			
			if(isset($_FILES['image'])) {
				$config = $this->set_upload_options();
				$config['upload_path'] = 'assets/uploads/whats_new';
				
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
			
			$result = $this->settings_model->update_whats_new($data, $id);
			$this->session->set_flashdata('message', array('message' => 'Whats new updated successfully','class' => 'success'));
     		redirect(base_url().'settings/whats_new');
		}
		else {
			$template['shops'] = $this->shop_model->get_shops();
			$template['data'] = $this->settings_model->get_single_whats_new($id);
   			$this->load->view('template', $template);
		}
	}	

public function view_whats_new() {
		$id = $_POST['id'];
		$template['data'] = $this->settings_model->get_single_whats_new($id);
		$this->load->view('Settings/view-whats-new-popup',$template);
	}

/*----------------*/
/* Cycle Slider */
/*----------------*/
public function cycle_slider() {
		
	$template['page'] = 'Settings/cycle-slider';
	$template['page_title'] = "Cycle slider";
	$template['shops'] = $this->shop_model->get_shops();
	$template['data'] = $this->settings_model->get_cycle_slider();
	if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			$result = $this->settings_model->save_cycle_slider($data);
			if($result=="Exist")
			{
			$this->session->set_flashdata('message', array('message' => 'Shop already selected','class' => 'danger'));
			}
			else {
			$this->session->set_flashdata('message', array('message' => 'Shop added to cycle slider','class' => 'success'));
			}
     		redirect(base_url().'settings/cycle_slider');
		}
   			$this->load->view('template', $template);
	
    }
public function delete_cycle_slider() {
		$id = $this->uri->segment(3);
		$result = $this->settings_model->delete_cycle_slider($id);
		//echo $result;exit;
		$this->session->set_flashdata('message', array('message' => 'Shop removed from cycle slider','class' => 'success'));
     	redirect(base_url().'settings/cycle_slider');
	}
 


}	











