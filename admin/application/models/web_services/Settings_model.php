<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Settings_model extends My_model{
		
		protected $_table = "settings";
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
		
		
		
}
	
?>