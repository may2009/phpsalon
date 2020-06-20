<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		check_installer();
		//$this->load->model('booking_model');
 	}
	
	public function index()
	{
		$template['page_title'] = "Search";
		$template['page_name'] = "search_results";
		$template['hide_spinner'] = true;
		
		$url = $this->config->item('webservice_url')."getsearchpage";
		if(isset($_POST) and !empty($_POST)) {
			$post_data = $_POST;
			$url = $this->config->item('webservice_url')."filtershops";
		}
		$post_data['page'] = 1;
		$home_city = get_cookie('bms_homecity');
		if($home_city) {
			$post_data['home_city'] = $home_city;
		}
		/*echo $url;
		var_dump($post_data);*/
		
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		$template['post_data'] = $post_data;
		$template['data'] = json_decode($buffer);
		
		/*print_r($template);
		exit;*/
		
		
		$this->load->view('template', $template);
	}
	
	public function filter_shops()
	{

		$post_data = $_POST;
		$home_city = get_cookie('bms_homecity');
		if($home_city) {
			$post_data['home_city'] = $home_city;
		}
		$post_data = http_build_query($post_data);
		/*var_dump($post_data);
		exit;*/
		
		$url = $this->config->item('webservice_url')."filtershops";
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-API-KEY: '.get_security_key()));
		//curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_POST, TRUE);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
		 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		 
		$result = json_decode($buffer);
		/*var_dump($result);
		exit;*/
		
		/// Display filter values
		$html = "";
		$map_data = array();
		$user_data = is_logged();
			
		if(isset($result->shops)) {
		foreach($result->shops as $shop) {
			$rating_class='id="custom-user-login"';
			if(isset($user_data)) {
				$rating_class='id="custom-user-rating" data-shop="'.$user_data['id']."-".$shop->id.'"';
			}
			$id = $shop->id;
			$url = base_url()."shop/view/".str_replace(" ","-",strtolower($shop->shop_name))."-".$shop->id;
			if($shop->rating_count) { 
				$rating = number_format($shop->total_rating / $shop->rating_count,1); 
			} 
			else {
				$rating = "0";
			}
			
			$rating = "0";
			if($shop->rating_count > 0) {
				$rating = number_format($shop->total_rating / $shop->rating_count,1);
			}
			
			$map_data[] = '{ "DisplayText": "'.$shop->shop_name.'", "Location": "'.$shop->location.'", "LatitudeLongitude": "'.$shop->latitude.','.$shop->longitude.'"}';
			
			$html .= '<li>
              <div class="row">
                <div class="col-md-5"> <img class="shopimage" src="'.$shop->image.'" alt="'.$shop->shop_name.'"> </div>
                <div class="col-md-7">
                  <h1> '.$shop->shop_name.' </h1>
                  <div class="search-result-sparator"></div>
                  <div class="search-result-loction"> '.$shop->location.' </div>
                  <div class="starss">
                    <div class="raty" data-read="true" data-rate="'.$rating.'"></div>
                  </div>
                  <!--end ratting-->
                  <div class="search-result-ratingbtm">
                    <div class="col-md-4 search-result-rating-txt"> '.$shop->rating_count.' Ratings
                      <div class="search-result-rating">'.$rating.'</div>
                    </div>
                    <div class="col-md-8">
                      <p class="fieldset">
                        <a href="'.$url.'" class="viewprflbook-btn btn">VIEW PROFILE & BOOK</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </li>';
		}
		if(count($result->shops) > 9) {
		if(!isset($_POST['loadmore'])) {
		$html .= '<div class="load_more_shops"></div>
            	<div class="col-md-12 load-more-button" style="text-align:center">
                      <div class="col-md-6">
                        <a href="javascript:void(0);" class="viewprflbook-btn btn" id="load-more">Load More</a>
                      </div>
                    </div>';
		}
	}
	}
	else {
		$html = '<div class="message"><div class="error"><div>Sorry, No shops found. Please try with different keywordsss. </div></div></div>';
	}
	$maps = '['.implode(",", $map_data).']';
	
	$return_data=array('html'=>$html,'map_data'=>$maps);

	header('Content-Type: application/json');
	echo json_encode($return_data);
	//echo $html;
}
	
}
