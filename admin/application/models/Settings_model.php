<?php 

class Settings_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	

/* Slider */	
	function save_slider($data) {
	 $result = $this->db->insert('slider', $data); 
	 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function get_slider() {
		$query = $this->db->get('slider');
		$result = $query->result();
		return $result;
	}
	
	function delete_slider($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('slider'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function update_slider($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('slider', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	      }
	}

function get_single_slider($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('slider');
		$result = $query->row();
		return $result;
	  }	
	  
/* Whats New */	

	function save_whats_new($data) {
	 $result = $this->db->insert('whats_new', $data); 
	 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function get_whats_new() {
		
		$query = $this->db->select('whats_new.*, shop_details.shop_name');
		$query = $this->db->from('whats_new');
		$query = $this->db->join('shop_details','shop_details.id=whats_new.shop_id','left');
		$result = $query->get()->result();
		return $result;
	}
	
	function delete_whats_new($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('whats_new'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function update_whats_new($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('whats_new', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	      }
	}

function get_single_whats_new($id) {
		$query = $this->db->select('whats_new.*, shop_details.shop_name');
		$query = $this->db->from('whats_new');
		$query = $this->db->where('whats_new.id', $id);
		
		$query = $this->db->join('shop_details','shop_details.id=whats_new.shop_id','left');
		$result = $query->get()->row();
		return $result;
	  }	  
	  
	  
/* Cycle Slider */
function save_cycle_slider($data) {
	
	 $shop_id = $data['shop_id'];
	 $this->db->where('shop_id', $shop_id);
	 $this->db->from('cycle_slider');
	 
	 $count = $this->db->count_all_results();
	 
	 if($count > 0) {
		 return "Exist";
	 }
	 else {
	 $result = $this->db->insert('cycle_slider', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	 }
	}
	
	
	
	
	
function get_cycle_slider() {
	     $this->db->select('ss.shop_name,ms.id, ms.shop_id');
		$this->db->from('shop_details as ss');
		$this->db->join('cycle_slider as ms', 'ms.shop_id = ss.id'); 
		 $query = $this->db->get();
		$result = $query->result();
		return $result;
	                     }	

function delete_cycle_slider($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('cycle_slider'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}

}