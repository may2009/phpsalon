<?php 

class Dashboard_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function get_shops_count() {
		
		$menu = $this->session->userdata('admin');
		if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('shop_details.created_user', $user);
		}
		$result = $this->db->count_all_results('shop_details');
		return $result;
	}
	
	function get_users_count() {
		$result = $this->db->count_all_results('users');
		return $result;
	}
	
	function get_customers_count() {
		$result = $this->db->count_all_results('saloon_users');
		return $result;
	}
	
	function get_bookings_count() {
		
		$this->db->join('shop_details as sd', 'bh.shop_id = sd.id','left');
		$menu = $this->session->userdata('admin');
		if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('sd.created_user', $user);
		}
		
		$result = $this->db->count_all_results('booking_history as bh');
		return $result;
	}
}