<?php 

class User_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	


	function get_user() {
		$query = $this->db->get('users');
		$result = $query->result();
		return $result;
	}
function get_single_user($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('users');
		$result = $query->row();
		return $result;
	}	

function get_single_profile($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('saloon_users');
		$result = $query->row();
		return $result;
	}




function update_user($data, $id) {
		$username = $data['username'];
	    $email_id = $data['email_id'];
		
	 $this->db->where("id !=",$id);
	 
	 $this->db->where("(username = '$username' OR email_id = '$email_id' )");
	 //$this->db->where('username', $username);
	// $this->db->or_where('email_id', $email_id);
	 $query= $this->db->get('saloon_users');
	 
	   
	    if($query -> num_rows() >0 ) {
	    
		 return "Exist";
	           }
	 else {
	 $this->db->where('id', $id);
	 $result = $this->db->update('saloon_users', $data); 
		 return "Success";
	 
	 }
	}




}









