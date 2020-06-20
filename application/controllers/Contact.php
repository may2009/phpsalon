<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		check_installer();
		//$this->load->model('booking_model');
 	}
	
	public function index()
	{
		
		$template['page_title'] = "Contact";
		$template['page_name'] = "contact-us";
		if(isset($_POST) and !empty($_POST)) {
			$data = $_POST;
			// load email library
			$this->load->library('email');
			
			// prepare email
			$this->email
				->from($data['email_id'], $data['name'])
				->to('enquiry@bookmysalons.com')
				->subject('Contact Form Submitted')
				->message($this->load->view('contact-email-template', $data, true))
				->set_mailtype('html');
			
			// send email
			$this->email->send();
			
			
			
			/*$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.bookmysalons.com';
			$config['smtp_user'] = 'no-reply@bookmysalons.com';
			$config['smtp_pass'] = 'Golden_123';
			$config['smtp_port'] = 587;
			$config['mailtype'] = 'html';
			$config['crlf'] = '\r\n';
			//$config['newline'] = '\r\n';

			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($data['email_id'], $data['name']);
			$this->email->to('enquiry@bookmysalons.com');
			$this->email->subject('Contact Form Submitted');
			$this->email->message($this->load->view('contact-email-template', $data, true));
			//$this->email->message("Test Mail");
			// Set to, from, message, etc.
			
			$result = $this->email->send();*/
  			
			$this->session->set_flashdata('message', array('message' => 'Thank you for contact us.','class' => 'success'));
			redirect(base_url()."contact");
		}
		$this->load->view('template', $template);
	}
}
