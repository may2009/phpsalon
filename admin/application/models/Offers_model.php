<?php 

class Offers_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
function save_offers($data) {
	 $shop_id = $data['shop_id'];
	 $this->db->where('shop_id', $shop_id);
	 $this->db->from('offers');
	
	 $count = $this->db->count_all_results();
	 
	 if($count > 0) {
		 return "Exist";
	 }
	 else {
	 $result = $this->db->insert('offers', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	 }
	}
	
	function update_offers($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('offers', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function delete_offers($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('offers'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	      }
	}
	
  function get_offers() {

         $this->db->select('ss.shop_name,  ms.id,ms.offers');
		$this->db->from('shop_details as ss');
		$this->db->join('offers as ms', 'ms.shop_id = ss.id'); 
		$menu = $this->session->userdata('admin');
		if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('ss.created_user', $user);
		}
		//$this->db->where('ss.id', $id);
         $query = $this->db->get();
		$result = $query->result();
		return $result;
          }  
	
	function get_single_offers($id) {
		$query = $this->db->where('offers.id', $id);
		$menu = $this->session->userdata('admin');
		if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('shop_details.created_user', $user);
			$this->db->join('shop_details', 'shop_details.id = offers.shop_id','left');
		}
		$query = $this->db->get('offers');
		$result = $query->row();
		return $result;
	                     }	
}