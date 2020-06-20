<?php

class Home extends CI_Controller {

	public function index()
	{



        $template['page_title'] = "Accueil";
		$template['page_name'] = "home_page";

        if (isset($_SESSION['username'])) {
            $template['user_data'] = "show";
            $template['username'] = $_SESSION['username'];
        }


        $query = $this->db->query("SELECT * FROM services");
        $template['services'] = $query->result();

        $this->db->select('*');
        $this->db->from('user');
        $query1 = $this->db->get();
        $template['users'] = $query1->result();

		$template['hide_spinner'] = true;


		$this->load->view('template', $template);

	}
	
	public function signIn()
	{
        //get the posted values
        $username =  $_POST['username'];
        $password =  $_POST['password'];

        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query = $this->db->get();

        if ($query->num_rows()>0)
        {
            session_start();
            $_SESSION['username'] =$username;
           redirect(base_url());

        }else
            {
                echo "error";
            }

	}
	
	public function signUp()
	{
        $username =  $_POST['username'];
        $password =  $_POST['password'];
        $email =  $_POST['email_id'];
        $phone =  $_POST['phone_no'];

        $data = array(
            'username'=>$username,
            'password'=>$password,
            'email'=>$email,
            'phone'=>$phone
        );

        if ($data)
        {
            $this->db->insert('clients',$data);
            echo "success";
        }else{
            echo "error";
        }




	}

	public function forgotPwd()
	{
		$post_data = http_build_query($_POST);

		$url = $this->config->item('webservice_url')."forgotPwd";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);

		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);

		$result = json_decode($buffer);

		if($result) {
		if($result->status == "success") {
			$otp = $result->otp;
			unset($result->otp);
			//$_SESSION['otp'] = $otp;
			$this->session->set_userdata('user_otp', $otp);
			//$this->session->set_userdata('user_mobile', $_POST['phone_no']);
			$this->session->set_userdata('user_email', $_POST['email_id']);
			$msg = "Your new password is $otp. Please change your password next time you log in.";
			/*$mob_no = $_POST['phone_no'];
			$this->send_otp($msg, $mob_no);*/
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
				->to($_POST['email_id'])
				->subject('New Password')
				->message($msg, $data, true)
				->set_mailtype('html');


			// send email
			$this->email->send();
		}
		}
		else {
			$result = [ 'status' => 'failure',
								 'message' => array('An unexpected error occured while process') ];
		}
		echo json_encode($result);
		//$this->load->view('template', $template);
	}

	/*public function send_otp_again() {
		$otp = $this->session->userdata('user_otp');
		$msg = "Your bookmysalons.com verification code is $otp";
		$mob_no = $this->session->userdata('user_mobile');
		$this->send_otp($msg, $mob_no);
	}*/

	/*public function verify_otp() {
		$otp = $_POST['otp'];
		$otp_stored = $this->session->userdata('user_otp');
		if($otp == $otp_stored) {
			$post_data['token'] = $_POST['token'];
			$post_data['change_status'] = "true";
			$post_data = http_build_query($post_data);;
			$url = $this->config->item('webservice_url')."getuser";
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
			curl_setopt($curl_handle, CURLOPT_URL, $url);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_POST, 1);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);

			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			$result = json_decode($buffer);
			if($result) {
			if($result->status == "success") {
			$user_data = $result->profile;

			// Send Mail
			$this->load->library('email');
			// prepare email
			$data['name'] = $user_data->username;
			$this->email
				->from("no-reply@bookmysalons.com", "BookMySalons")
				->to($user_data->email_id)
				->subject('Welcome to BookMySalons')
				->message($this->load->view('register-email-template', $data, true))
				->set_mailtype('html');

			// send email
			$this->email->send();

			$this->session->unset_userdata('user_otp');
			}
			else {
				$result = [ 'status' => 'failure',
								 'message' => array('An unexpected error occured while process') ];
			}

			}
			else {
				$result = [ 'status' => 'failure',
								 'message' => array('An unexpected error occured while process') ];
			}

		}
		else {
			$message[] = "Invalid OTP";
			$result = array( 'status'=>'failure',  'message'=> $message);
		}
		echo json_encode($result);
	}*/

	public function login_success() {
		$v = $_POST;
		$profile = $v['profile'];
		$profile['token'] = $v['token'];
		$this->session->set_userdata('bms_userdata', $profile);

		delete_cookie('bms_usercookie');
		if($v['remember'] == '1') {
			$expire = time()+86500;
			$cookie= array(
				'name'   => 'bms_usercookie',
				'value'  => $profile['token'],
				'expire' => $expire,
			);

			$this->input->set_cookie($cookie);
		}
		var_dump($this->session->userdata('bms_userdata'));
	}

	/*public function send_otp($msg, $mob_no) {
		$sender_id="TWSMSG"; // sender id
		$pwd="968808";   //your SMS gatewayhub account password
		$str = trim(str_replace(" ", "%20", $msg));
		// to replace the space in message with  �%20�
		$url="http://api.smsgatewayhub.com/smsapi/pushsms.aspx?user=nixon&pwd=".$pwd."&to=91".$mob_no."&sid=".$sender_id."&msg=".$str."&fl=0&gwid=2";
		// create a new cURL resource
		$ch = curl_init();

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// grab URL and pass it to the browser
		$result = curl_exec($ch);
		// close cURL resource, and free up system resources
		curl_close($ch);
	}*/

	public function GetCityName(){
        $post_data['keyword']=$this->input->post('keyword');
		if(trim($post_data['keyword']) != "") {
        //$data=$this->mautocomplete->GetRow($keyword);
		$url = $this->config->item('webservice_url')."getcityname";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);

		$data = curl_exec($curl_handle);
		curl_close($curl_handle);
		 if($data) {
			echo $data;
		 }
		 else {
			 echo json_encode(array());
		 }
		}
		else {
			echo json_encode(array());
		}
    }
	public function GetShopName(){
        $post_data['keyword']=$this->input->post('keyword');
		if(trim($post_data['keyword']) != "") {
        //$data=$this->mautocomplete->GetRow($keyword);
		$url = $this->config->item('webservice_url')."getshopname";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);

		$data = curl_exec($curl_handle);
		curl_close($curl_handle);
		if($data) {
			echo $data;
		 }
		 else {
			 echo json_encode(array());
		 }
		}
		else {
			echo json_encode(array());;
		}
    }

	public function settings() {

		if(isset($_POST)) {
			$data = $_POST;
			if(isset($data['city'])) {
				$city = trim($data['city'])." ";
				$expire = time()+86500;
				$cookie= array(
					'name'   => 'bms_homecity',
					'value'  => $data['city'],
					'expire' => $expire,
				);

				$this->input->set_cookie($cookie);
				echo $city;
			}
		}
	}
	
}
