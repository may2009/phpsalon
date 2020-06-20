<?php 

class Login_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	function login($username, $password) {
	  $this -> db -> select('id, username, password');
	  $this -> db -> from('saloon_users');
	  // $this -> db -> from('admin_users');
	  
	  $this -> db -> where('status', '1');
	  $this -> db -> where('username', $username);
	  $this -> db -> where('password', $password);
	  $this -> db -> limit(1);
	  
	  $query = $this -> db -> get();
	  
	   if ($query -> num_rows() == 1) {
	  	return $query->result();
	  }
	  else {
	  	
	  $this -> db -> from('admin_users');
	  $this -> db -> where('username', $username);
	  $this -> db -> where('password', $password);
	  $this -> db -> limit(1);
	  
	  $query = $this -> db -> get();
	  
	  
	   if ($query -> num_rows() == 1) {
	  	return $query->result();
	  }
	   else {
		   {
		   	return false;
		 }
	   }
	  }
	}
	

}