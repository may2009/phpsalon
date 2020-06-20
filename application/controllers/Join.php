<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->helper('form');
		check_installer();
		//$this->load->model('booking_model');
 	}
	
	public function index()
	{
		$template['page_title'] = "Book My Saloon";
		$template['page_name'] = "join_page";
		
		if(!empty($_POST)) {
		$post_data = $_POST;
		$post_data['status'] = 0;
		$url = $this->config->item('webservice_url')."joinSalons";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		 
		$result = json_decode($buffer);
		$messages = $result->message;
		$msg = '';
		foreach($messages as $message) {
			$msg .= '<div>'.$message.'</div>';
		}
		$this->session->set_flashdata('message', array('message' => $msg,'class' => $result->status));
		/*var_dump($result);
		exit;*/
		if($result->status == "success") {
			redirect(base_url()."join");
		}
		}
		
		$this->load->view('template', $template);
	}
	
	public function reg_temp() {
		$this->load->view('register-email-template');
	}
	
	public function book_temp() {
		$this->load->view('booking-email-template');
	}
	
}
