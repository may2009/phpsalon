<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		check_installer();
		//$this->load->model('booking_model');
 	}
	
	public function index() {
		delete_cookie('bms_usercookie');
		$this->session->unset_userdata('bms_userdata');
		session_destroy();
		$this->load->library('user_agent');
		if ($this->agent->is_referral()) {
        	redirect($this->agent->referrer());
    	}
		else {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
