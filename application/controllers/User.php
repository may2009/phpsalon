
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		check_installer();

		//$this->load->model('booking_model');
 	}
	
	public function profile()
	{
		$template['page_title'] = "Profile";
		$template['page_name'] = "user-profile";
        if (isset($_SESSION['username'])) {
            $template['user_data'] = "show";
            $template['username'] = $_SESSION['username'];
        }

        $query = $this->db->query("SELECT * FROM clients where username = '".$_SESSION['username']."'");
        $template['usrconnect'] = $query->row();

		$this->load->view('template', $template);
	}
	
	private function set_upload_options() {   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'assets/uploads/profile_pic';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '5000';
		$config['overwrite']     = FALSE;
	
		return $config;
	}
	
	public function change_password() {
		$user_session = $this->session->userdata('bms_userdata');
		if($_POST) {
			$data = $_POST;
			$user_typed_password = md5($data['old_password']);
			if($user_typed_password == $user_session['password']) {
				if($data['new_password'] == $data['confirm_password']) {
				
					$post_data['id'] = $user_session['id'];
					$post_data['password'] = md5($data['new_password']);
					
					$url = $this->config->item('webservice_url')."updateuser";
					$curl_handle = curl_init();
					curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
					curl_setopt($curl_handle, CURLOPT_URL, $url);
					curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl_handle, CURLOPT_POST, 1);
					curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
					 
					$buffer = curl_exec($curl_handle);
					curl_close($curl_handle);
					 
					$result = json_decode($buffer);
					
					$token = $user_session['token'];
					$user_session = get_user($token);
					$user_session['token'] = $token;
					$this->session->set_userdata('bms_userdata', $user_session);
					$html = '<div class="success"><div>Password updated successfully. </div></div>';
				}
				else {
					$html = '<div class="error"><div>Password doesn\'t match. </div></div>';
				}
			}
			else {
				$html = '<div class="error"><div>Please enter valid password. </div></div>';
			}
		}
		else {
			$html = '<div class="error"><div>Sorry, Error Occured. </div></div>';
		}
		echo $html;
		
	}
	
	public function bookings() {
		
		$template['page_title'] = "Bookings";
		$template['page_name'] = "user-bookings";
		
		$user_session = $this->session->userdata('bms_userdata');
		
		$url = $this->config->item('webservice_url')."userbookings";
		$post_data['user_id'] = $user_session['id'];
		
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$template['data'] = json_decode($buffer);
		//var_dump($template['data']);
		$template['user'] = $user_session;
		$this->load->view('template', $template);
	}
	
	public function rating_shops()
	{
		$post_data = $_POST;
		
		$user_session = $this->session->userdata('bms_userdata');
		$post_data['user_id'] = $user_session['id'];
		$post_data['rating'] = $post_data['score'];
		unset($post_data['score']);
		//var_dump($post_data);		
		$url = $this->config->item('webservice_url')."ratingshop";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		 
		$result = json_decode($buffer);
		
		$html = '<div class="success"><div>Thank you for your feedback</div></div>';
		//var_dump($result);
		//exit;
		if(empty($result)) {
			$html = '<div class="error"><div>Sorry, Error occured. Please try again.</div></div>';
		}
			
		$return_data=array('html'=>$html,'booking_id'=>$post_data['booking_id']);

		header('Content-Type: application/json');
		echo json_encode($return_data);
		//echo $html;
		
	}
	
}
