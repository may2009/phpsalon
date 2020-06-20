<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	

	class Model_booking extends My_model{
		
		public $belongs_to = array( 'users' => array( 'primary_key' => 'id' ) );
		
	}
	
	
	
?>