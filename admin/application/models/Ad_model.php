<?php 

class Ad_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function save_ad($data) {
	 $result = $this->db->insert('ad', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
function get_ad() {
		$query = $this->db->get('ad');
		$result = $query->result();
		return $result;
	}

function get_single_ad($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('ad');
		$result = $query->row();
		return $result;
	                     }	




function update_ad($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('ad', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}


	function delete_ad($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('ad'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}	


}	