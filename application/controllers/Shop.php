<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		check_installer();
		//$this->load->model('booking_model');
 	}
	
	public function view()
	{
		$template['page_title'] = "Book";
		$template['page_name'] = "single_shop";
		
		$id = $this->uri->segment(3);
		$params = explode("-",$id);
		$post_data['id'] = $params[count($params)-1];
		if(count($params) > 1) {
		$post_data['name1'] = $params[count($params)-2];
		}
		if(count($params) > 2) {
		$post_data['name2'] = $params[count($params)-3];
		}
		
		$url = $this->config->item('webservice_url')."getsingleshop";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		 
		$result = json_decode($buffer);
		/*var_dump($result);
		exit;*/
		$template['id'] = $id;
		$template['data'] = $result;
		
		$this->load->view('template', $template);
	}
	
	public function book()
	{
		$template['page_title'] = "Book";
		$template['page_name'] = "book_shop";
		
		$id = $this->uri->segment(3);
		$params = explode("-",$id);
		$post_data['id'] = $params[count($params)-1];
		if(count($params) > 1) {
		$post_data['name1'] = $params[count($params)-2];
		}
		if(count($params) > 2) {
		$post_data['name2'] = $params[count($params)-3];
		}
		
		$url = $this->config->item('webservice_url')."getsingleshop";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		 
		$result = json_decode($buffer);
		
		$template['id'] = $id;
		$template['data'] = $result;
		/*var_dump($result);
		exit;*/
		$this->load->view('template', $template);
	}
	
	public function book_shops()
	{

		$user_data = is_logged();
		if(isset($user_data)) {
		
		$post_data = $_POST;
		//var_dump($post_data);
		//exit;
		if(!empty($post_data['datetime'])) {
			$datetime = explode(" ", $post_data['datetime']);
			$date = $datetime[0];
			$time = $datetime[1];
		}
		else {
			$date = date("d-m-Y");
			$time = date('H')+1 . ":00";
		}
		
		$date = date("D, jS M, Y", strtotime($date));
		$time = date("g:i A", strtotime($time));
		
		$services = $price = '<div class="col-md-6">';
		$total = 0;
		if(isset($post_data['services'])) {
			foreach($post_data['services'] as $service_details) {
				$service = explode("<#>",$service_details);
				
				$total += $service[2];
				$services .= '<h4>'.strtoupper($service[0]).'</h4>';
				$price .= '<h4>&#x20B9; &nbsp;'.number_format($service[2],2).'</h4>';
			}
		}
		
		$services .= '</div>';
		$price .= '</div>';
		
		$html = '';
		
		$html = '<div class="row">
          <div class="booking-details">
              <div class="col-lg-6">
                  <div class="booking-appointment-details">
                      <h2>APPOINMENT DETAILS</h2>
                      <h3>'.strtoupper($post_data['shop_name']).'</h3>
                      <div class="row padding-top20 padding-bottom65">
                          <div class="col-md-6">
                              
                              <h4 class="bold-class">DATE</h4>
                              <p>'.$date.' </p>
                          </div>
                          <div class="col-md-6">
                              
                                <h4 class="bold-class">TIME</h4>
                              <p>'.$time.'</p>
                          </div>
                      </div>
                      <h3>PERSONEL DETAILS</h3>
                       <div class="row">
                          <div class="col-md-6">
                              <p><img src="'.base_url().'assets/images/booking-message.png">&nbsp;'.$user_data['email_id'].'</p>
                          </div>
                          <div class="col-md-6">
                              <p><img src="'.base_url().'assets/images/booking-phone.png">&nbsp;'.$user_data['phone_no'].'</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6" >
                  <div class="booking-payment-details">
                      <h2>PAYMENT DETAILS</h2>
                      <h3>PRICE DETAILS</h3>
                      <div class="row padding-top20 padding-bottom20">
                      '.$services.$price.'
					  
					  </div>
                      <hr>
                      
                      
                       <div class="row">
                          <div class="col-md-6">
                              
                              <h3>SUB TOTAL</h3>
                              <h3>INTERNET HANDILING CHARGES</h3>
                          </div>
                          <div class="col-md-6">
                              
                                <h3>&#x20B9; &nbsp;'.number_format($total,2).'</h3>
                              <h3> &nbsp; &nbsp;  FREE</h3>
                          </div>
                      </div>
                  </div>
              </div>
             
          </div>
          
    </div>
           <div class="row">
                  <div class="booking-hr"></div>
               <div class="row">
               <div class="col-lg-6">
                   </div>
               <div class="col-lg-6 padding0">
                   <div class="col-md-6">
                   <h3>TOTAL CHARGES</h3>
                   </div>
                   <div class="col-md-6">
                   <h3 class="font-red">&#x20B9;&nbsp; '.number_format($total,2).'</h3></div>
                   </div>
               </div>
              </div>
    
         <div class="row">
                  <div class="booking-hr"></div>
             <div class="row booking-confirm-buttons">
                 <div class="col-lg-7">
                 </div>
                 <div class="col-lg-5">
					 <div class="col-md-6">
					 	<input type="submit" value="CHANGE BOOKING" id="change-booking" class="viewprflbook-btn" style="float:left;">
					 </div>
                    <div class="col-md-6">
                         <input type="submit" value="PROCEED TO CHECKOUT" id="checkout" class="viewprflbook-btn" style="float:left;">
						 
                     </div>
                 </div>
             </div>
             </div>';
			 
			 echo $html;
		}
}
	public function checkout_shops()
	{
		
		if(empty($_POST['datetime'])) {
			$date = date("Y/m/d");
			$time = date("H")+1 . ":00";
			$_POST['datetime'] = $date . " " . $time;
		}
		$post_data = http_build_query($_POST);
		
		$url = $this->config->item('webservice_url')."bookshop";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		 
		$booking_result = json_decode($buffer);
		if($booking_result) {
		$user_data = is_logged();
		if(isset($user_data)) {
			
			$result = $booking_result->result;
			$shop_details = $booking_result->shop_details;
			
			$datetime = explode(" ", $result->datetime);
			$date = $datetime[0];
			$time = $datetime[1];
			$booking_date = date("l jS M Y", strtotime($date));
			$booking_time = date("g:i A", strtotime($time));
			
			/*$msg = "Hi ".$user_data['username'].", Your appointment at ".$result->shop_name." on ".$booking_date." at ".$booking_time." is confirmed. Please show your booking code ".$result->booking_order_id." at the venue. Enjoy our services.";
			$mob_no = $user_data['phone_no'];
			$this->send_otp($msg, $mob_no);*/
			
			// Send Booking mail
			
			$data['user_details'] = $user_data;
			$data['booking_details'] = $result;
			$data['shop_details'] = $shop_details;
			$this->session->set_userdata('booking_test', $data);
			
			
			$settings = get_settings();
			
			$configs = array(
			'protocol'=>'smtp',
			'smtp_host'=>$settings->smtp_host,
			'smtp_user'=>$settings->smtp_username,
			'smtp_pass'=>$settings->smtp_password,
			'smtp_port'=>'587'
			);
			
			$this->load->library('email', $configs);
			$this->email->set_newline("\r\n");
			// prepare email
			$this->email
				->from($settings->admin_email, $settings->title)
				->to($user_data['email_id'])
				->subject('Booking Confirmed')
				->message($this->load->view('booking-email-template', $data, true))
				->set_mailtype('html');
			
			// send email
			$this->email->send();
			
			
		}
		}
		else {
			$result = "error";
		}
		$html = '<div class="error"><div>Sorry, Error Occured. Please Try Again. </div></div>';
		if($result != "error") {
			$html = '<div class="success"><div>Your booking was saved successfully. <h4> Booking id : '.$result->booking_order_id.'</h4></div></div>';
		}
		echo $html;
		
	}
	
	/*public function send_otp($msg, $mob_no) {
		$sender_id="TWSMSG"; // sender id	
		$pwd="968808";   //your SMS gatewayhub account password	
		$str = trim(str_replace(" ", "%20", $msg));
		// to replace the space in message with  ‘%20’
		$url="http://api.smsgatewayhub.com/smsapi/pushsms.aspx?user=nixon&pwd=".$pwd."&to=91".$mob_no."&sid=".$sender_id."&msg=".$str."&fl=0&gwid=2";
		// create a new cURL resource
		$ch = curl_init();
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// grab URL and pass it to the browser
		$otp_result = curl_exec($ch);
		//var_dump($otp_result);
		// close cURL resource, and free up system resources
		curl_close($ch);
	}*/
	
	public function rating_shops()
	{
		$data = $_POST;
		$user_data = $_POST['shop'];
		$shop_data = explode("-", $user_data);
		
		$post_data['user_id'] = $shop_data[0];
		$post_data['shop_id'] = $shop_data[1];
		$post_data['rating'] = $data['rat'];
		
		
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
		
		//var_dump($result);
		//exit;
		$html = 'Sorry, Error Occured. Please Try Again.';
		if($result == "success") {
			$html = 'Thank you for your Feedback';
		}
		echo $html;
		
	}
	
}
