<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trend extends CI_Controller {


	public function __construct() {
	parent::__construct();

		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('trend_model');
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
		else {
			$menu = $this->session->userdata('admin');
			 if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access trend page.",'class' => 'danger'));
				 redirect(base_url().'dashboard');
			 }
		}
 	}
	

public function add_trend() {
	
	$template['page'] = 'Trend/add-trend';
	$template['page_title'] = "Add Trend";
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
			$result = $this->trend_model->save_trend($data);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Trend Saved successfully','class' => 'success'));
			}
			
     		redirect(base_url().'trend/view_trend');
		}
	
		else {
   			$this->load->view('template', $template);
		}
	}

 public function view_trend() {
		$template['page'] = 'Trend/view-trend';
		$template['page_title'] = "View Trend";
		$template['data'] = $this->trend_model->get_trend();
		$this->load->view('template',$template);
	}

public function view_single_trend() {
		$id = $_POST['id'];
		$template['data'] = $this->trend_model->get_single_trend($id);
		$this->load->view('Trend/view-trend-popup',$template);
	}

public function edit_trend() {
		
		$template['page'] = 'Trend/edit-trend';
		$template['page_title'] = "Edit Trend";
		
		$id = $this->uri->segment(3);
		$template['data'] = $this->trend_model->get_single_trend($id);
		if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			if(isset($_FILES['image'])) {
				$config = $this->set_upload_options();
			
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('image')) {
					unset($data['image']);
					//echo $this->upload->display_errors();
				}
				else {
					//$data['image'] = base_url().$config['upload_path']."/".$_FILES['image']['name'];
					$upload_data = $this->upload->data();
					$data['image'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
				}
			}
			
			$result = $this->trend_model->update_trend($data, $id);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Trend Updated Successfully','class' => 'success'));
     		redirect(base_url().'trend/view_trend');
		}
		else {
   			$this->load->view('template', $template);
		}
	}

   public function delete_trend() {
		$id = $this->uri->segment(3);
		$result = $this->trend_model->delete_trend($id);
		$this->session->set_flashdata('message', array('message' => 'Trend Deleted Successfully','class' => 'success'));
     	redirect(base_url().'trend/view_trend');
	}
	
	 private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/trending';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}





}	







