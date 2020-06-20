<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	

	class Booking_history_model extends My_model{
		
		protected $_table = "booking_history";
		protected $primary_key = "id";
		protected $return_type = "array";
		
		protected $belongs_to = array('users');
		//protected $belongs_to = array('users' => array('primary_key' => 'user_id'));
		// public $belongs_to = array( 'user' => array( 'model' => 'user_model','primary_key'=>'user_id') );
	}
	
	
   //http://stackoverflow.com/questions/18007395/relationships-with-my-model	
?>
