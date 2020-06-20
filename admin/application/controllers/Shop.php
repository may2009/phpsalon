<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		
		$this->load->model('shop_model');
		$this->load->model('service_model');
		
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
 	}
	public function add_shop() {
		
		$template['page'] = 'Shops/add-shop';
		$template['page_title'] = "Add Shop";
		if($_POST) {
			$data = $_POST;
			
			$shop_name = preg_replace('/\s+/', ' ',$data['shop_name']);
			$data['shop_name'] = preg_replace('/[^a-zA-Z0-9\s]/', '', $shop_name);
			
			unset($data['submit']);
			$data['created_user'] = $this->session->userdata('logged_in')['id'];
			 $config = $this->set_upload_options();
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('image')) {
				//$result = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', array('message' => $this->upload->display_errors().'Error Occured While Uploading Files','class' => 'danger'));
				//echo $this->upload->display_errors();
			}
			else {
			$upload_data = $this->upload->data();
			$data['image'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
			$result = $this->shop_model->save_shop($data);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Shop Saved successfully','class' => 'success'));
			}
			
     		redirect(base_url().'shop/view_shops');
		}
	
		else {
   			$this->load->view('template', $template);
		}
	}
	
	
	
	public function assign_service() {
	  $template['page'] = 'Shops/assign-service';
		$template['page_title'] = "Assign Service";
		$template['shops'] = $this->shop_model->get_shops();
		$template['services'] = $this->service_model->get_service();
		
		if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			$result = $this->shop_model->assign_service($data);
			if($result == "Exist") {
				$this->session->set_flashdata('message', array('message' => 'Service already assigned for selected shop','class' => 'danger'));
			}
			else {
				$this->session->set_flashdata('message', array('message' => 'Service assigned  successfully','class' => 'success'));
			}
		}
		
   		$this->load->view('template', $template);
		
	}	
	
	
	
	public function edit_shop() {
		
		$template['page'] = 'Shops/edit-shop';
		$template['page_title'] = "Edit Shop";
		
		$id = $this->uri->segment(3);
		$template['data'] = $this->shop_model->get_single_shop($id);
		if(!empty($template['data'])) {
		if($_POST) {
			$data = $_POST;
			
			$shop_name = preg_replace('/\s+/', ' ',$data['shop_name']);
			$data['shop_name'] = preg_replace('/[^a-zA-Z0-9\s]/', '', $shop_name);
			
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
				}
			}
			
			$data['created_user'] = $this->session->userdata('logged_in')['id'];
			$result = $this->shop_model->update_shop($data, $id);
			array_walk($data, "remove_html");
			$this->session->set_flashdata('message', array('message' => 'Shop Updated Successfully','class' => 'success'));
     		redirect(base_url().'shop/view_shops');
		}
		else {
   			$this->load->view('template', $template);
		}
		}
		else {
			$this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));
				 redirect(base_url().'shop/view_shops');
		}
	}
	
	public function delete_shop() {
		$id = $this->uri->segment(3);
		$result = $this->shop_model->delete_shop($id);
		$this->session->set_flashdata('message', array('message' => 'Shop Deleted Successfully','class' => 'success'));
     	redirect(base_url().'shop/view_shops');
	}
	
	public function view_shops() {
		$template['page'] = 'Shops/view-shop';
		$template['page_title'] = "View Shops";
		$template['data'] = $this->shop_model->get_shops();
		$this->load->view('template',$template);
	}
	
	public function gallery() {
		$template['page'] = 'Shops/gallery';
		$template['page_title'] = "Gallery";
		$template['data'] = $this->shop_model->get_shops();
		
		if($_POST) {
			$data = $_POST;
			$data['user_id'] = $this->session->userdata('logged_in')['id'];
			
			$files = $_FILES;
			$cpt = count($_FILES['shopimage']['name']);
			
			for($i=0; $i<$cpt; $i++) {           
				
				$_FILES['shopimage']['name']= $data['user_id']."-".$files['shopimage']['name'][$i];
				$_FILES['shopimage']['type']= $files['shopimage']['type'][$i];
				$_FILES['shopimage']['tmp_name']= $files['shopimage']['tmp_name'][$i];
				$_FILES['shopimage']['error']= $files['shopimage']['error'][$i];
				$_FILES['shopimage']['size']= $files['shopimage']['size'][$i];  
				
				$config = $this->set_upload_options();
				
				//$data['image_path'] = base_url().$config['upload_path']."/".$_FILES['shopimage']['name'];
				
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('shopimage')) {
					//$result = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', array('message' => 'Error Occured While Uploading Files','class' => 'danger'));
				}
				else {
					$upload_data = $this->upload->data();
					$data['image_path'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
					array_walk($data, "remove_html");
					$this->session->set_flashdata('message', array('message' => 'Images Uploaded Successfully','class' => 'success'));
					$result = $this->shop_model->save_gallery($data);
					
					//$result = array('upload_data' => $this->upload->data());
				}
			}
			redirect(base_url().'shop/gallery');
		}
		$template['gallery'] = $this->shop_model->get_gallery();
		//var_dump($template['gallery']);
		$this->load->view('template',$template);
	}
	
	public function view_shop_gallery() {
		
		$id = $this->uri->segment(3);
		$template['page'] = 'Shops/view-shop-gallery';
		$template['page_title'] = "Shop Gallery";
		$template['data'] = $this->shop_model->get_shop_gallery($id);
		if(!empty($template['data'])) {
		$this->load->view('template',$template);
		}
		else {
			$this->session->set_flashdata('message', array('message' => "You don't have permission to access.",'class' => 'danger'));
				 redirect(base_url().'shop/gallery');
		}
	}
	
	private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}
	
	// Ajax Funciton
	public function view_single_shop() {
		$id = $_POST['id'];
		$template['data'] = $this->shop_model->get_single_shop($id);
		$template['services'] = $this->shop_model->get_shop_services($id);
		$this->load->view('Shops/view-shop-popup',$template);
	}
	
	public function delete_gallery_image() {
		$id = $_POST['id'];
		$result = $this->shop_model->delete_gallery_image($id);
		echo $result;
	}
	
	public function remove_shop_service() {
		$id = $_POST['id'];
		$result = $this->shop_model->remove_shop_service($id);
		echo $result;
	}
}
