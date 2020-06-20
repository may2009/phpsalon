<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		
		$this->load->model('review_model');
		
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
 	}
	
	
	public function index() {
		$template['page'] = 'Review/view-review';
		$template['page_title'] = "User Reviews";
		$template['data'] = $this->review_model->get_reviews();
		$this->load->view('template',$template);
	}
	
	// Ajax Funciton
	public function view_shop_review() {
		$id = $_POST['id'];
		$template['data'] = $this->review_model->get_shop_reviews($id);
		$this->load->view('Review/view-shop-review',$template);
	}
	
}
