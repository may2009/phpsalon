<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		
		$this->load->model('booking_model');
		$this->load->model('shop_model');
		$this->load->model('service_model');
		
		if(!$this->session->userdata('logged_in')) {
			redirect(base_url());
		}
 	}
	
	
	public function index() {
		$template['page'] = 'Booking/view-bookings';
		$template['page_title'] = "Bookings";
		$template['page_parent'] = "Home";
		$template['data'] = $this->booking_model->get_bookings();
		$this->load->view('template',$template);
	}
	
	// Ajax Funciton
	public function view_booking_details() {
		$id = $_POST['id'];
		$data = $this->booking_model->get_booking_details($id);
		$template['data'] = $data;
		$template['new_services'] = $this->shop_model->get_shop_services($data[0]->booking_shop_id);
		$this->load->view('Booking/view-booking-details',$template);
		//var_dump($template['data']);
	}
	
	public function complete_booking_details() {
		$id = $_POST['id'];
		$data['status'] = "Completed";
		$this->booking_model->update_booking_details($data, $id);
		echo "success";
		//var_dump($template['data']);
	}
	
	public function add_new_services() {
		$booking_id = $_POST['booking_id'];
		$shop_id = $_POST['shop_id'];
		$services = $_POST['new_service'];
		$new_total = 0;
		foreach($services as $service) {
			$service_details = $this->service_model->get_service_price($service);
			$price = $service_details->price;
			$new_total += $price;
			$insert_data[] = array(
								   "booking_id" => $booking_id,
								   "service_id" => $service,
								   "service_type" => "1",
								   "price" => $price
								   );
		}
		$this->db->insert_batch('booking_details', $insert_data); 
		$booking_details = $this->booking_model->get_booking_total($booking_id);
		$total = $booking_details->total + $new_total;
		$update_data = array(
               'total' => $total
            );
		$this->booking_model->update_booking_details($update_data, $booking_id);
		$this->session->set_flashdata('message', array('message' => 'New services added for booking id : ' .  $booking_details->booking_id,'class' => 'success'));
		echo "success";
	}
	
}
