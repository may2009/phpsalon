<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	

	class Shop_model extends My_model{
		
		protected $_table = "shop_details";
		protected $primary_key = "id";
		protected $return_type = "array";
		
		public $has_many = array('booking_history_model');
		
		
		protected $after_get = array( "remove_sensitive_data" );
		protected $before_create = array( "prep_data" );
		
		protected function remove_sensitive_data($user){
			
			unset( $user['password'] );
			
			return $user;
			
		}
		
		protected function prep_data($user){
			$user['password'] = md5( $user['password'] );
			/*
			$user['ip_address'] 	= $this->input->ip-address();
			$user['created_date'] = date('Y-m-d H:i');
			*/
			return $user;
		}
		
		
		
		/* Custom Functions
		--------------------------------------------------------------------*/
/* Get city name
########################################################
--------------------------------------------------------*/		
		public function get_cityname($post_data){
				$this->db->distinct();
				$this->db->select('city');
				$this->db->order_by('id', 'DESC');
        		$this->db->like("city", $post_data['keyword']);
        		return $this;
		}


/* Get Shop name
########################################################
--------------------------------------------------------*/		
		public function get_shopname($post_data){
				$this->db->distinct();
				$this->db->select('shop_name, location');
				$this->db->order_by('shop_name', 'Asc');
        		$this->db->like("shop_name", $post_data['keyword']);
        		return $this;
		}


/* Get All Shop Details
########################################################
--------------------------------------------------------*/		
		public function get_shops($post_data){
				
				$user_id=$post_data['user_id']; 
				// ( 3959 * acos( cos( radians(10.0135593) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(76.3283873) ) + sin( radians(10.0135593) ) * sin( radians( latitude ) ) ) ) AS distance,
				
				$limit = 10;
				$page = 1;
				if(isset($post_data['page'])) {
				$page = $post_data['page'];
				}
				$start = ($page-1) * $limit;
				
				
			    $this->db->select('shop_details.id as id,
				  				   shop_details.shop_name,
								   shop_details.location,
								   shop_details.image,
								   shop_details.latitude,
								   shop_details.longitude,
								   count(distinct rating.id) as rating_count,
								   sum(rating.rating) as total_rating'
								 );
			    
				$this->db->join('rating', 'shop_details.id = rating.shop_id','left');
				
				if(isset($post_data['home_city']) and !empty($post_data['home_city'])) {
					$home_city = trim($post_data['home_city']);
					$this->db->where("(shop_details.location LIKE '%$home_city%' or shop_details.state LIKE '%$home_city%' or shop_details.city LIKE '%$home_city%')");
				}
				
				$this->db->group_by("shop_details.id");
       			$this->db->limit($limit, $start);
				//$this->db->having('distance < 2100');
				
				return $this;
		}
		
/* Filter All Shop Details
########################################################
--------------------------------------------------------*/		
		public function filter_shops($post_data){
				
				$limit = 10;
				$page = 1;
				if(isset($post_data['page'])) {
				$page = $post_data['page'];
				}
				$start = ($page-1) * $limit;
				$this->db->select('shop_details.id as id,
				  				   shop_details.shop_name,
								   shop_details.location,
								   shop_details.image,
								   shop_details.latitude,
								   shop_details.longitude,
								   count(distinct rating.id) as rating_count,
								   sum(rating.rating) as total_rating'
								 );
				$this->db->join('rating', 'rating.shop_id = shop_details.id','left');
				
				
				
				if(isset($post_data['services']) and !empty($post_data['services'])) {
					$this->db->join('shop_services as ss', 'ss.shop_id = shop_details.id','left');
					$this->db->where('ss.service_id',$post_data['services']);
				}
				
				if(isset($post_data['shopname']) and !empty($post_data['shopname'])) {
					$shopname = $post_data['shopname'];
					$this->db->where("shop_details.shop_name LIKE '%$shopname%'");
				}
				
				if(isset($post_data['location']) and !empty($post_data['location'])) {
					$location = $post_data['location'];
					$this->db->where("(shop_details.location LIKE '%$location%' or shop_details.state LIKE '%$location%' or shop_details.country LIKE '%$location%')");
				}
				
				if(isset($post_data['home_city']) and !empty($post_data['home_city'])) {
					$home_city = trim($post_data['home_city']);
					$this->db->where("(shop_details.location LIKE '%$home_city%' or shop_details.state LIKE '%$home_city%' or shop_details.city LIKE '%$home_city%')");
				}
				
				if(isset($post_data['offers']) && !empty($post_data['offers'])) {
					$offers = $post_data['offers'];
					$offer_min = min($offers);
					$offer_max = max($offers);
					$this->db->join('offers', 'offers.shop_id = shop_details.id','left');
					$this->db->where("offers.offers >= $offer_min");
				}
				
				if(isset($post_data['gender']) && !empty($post_data['gender'])) {
					$this->db->where_in('shop_details.category', $post_data['gender']);
				}
				
				$this->db->group_by("shop_details.id");
       			$this->db->limit($limit, $start);
				
				return $this;
		}

/* Get All Shop Serices
########################################################
--------------------------------------------------------*/		
		public function get_services(){
				
				$this->db->select('ms.id as id,
				  				   ms.service_name'
								 );
				$this->db->from("main_services as ms");
				$this->db->group_by("ms.id");
       
				return $this;
		}

/* Get Cycle Slider
########################################################
--------------------------------------------------------*/		
		public function get_cycle_slider(){
				
				$this->db->select('shop_details.id,
								   shop_details.shop_name,
								   shop_details.image'
								 );
				$this->db->join('cycle_slider as cs', 'cs.shop_id = shop_details.id');
				$this->db->group_by("shop_details.id");
       
				return $this;
		}

				
				
/* Get Single Shop Details
########################################################
--------------------------------------------------------*/
		public function get_shop_details($post_data) {
			
			$user_id=$post_data['user_id'];
			if($user_id){
			$this->db->select('shop_details.*,
				               fav_shops.shop_id as shid,
					           fav_shops.id as favid,
					           fav_shops.user_id as uid,
							   count(distinct rating.id) as rating_count,
							   sum(rating.rating) as total_rating,
							   GROUP_CONCAT(distinct CONCAT_WS("<#>",rating.id, rating.rating) SEPARATOR " <=> ") as ratings,
							   GROUP_CONCAT(distinct CONCAT_WS("<#>",ms.service_name, ss.id, ss.price) SEPARATOR " <=> ") as services,
							   GROUP_CONCAT(distinct gl.image_path SEPARATOR " <=> ") as gallery'
							  );

			}else{
			$this->db->select('shop_details.*,
							   count(distinct rating.id) as rating_count,
							   sum(rating.rating) as total_rating,
							   GROUP_CONCAT(distinct CONCAT_WS("<#>",rating.id, rating.rating) SEPARATOR " <=> ") as ratings,
							   GROUP_CONCAT(distinct CONCAT_WS("<#>",ms.service_name, ss.id, ss.price) SEPARATOR " <=> ") as services,
							   GROUP_CONCAT(distinct gl.image_path SEPARATOR " <=> ") as gallery'
							  );

			}
			$this->db->join('rating', 'rating.shop_id = shop_details.id','left');
			$this->db->join('shop_services as ss', 'ss.shop_id = shop_details.id','left');
			$this->db->join('main_services as ms', 'ms.id = ss.service_id','left');
			$this->db->join('shop_gallery as gl', 'gl.shop_id = shop_details.id','left');

            if($post_data['user_id']){ 
				$this->db->join('fav_shops', 'fav_shops.shop_id = shop_details.id and fav_shops.user_id ='.$user_id,'left');
			}
			
			$this->db->where('shop_details.id',$post_data['id']);
			if(isset($post_data['name1']) && !empty($post_data['name1'])) {
				$this->db->like('shop_details.shop_name',$post_data['name1']);
			}
			if(isset($post_data['name2']) && !empty($post_data['name2'])) {
				$this->db->like('shop_details.shop_name',$post_data['name2']);
			}
			$this->db->group_by("shop_details.id");
			
			return $this;
		}

/* Get Single Shop Details
########################################################
--------------------------------------------------------*/
		public function get_user_bookings($user_id) {
			//var_dump($user_id);
			$this->db->select('shop_details.id as shop_id, shop_details.shop_name, shop_details.image as shop_image,
							   bh.id as booking_id, bh.booking_id as booking_order_id, bh.booking_date, bh.booking_time, bh.total,
							   rating.rating, review.comments,
							   GROUP_CONCAT(distinct ms.service_name SEPARATOR " <=> ") as services'
							  );
			
			$this->db->join('booking_history as bh', 'bh.shop_id = shop_details.id', 'left');
			$this->db->join('booking_details as bd', 'bd.booking_id = bh.id','left');
			$this->db->join('shop_services as ss', 'ss.id = bd.service_id','left');
			$this->db->join('main_services as ms', 'ms.id = ss.service_id','left');
			$this->db->join('rating', 'rating.booking_id = bh.id', 'left');
			$this->db->join('review', 'review.booking_id = bh.id', 'left');
			
			
			$this->db->where('bh.user_id',$user_id);
			$this->db->group_by("bh.id");
			$this->db->order_by("bh.id", "desc");
			
			return $this;
		}

/* Insert Booking Details
########################################################
--------------------------------------------------------*/
		public function book_shops($post_data) {
			$datetime = explode(" ", $post_data['datetime']);
			$date = $datetime[0];
			$time = $datetime[1];
			
			$return_data = $post_data;
			
			$services = $post_data['services'];
			unset($post_data['services']);
			unset($post_data['shop_name']);
			unset($post_data['datetime']);
			
			$post_data['booking_date'] = date("Y-m-d", strtotime($date));
			$post_data['booking_time'] = date("g:i A", strtotime($time));
			$post_data['status'] = 'Booked';
			
			// Insert Booking History
			
			$this->db->insert('booking_history', $post_data);
   			$booking_id = $this->db->insert_id();
			
			$booking_order_id = "BMS".$post_data['user_id'].$post_data['shop_id'].$booking_id;
			
			
			$total = 0;
			$service_insert = array();
			if(isset($services)) {
				foreach($services as $service_details) {
					$service = explode("<#>",$service_details);
					
					$total += $service[2];
					$service_array['booking_id'] = $booking_id;
					$service_array['service_id'] = $service[1];
					$service_array['price'] = $service[2];
					$service_insert[] = $service_array;
				}
			}
			
			// Update booking total
			
			$data = array(
               'total' => $total,
			   'booking_id' => $booking_order_id
            );

			$this->db->where('id', $booking_id);
			$this->db->update('booking_history', $data);
			
			// Insert booking details - Services
			
			$this->db->insert_batch('booking_details', $service_insert);
			
			$return_data['booking_order_id'] = $booking_order_id;
			
			return $return_data;
		}

/* booking confirmation
########################################################
--------------------------------------------------------*/
		public function finalbook($post_data) {
			
			$datetime = explode(" ", $post_data['datetime']);
			$date = $datetime[0];
			$time = $datetime[1];
			
			$return_data = $post_data;
			$servcid =explode(",",$post_data['service_id']);
			unset($post_data['datetime']);
			unset($post_data['service_id']);
			unset($post_data['booking_order_id']);
			
			$post_data['booking_date'] = date("Y-m-d", strtotime($date));
			$post_data['booking_time'] = date("g:i A", strtotime($time));
			$post_data['status'] = 'Booked';
			
			// Insert Booking History
			//var_dump($post_data);
			$this->db->insert('booking_history', $post_data);
			/*echo $this->db->last_query();
			die();*/
   			$booking_id = $this->db->insert_id();
			$booking_order_id = "BMS".$post_data['user_id'].$post_data['shop_id'].$booking_id;
			
			
			
			$total = $post_data['total'];
			$service_insert = array();
			
			foreach ($servcid as $service_id) {
					
				$service_array['booking_id'] = $booking_id;
				$service_array['service_id'] = $service_id;
				$service_array['price'] = $post_data['total'];
				$service_insert[] = $service_array;
				//var_dump($service_insert[]);
			}	
			// Update booking total
			
			$data = array(
               'total' => $total,
			   'booking_id' => $booking_order_id
            );

			$this->db->where('id', $booking_id);
			$this->db->update('booking_history', $data);
			
			$this->db->insert_batch('booking_details', $service_insert);
			
			$return_data['booking_order_id'] = $booking_order_id;
			
			return $return_data;
		}
/* Insert Rating Details
########################################################
--------------------------------------------------------*/
		public function rate_shops($post_data) {
			
			
			// Insert Booking History
			
			$this->db->insert('rating', $post_data);
			return "success";
		}

/* Popularity
########################################################
--------------------------------------------------------*/
		public function sorting($post_data) {
			
			if($post_data['condition']=="popularity"){

			    $this->db->select('shop_details.*,
			    	               count(distinct rating.id) as rating_count,
								   sum(rating.rating) as total_rating,
	                               rating.id as rid,
					  			   (AVG(rating.rating)) as popularity'
						          );
	            $this->db->join('rating','rating.shop_id = shop_details.id','left');
	            $this->db->where('shop_details.city',$post_data['city']);
	            $this->db->group_by("rating.shop_id");
				$this->db->order_by("popularity",'DESC');

				return $this;
			
			}elseif ($post_data['condition']=="discount") {
				
				
				$this->db->select('shop_details.*,
					               offers.id as ofid,
					               offers.shop_id as ofshop_id,
			    	               count(distinct rating.id) as rating_count,
								   sum(rating.rating) as total_rating,
	                               rating.id as rid,
					  			   (AVG(offers.offers)) as ofrs'
						          );
	            
	            $this->db->join('offers', 'offers.shop_id = shop_details.id','left');
	            $this->db->join('rating','rating.shop_id = offers.shop_id','left');
	            $this->db->where('shop_details.city',$post_data['city']);
	            $this->db->group_by("offers.shop_id");
				$this->db->order_by("ofrs",'DESC');

				return $this;

			}else{

				
                $this->db->select('shop_details.*,
			    	               count(distinct rating.id) as rating_count,
								   sum(rating.rating) as total_rating,
	                               rating.id as rid,
	                               rating.shop_id as rshopid'
						          );
                $this->db->join('rating','rating.shop_id = shop_details.id','left');
                $this->db->where('shop_details.city',$post_data['city']);
	            $this->db->order_by('shop_details.id','DESC');
	            $this->db->group_by("rating.shop_id");
	            
				return $this;


			}	


		}		
	
}
	

	
	
?>