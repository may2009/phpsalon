<?php 

class Trend_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function save_trend($data) {
	 $result = $this->db->insert('trending', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
	
	function get_trend() {
		$query = $this->db->get('trending');
		$result = $query->result();
		return $result;
	}
function get_single_trend($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('trending');
		$result = $query->row();
		return $result;
	}	
function update_trend($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('trending', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
function delete_trend($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('trending'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}

}