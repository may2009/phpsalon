<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		check_installer();
		//$this->load->model('booking_model');
 	}
	
	public function index()
	{
		$template['page_title'] = "About";
		$template['page_name'] = "about-us";
        if (isset($_SESSION['username'])) {
            $template['user_data'] = "show";
            $template['username'] = $_SESSION['username'];
        }

        $this->load->view('template', $template);
	}
}
