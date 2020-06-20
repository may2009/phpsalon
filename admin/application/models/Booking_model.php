<?php 

class Booking_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function get_bookings() {
		
		
		$this->db->select('bh.id, bh.booking_date, bh.booking_id, bh.booking_time, bh.total, bh.status, users.username, sd.shop_name');
		$this->db->from('booking_history as bh');
		$this->db->join('users', 'bh.user_id = users.id','left');
		$this->db->join('shop_details as sd', 'bh.shop_id = sd.id','left');
		$this->db->group_by("bh.id"); 

	
		$menu = $this->session->userdata('admin');
	 	if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('sd.created_user', $user);
		}

		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function get_booking_details($id) {
		
		$this->db->select('bd.id, bd.service_type, bd.service_id as booking_service_id, bh.shop_id as booking_shop_id, bh.id as booking_id, bh.booking_id as booking_order_id,, bd.price, bh.total, bh.booking_date, bh.booking_time, bh.status, ms.service_name, users.username, sd.shop_name');
		//$this->db->select('*');
		$this->db->from('booking_details as bd');
		$this->db->join('booking_history as bh', "bh.id = bd.booking_id",'left');
		$this->db->join('shop_services as ss', "ss.id = bd.service_id",'left');
		$this->db->join('main_services as ms', "ms.id = ss.service_id",'left');
		$this->db->join('users', 'bh.user_id = users.id','left');
		$this->db->join('shop_details as sd', 'bh.shop_id = sd.id','left');
		$this->db->where('bd.booking_id', $id);
		$this->db->group_by("bd.id");
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function update_booking_details($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('booking_history', $data); 
	}
	
	function get_booking_total($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('booking_history');
		$result = $query->row();
		return $result;
	}
}