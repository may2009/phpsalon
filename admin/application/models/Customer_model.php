<?php 

class Customer_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function save_customers($data) {
		$username = $data['username'];
	    $email_id = $data['email_id'];
		
	   $this->db->where('username', $username);
	   $query= $this->db->get('saloon_users');
	
	   
	     if ($query->num_rows() > 0){
		   return "Exist";
	            }
	          else {
	  	
		$this->db->where('email_id', $email_id);
		 $query1= $this->db->get('saloon_users');
	

	 if(($query1->num_rows() > 0)) {
	 	return "already exist";
	 	 
	 }
	 else {
		$result = $this->db->insert('saloon_users', $data); 
		 return "Success";
	 }
	}
	}
	
	
	function get_customers() {
		$query = $this->db->get('saloon_users');
		$result = $query->result();
		return $result;
	}
	
function get_single_customer($id) {
		$query = $this->db->where('id', $id);
		$query = $this->db->get('saloon_users');
		$result = $query->row();
		return $result;
	                     }	




function update_customer($data, $id) {
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


	function delete_customer($id) {
		
	 $this->db->where('id', $id);
	 $result = $this->db->delete('saloon_users'); 
	 
	 if($result) {
		 return "Success";
	 }
	 else {
		 return "Error";
	 }
	}	
}