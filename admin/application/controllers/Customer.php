<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {


	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('customer_model');
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
		else {
			$menu = $this->session->userdata('admin');
			 if( $menu!=1  ) {
				 $this->session->set_flashdata('message', array('message' => "You don't have permission to access customer page.",'class' => 'danger'));
				 redirect(base_url().'dashboard');
			 }
		}
 	}
	
	public function add_customer() {
	
	$template['page'] = 'Customer/add-customer';
	$template['page_title'] = "Add Customer";
	      
	      if($_POST) {
			$data = $_POST;
			unset($data['submit']);
			
			$notify = '';
			if(isset($data['nofity'])) {
				$notify = $data['nofity'];
				unset($data['notify']);
			}
			
			$config = $this->set_upload_options();
			
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('profile_pic')) {
				//$result = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', array('message' => 'Error Occured While Uploading Files','class' => 'danger'));
				//echo $this->upload->display_errors();
			}
			else {
			
			//$data['profile_pic'] = base_url().$config['upload_path']."/".$_FILES['profile_pic']['name'];
			$upload_data = $this->upload->data();
			$data['profile_pic'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
			$result = $this->customer_model->save_customers($data);
			
			if($result == "Exist") {
				$this->session->set_flashdata('message', array('message' => 'Customer already exist','class' => 'danger'));
			}
			
			else {
				if($notify != '') {
					// Send Mail
					$this->load->library('email');
					// prepare email
					$this->email
						->from("no-reply@bookmysalons.com", "BookMySalons")
						->to($data['email_id'])
						->subject('Welcome to BookMySalons')
						->message($this->load->view('customer-email-template', $data, true))
						->set_mailtype('html');
					
					// send email
					$result = $this->email->send();
				}
				array_walk($data, "remove_html");
				$this->session->set_flashdata('message', array('message' => 'Customer Saved successfully','class' => 'success'));
			}
			
     		redirect(base_url().'customer/view_customer');
		}
		  }
		else {
   			$this->load->view('template', $template);
		}
	}

  public function view_customer() {
		$template['page'] = 'Customer/view-customer';
		$template['page_title'] = "View Customers";
		$template['data'] = $this->customer_model->get_customers();
		$this->load->view('template',$template);
	}
public function view_single_customer() {
		$id = $_POST['id'];
		$template['data'] = $this->customer_model->get_single_customer($id);
		$this->load->view('Customer/view-customer-popup',$template);
	}
 
 public function delete_customer() {
		$id = $this->uri->segment(3);
		$result = $this->customer_model->delete_customer($id);
		$this->session->set_flashdata('message', array('message' => 'customer Deleted Successfully','class' => 'success'));
     	redirect(base_url().'customer/view_customer');
	}
 
 public function edit_customer() {
		
		$template['page'] = 'Customer/edit-customer';
		$template['page_title'] = "Edit customer";
		
		$id = $this->uri->segment(3);
		$template['data'] = $this->customer_model->get_single_customer($id);
		if($_POST) {
			$data = $_POST;
			
			unset($data['submit']);
			$notify = '';
			if(isset($data['nofity'])) {
			$notify = $data['nofity'];
			unset($data['notify']);
			}
			if(isset($_FILES['profile_pic'])) {
				$config = $this->set_upload_options();
			
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('profile_pic')) {
					unset($data['profile_pic']);
				}
				else {
					$upload_data = $this->upload->data();
					$data['profile_pic'] = base_url().$config['upload_path']."/".$upload_data['file_name'];
					//$data['profile_pic'] = base_url().$config['upload_path']."/".$_FILES['profile_pic']['name'];
				}
			}
			
			$result = $this->customer_model->update_customer($data, $id);
			
			if($result == "Exist") {
				$this->session->set_flashdata('message', array('message' => 'Customer already exist','class' => 'danger'));
			   }
			else if($result == "Already Exist") {
				$this->session->set_flashdata('message', array('message' => 'Email id already exist','class' => 'danger'));
			   }
				
			else {
				if($notify != '') {
					// Send Mail
					$this->load->library('email');
					// prepare email
					$this->email
						->from("no-reply@bookmysalons.com", "BookMySalons")
						->to($data['email_id'])
						->subject('Welcome to BookMySalons')
						->message($this->load->view('customer-email-template', $data, true))
						->set_mailtype('html');
					
					// send email
					$result = $this->email->send();
				}
				array_walk($data, "remove_html");
				$this->session->set_flashdata('message', array('message' => 'Customer Updated Successfully','class' => 'success'));
			   }
			
		
     		redirect(base_url().'customer/view_customer');
		}
		else {
   			$this->load->view('template', $template);
		}
	}

 private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/profile_pic';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}
 
}

