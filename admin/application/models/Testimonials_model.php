<?php 

class Testimonials_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
function save_testimonials($data) {
	 $result = $this->db->insert('testimonials', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}
function get_testimonials() {
		$query = $this->db->get('testimonials');
		$result = $query->result();
		return $result;
	}

function get_single_testimonials($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('testimonials');
		$result = $query->row();
		return $result;
	                     }	

function update_testimonials($data, $id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->update('testimonials', $data); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}

function delete_testimonials($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('testimonials'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}

}	