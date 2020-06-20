<?php 

class Service_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function save_service($data) {
	 $result = $this->db->insert('main_services', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function get_service() {
		$query = $this->db->get('main_services');
		$result = $query->result();
		return $result;
	}
	
	function get_single_service($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('main_services');
		$result = $query->row();
		return $result;
	}
	
	function update_service($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('main_services', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function delete_service($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('main_services'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function get_service_price($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('shop_services');
		$result = $query->row();
		return $result;
	}
	
	
}