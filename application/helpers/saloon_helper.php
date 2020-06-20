<?php
function check_installer(){
  
  $file = "INSTALLER_TRUE.php";
    if(file_exists($file)){
        redirect(base_url().'Installer/installer.php');
    } 
}
function remove_html(&$item, $key)
{
    $item = strip_tags($item);
}
function is_logged() {
	$CI = & get_instance();
	$user_session = $CI->session->userdata('bms_userdata');
	/*var_dump($user_session);
	exit;*/
	if(!$user_session or !$user_session['token']) {
		$user_cookie = get_cookie('bms_usercookie');
		/*var_dump($user_cookie);
		exit;*/
		if($user_cookie) {

			$user_session = get_user($user_cookie);
			$CI->session->set_userdata('bms_userdata', $user_session);
		}
	}
	return $user_session;
}

function get_security_key() {
	$CI = & get_instance();
	$security_key = $CI->config->item('security_key');
	return $security_key;
}

function get_user($token) {
	$CI = & get_instance();
	$post_data['token'] = $token;
	$url = $CI->config->item('webservice_url')."getuser";
	$security_key = $CI->config->item('security_key');
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.$security_key));
	curl_setopt($curl_handle, CURLOPT_URL, $url);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_POST, 1);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
	 
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	 
	$result = json_decode($buffer);
	$user_session = (array)$result->profile;
	$user_session['token'] = $result->token;
	return $user_session;
}


/* Get Settings */
function get_settings() {
	$CI = & get_instance();
	$url = $CI->config->item('webservice_url')."getsettings";
	$security_key = $CI->config->item('security_key');
	$post_data['test'] = 'test';
	$curl_handle = curl_init();
	curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.$security_key));
	curl_setopt($curl_handle, CURLOPT_URL, $url);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_POST, 1);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
	 
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	 
	$result = json_decode($buffer);
	//$CI->session->set_userdata('edmlead_settings',$settings);
	return $result->settings;
}
?>
