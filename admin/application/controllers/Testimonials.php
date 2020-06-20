<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {


	public function __construct() {
	parent::__construct();

		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('testimonials_model');
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
		else {
			$menu = $this->session->userdata('admin');
			 if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access testimonials page.",'class' => 'danger'));
				 redirect(base_url().'dashboard');
			 }
		}
		
 	}
	
public function add_testimonials() {
	
	$template['page'] = 'Testimonials/add-testimonials';
	$template['page_title'] = "Add Testimonials";
	      
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
			$result = $this->testimonials_model->save_testimonials($data);
			
			if($result == "Exist") {
			$this->session->set_flashdata('message', array('message' => 'Testimonials already exist','class' => 'danger'));
			   }
			
			else {	
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Testimonials Saved successfully','class' => 'success'));
			   }
			
     		redirect(base_url().'testimonials/view_testimonials');
		}
		  }
		else {
   			$this->load->view('template', $template);
		}
	}

 public function view_testimonials() {
		$template['page'] = 'Testimonials/view-testimonials';
		$template['page_title'] = "View Testimonials";
		$template['data'] = $this->testimonials_model->get_testimonials();
		$this->load->view('template',$template);
	}

public function edit_testimonials() {
		
		$template['page'] = 'Testimonials/edit-testimonials';
		$template['page_title'] = "Edit Testimonials";
		
		$id = $this->uri->segment(3);
		$template['data'] = $this->testimonials_model->get_single_testimonials($id);
		if(!empty($template['data'])) {
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
			
			//$data['created_user'] = $this->session->userdata('logged_in')['id'];
			$result = $this->testimonials_model->update_testimonials($data, $id);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Testimonial Updated Successfully','class' => 'success'));
     		redirect(base_url().'testimonials/view_testimonials');
		}
		else {
   			$this->load->view('template', $template);
		}
		}
		
	}
public function view_single_testimonials() {
		$id = $_POST['id'];
		$template['data'] = $this->testimonials_model->get_single_testimonials($id);
		$this->load->view('Testimonials/view-testimonials-popup',$template);
	}

public function delete_testimonials() {
		$id = $this->uri->segment(3);
		$result = $this->testimonials_model->delete_testimonials($id);
		$this->session->set_flashdata('message', array('message' => 'Testimonials Deleted Successfully','class' => 'success'));
     	redirect(base_url().'testimonials/view_testimonials');
	}

private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/testimonials';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}		
 	
}