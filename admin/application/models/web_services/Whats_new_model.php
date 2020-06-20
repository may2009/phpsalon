<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Whats_new_model extends My_model{
		
		protected $_table = "whats_new";
		protected $primary_key = "id";
		protected $return_type = "array";
		
		public $has_many = array();
		
		protected $after_get = array( "remove_sensitive_data" );
		protected $before_create = array( "prep_data" );
		
		protected function remove_sensitive_data($user){
			
			return $user;
			
		}
		
		protected function prep_data($user){
			return $user;
		}
		
		public function get_whats_new(){
				
				$this->db->select('whats_new.*,
				  				   shop_details.shop_name as shop_name'
								 );
				$this->db->where('whats_new.status','1');
				$this->db->join('shop_details', 'shop_details.id = whats_new.shop_id','left');
				
				return $this;
		}
		
}
	
?>