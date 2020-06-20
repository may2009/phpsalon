<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 // Allow from any origin
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

	// Access-Control headers are received during OPTIONS requests
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		exit(0);
	}



// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Web_services extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
				
				$this->load->library('form_validation');
				$this->load->helper('JWT');
    }
		
/* SignUp PSOT
====================================================================================*/
		public function signUp_post(){
				
				$this->form_validation->set_data( $this->post() );
				
				if( $this->form_validation->run('signUp') !== false){
					
					$this->load->model('web_services/user_model');
					$user = $this->post();
					
					$exist_email 			= $this->user_model->get_by(array('email_id'=>$user['email_id']));
					$exist_phone	 		= $this->user_model->get_by(array('phone_no'=>$user['phone_no']));
					$exist_user_name 	= $this->user_model->get_by(array('username'=>$user['username']));
					
					if( $exist_email || $exist_phone || $exist_user_name ){
							
							$message = [];
							
							if($exist_email){ $message[] = "The specified email address already exist in the system"; }
							if($exist_phone){	$message[] = "The specified phone number already exist in the system";}
							if($exist_user_name){ $message[] = "The specified user name already exist in the system";}
							
							$this->response([ 'status' => 'failure', 'message' => $message ], REST_Controller::HTTP_CONFLICT); 
					
					}else{
						    array_walk($user,"remove_html");
							$user['status'] = 1;
							$user_id = $this->user_model->insert($user);
					
							if( !$user_id ){
								 $this->response([ 'status' => 'failure', 
								 'message' => 'An unexpected error occured while trying to create the user' ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
							
							}else{
									
									$result =  array( 'status'=>'success',  'message'=> "SignUp Successfully completed", 'id' => $user_id,
																		'token'=>$this->token_gen( $this->post('username') ) );		
									$this->response( $result );
							}
					}
				
				}else{
					$result =  array( 'status'=>'failure', 
														'message'=> array_values( $this->form_validation->get_errors_as_array())
													 );
					$this->response( $result ,REST_Controller::HTTP_BAD_REQUEST );
				
				}
		}
//---------------------------------------------------END signUp----------------------------------------------------
		
		
/* 		SignIn POST
========================================================================*/
		public function signIn_post(){
			
				$login_data = $this->post();
				
				
				$this->form_validation->set_data( $login_data  );
				
				if( $this->form_validation->run('signIn') !== false){
					
					$this->load->model('web_services/user_model');
					
					$result = $this->user_model->login( $login_data )->get_all();
					
					if( !$result ){
							
							$message = [];
							$message[] = "Unknown credential!"; 
							
							$this->response([ 'status' => 'failure', 'message' => $message ], REST_Controller::HTTP_NOT_FOUND); 
					
					}else{
							if($result[0]['status'] == 1) {
							$response =  array( 'status'=>'success',  'message'=> "SignIn Successfully completed",
																	 'profile'=>$result[0],	'token'=>$this->token_gen( $result[0]['username'] ) );	
							}
							else if($result[0]['status'] == 0) {
								$response =  array( 'status'=>'verify',  'message'=> "OTP sent to your registered mobile", 'profile'=>$result[0] );
							}
							else {
								$this->response([ 'status' => 'failure', 
								 'message' => array('An unexpected error occured while trying to create the user') ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
							}
							$this->response( $response );
							//$this->response( $result );
							
					}
				
				}else{
					$result =  array( 'status'=>'failure', 
														'message'=> array_values( $this->form_validation->get_errors_as_array())
													 );
					$this->response( $result ,REST_Controller::HTTP_BAD_REQUEST );
				
				}
		}

//---------------------------------------------------END signIn----------------------------------------------------

/* Forgot Password PSOT
====================================================================================*/
		public function forgotPwd_post(){
				
				$post_data = $this->post();
				
				if( $post_data['email_id'] != ''){
					
					$this->load->model('web_services/user_model');
					
					//$exist_phone	= $this->user_model->get_by(array('phone_no'=>$post_data['phone_no']));
					$exist_email	= $this->user_model->get_by(array('email_id'=>$post_data['email_id']));
					
					if( !$exist_email ){
							
							$message[] = "The specified email id not exist in the system";							
							$this->response([ 'status' => 'failure', 'message' => $message ], REST_Controller::HTTP_CONFLICT); 
					
					}else{
							$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
							$string = '';
							 for ($i = 0; $i < 8; $i++) {
								  $string .= $characters[rand(0, strlen($characters) - 1)];
							 }
							//$user['password'] = md5(uniqid());
							$user['password'] = md5($string);
							
							$user_id = 1;
							$user_id = $this->user_model->update_user($user, $post_data);
					
							if( !$user_id ){
								 $this->response([ 'status' => 'failure', 
								 'message' => 'An unexpected error occured while trying to create the user' ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
							
							}else{
									
									$result =  array( 'status'=>'success',  'message'=> "New password sent to your email id ".$post_data['email_id'] , 'otp' => $string );		
									$this->response( $result );
							}
					}
				
				}else{
					$result =  array( 'status'=>'failure', 
														'message'=> array("Invalid Phone Number")
													 );
					$this->response( $result ,REST_Controller::HTTP_BAD_REQUEST );
				
				}
		}
//---------------------------------------------------END Forgot Password----------------------------------------------------

/* SignUp PSOT
====================================================================================*/
		public function joinSalons_post(){
				
				$this->form_validation->set_data( $this->post() );
				
				if( $this->form_validation->run('joinSalons') !== false){
					
					$this->load->model('web_services/customer_model');
					$user = $this->post();
					
					$exist_email 			= $this->customer_model->get_by(array('email_id'=>$user['email_id']));
					$exist_phone	 		= $this->customer_model->get_by(array('phone_no'=>$user['phone_no']));
					
					if( $exist_email || $exist_phone ){
							
							$message = [];
							
							if($exist_email){ $message[] = "The specified email address already exist in the system"; }
							if($exist_phone){	$message[] = "The specified phone number already exist in the system";}
							
							$this->response([ 'status' => 'error', 'message' => $message ], REST_Controller::HTTP_CONFLICT); 
					
					}else{
							array_walk($user,"remove_html");
							$user_id = $this->customer_model->insert($user);
					
							if( !$user_id ){
								 $this->response([ 'status' => 'error', 
								 'message' => array('An unexpected error occured while trying to create the user') ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
							
							}else{
									
									$result =  array( 'status'=>'success',  'message'=> array("Registered Successfully. We will contact you within 24 hours."), 'id' => $user_id );		
									$this->response( $result );
							}
					}
				
				}else{
					$result =  array( 'status'=>'error', 
														'message'=> array_values( $this->form_validation->get_errors_as_array())
													 );
					$this->response( $result ,REST_Controller::HTTP_BAD_REQUEST );
				
				}
		}
//---------------------------------------------------END JoinSalons----------------------------------------------------

/* 		Get user details from token -POST
========================================================================*/
public function getuser_post(){
			
				$login_data = $this->post();
				
				//$this->form_validation->set_data( $login_data  );
				
				//if( $this->form_validation->run('signIn') !== false){
					
					$this->load->model('web_services/user_model');
					$user_name = $this->extract_token($login_data['token']);
					$result = $this->user_model->get_by(array('username'=>$user_name));
					if(isset($login_data['change_status'])) {
						$update_data['status'] = 1;
						$where_data['username'] = $user_name;
						$user_id = $this->user_model->update_user($update_data, $where_data);
					}
					if( !$result ){
							
							$message = array();
							$message[] = "Unknown credential!"; 
							
							$this->response([ 'status' => 'failure', 'message' => $message ], REST_Controller::HTTP_NOT_FOUND); 
					
					}else{
							
							$response =  array( 'status'=>'success',  'message'=> "SignIn Successfully completed",
																	 'profile'=>$result,	'token'=>$this->token_gen( $result['username'] ) );		
							$this->response( $response );
							//$this->response( $result );
							
					}
				
				/*}else{
					$result =  array( 'status'=>'failure', 
														'message'=> array_values( $this->form_validation->get_errors_as_array())
													 );
					$this->response( $result ,REST_Controller::HTTP_BAD_REQUEST );
				
				}*/
		}

/* 		Get settings from token -POST
========================================================================*/
public function getsettings_post(){
			
					$this->load->model('web_services/settings_model');
					$result['settings'] = $this->settings_model->get_by(array('id'=>1));
					$this->response( $result );
				
		}

/* 		Get single shop details from id -POST
========================================================================*/
public function getsingleshop_post(){
			
				$post_data = $this->post();
				$this->load->model('web_services/shop_model');
				$this->load->model('web_services/user_model');
				$this->load->model('web_services/ad_model');
				
				$post['data'] = $this->shop_model->get_shop_details($post_data)->get_all();
				$post['review'] = array();
				if(!empty($post['data'])) {
				$post['review'] = $this->user_model->get_shop_reviews($post_data)->get_all();
				}
				
				$post['ad'] = array();
				if(!empty($post['data'])) {
				$post['ad'] = $this->ad_model->get_by(array('type'=>'shop'));
				}
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}


/* 		Get search page details -POST
========================================================================*/
		public function getsearchpage_post(){
			
				$this->load->model('web_services/shop_model');
				$post_data = $this->post();
				$post['shops'] = $this->shop_model->get_shops($post_data)->get_all();
				$post['services'] = $this->shop_model->get_services()->get_all();
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}

/* 		Autocomplete cityname -POST
========================================================================*/
		public function getcityname_post(){
			
				$this->load->model('web_services/shop_model');
				$post_data = $this->post();
				$post = $this->shop_model->get_cityname($post_data)->get_all();
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}

/* 		Autocomplete Shopname -POST
========================================================================*/
		public function getshopname_post(){
			
				$this->load->model('web_services/shop_model');
				$post_data = $this->post();
				$post = $this->shop_model->get_shopname($post_data)->get_all();
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}




/* 		Get search page details -POST
========================================================================*/
		public function gethomepage_post(){
			
				$this->load->model('web_services/shop_model');
				$this->load->model('web_services/testimonials_model');
				$this->load->model('web_services/whats_new_model');
				
				$post['services'] = $this->shop_model->get_services()->get_all();
				$post['cycle_slider'] = $this->shop_model->get_cycle_slider()->get_all();
				$post['testimonials'] = $this->testimonials_model->get_all();
				$post['whats_new'] = $this->whats_new_model->get_whats_new()->get_all();
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}


/* 		filter shop page -POST
========================================================================*/
		public function filtershops_post(){
			
				$this->load->model('web_services/shop_model');
				$post['services'] = $this->shop_model->get_services()->get_all();
				$post_data = $this->post();
				//$post['post_data'] = $post_data;
				$post['shops'] = $this->shop_model->filter_shops($post_data)->get_all();
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}


/* 		Book shop page -POST
========================================================================*/
		public function bookshop_post(){
			
				$this->load->model('web_services/shop_model');
				$post_values = $this->post();
				/*$post_data = $post_values;
				if(!is_array($post_values)) {
				parse_str($post_values,$post_data);
				}*/
				
				
				
				$post['result'] = $this->shop_model->book_shops($post_values);
				$post['shop_details'] = $this->shop_model->get_by(array('id'=>$post_values['shop_id']));
				
				//$post['query'] = $this->db->last_query();								 
				//$post['post_data'] = $post_values;
				$this->response( $post );
		}

/* 		Update user -POST
========================================================================*/
		public function updateuser_post(){
			
				$this->load->model('web_services/user_model');
				$user = $this->post();
				
				/*$post_data = $post_values;
				if(!is_array($post_values)) {
				parse_str($post_values,$post_data);
				}*/
				
				
				//$post['post_data'] = $user;
				$post['result'] = $this->user_model->update($user['id'], (array)$user);
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}

/* 		Get User Bookings -POST
========================================================================*/
		public function userbookings_post(){
			
				$this->load->model('web_services/shop_model');
				$user = $this->post();
				
				/*$post_data = $post_values;
				if(!is_array($post_values)) {
				parse_str($post_values,$post_data);
				}*/
				
				
				//$post['post_data'] = $user['user_id'];
				$post = $this->shop_model->get_user_bookings($user['user_id'])->get_all();
				
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );
		}

/* 		Book shop page -POST
========================================================================*/
		public function ratingshop_post(){
			
				$this->load->model('web_services/rating_model');
				$this->load->model('web_services/review_model');
				$post_values = $this->post();
				$post = array();
				if(!empty($post_values['rating'])) {
					$rate_values = $post_values;
					unset($rate_values['comments']);
					$rate_exist = $this->rating_model->get_by(array('booking_id'=>$rate_values['booking_id'], 'user_id'=>$rate_values['user_id']));
					if($rate_exist) {
						//$post['rating'] = $rate_exist;
						$this->rating_model->update($rate_exist['id'], (array)$rate_values);
					}
					else {
						array_walk($rate_values,"remove_html");
						//$post['rating'] = (array)$rate_values;
						$this->rating_model->insert($rate_values);
					}
					$post = "success";
				}
				
				if(!empty($post_values['comments'])) {
					$review_values = $post_values;
					unset($review_values['rating']);
					
					$review_exist = $this->review_model->get_by(array('booking_id'=>$review_values['booking_id'], 'user_id'=>$review_values['user_id']));
					//$post['review'] = $review_exist;
					if($review_exist) {
						$this->review_model->update($review_exist['id'], (array)$review_values);
					}
					else {
						array_walk($review_values,"remove_html");
						//$post['review'] = $review_values;
						$this->review_model->insert($review_values);
					}
					$post = "success";
				}
				
				//$post['query'] = $this->db->last_query();								 
				//$post['post_data'] = $post_values;
				$this->response( $post );
		}



/* 		Join POST
========================================================================*/
		public function join_post(){
				
				$this->load->model('web_services/user_model');
				//$this->load->model('web_services/booking_history_model');
				
				//$post = $this->user_model->with('booking_history')->get_all();
				$post = $this->user_model->get_booking()->get_all();
				
				// $post = $this->booking_history_model->with('user')
																 // ->get_by("id",1);
																 
				//$post['query'] = $this->db->last_query();								 
				
				$this->response( $post );								 
		}

//---------------------------------------------------END signIn----------------------------------------------------
		
		
		
		
/*							 COMMON FUNCTIONS
###########################################################################*/

	function token_gen($item){
		
		// $token = array();
		// $token['id'] = 1;
		return JWT::encode($item, APP_SECRET_KEY );
	
	}
	
	function extract_token($item){
		$token = JWT::decode($item, APP_SECRET_KEY );
		return $token;
	}	
		
		
}

//Book my saloon RESTful API using PHP & CodeIgniter
