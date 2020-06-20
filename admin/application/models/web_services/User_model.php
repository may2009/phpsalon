<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	

	class User_model extends My_model{
		
		//protected $_table = "users";
		protected $primary_key = "id";
		protected $return_type = "array";
		
		public $has_many = array('booking_history_model');
		
		
		protected $after_get = array( "remove_sensitive_data" );
		protected $before_create = array( "prep_data" );
		
		protected function remove_sensitive_data($user){
			
			//unset( $user['password'] );
			//unset( $user['id'] );
			
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
		
		public function login($login_data)
    {
        $this->db->where("(email_id = '$login_data[username]' OR username = '$login_data[username]' OR phone_no = '$login_data[username]' )");
				$this->db->where('password', md5($login_data['password']));
				

        return $this;
    }
	
	public function insert_services($services) {
		$this->db->insert_batch('mytable', $services); 
		return $this;
	}
	
	public function update_user_app($update_data, $where_data) {

		//print_r($update_data);
		//$this->db->where($where_data);
		$this->db->where('id',$where_data);
		$this->db->update('users', $update_data); 		
		return $this;
	}
	public function update_user($update_data, $where_data) {

		//print_r($update_data);
		$this->db->where($where_data);
		$this->db->update('users', $update_data); 		
		return $this;
	}
	
	/*public function update_user($post_data) {
		$this->db->where('id', $post_data['id']);
		$this->db->update('users', $post_data); 
		return $this;
	}*/
		
		
		/* Join Queries
		--------------------------------------------------------------------*/
		
		public function get_booking(){
				$this->db->select('users.*, booking_history.*');
        $this->db->join('booking_history', 'booking_history.user_id = users.id');
       
				
				 return $this;
		}

/* Get Single Shop Review Details
########################################################
--------------------------------------------------------*/
		public function get_shop_reviews($post_data) {
			
			$id = $post_data['id'];
			$this->db->select('review.comments, users.username, users.firstname, users.lastname, users.profile_pic, count(distinct rating.id) as rating_count, sum(rating.rating) as total_rating');
			//$this->db->from('users');
			$this->db->join('review', "users.id = review.user_id and review.shop_id='$id'",'left');
			$this->db->join('rating', "users.id = rating.user_id and rating.shop_id='$id'",'left');
			$this->db->where('review.shop_id', $id);
			$this->db->or_where('rating.shop_id', $id);
			$this->db->group_by("users.id, review.user_id, rating.user_id, review.id, rating.shop_id");
			
			return $this;
		}

/* favourite shop
########################################################
--------------------------------------------------------*/
		public function fav_shop($post_values){  
       
        
	       $this->db->from('fav_shops');
	       $this->db->where('user_id',$post_values['user_id']);
	       $this->db->where('shop_id',$post_values['shop_id']);
	       $query=$this->db->count_all_results();
	        
	        if($query=='0'){
	            $this->db->insert('fav_shops',$post_values); 
	           
	           return "value";
	        }else{
	           $this->db->where('user_id',$post_values['user_id']);
	           $this->db->where('shop_id',$post_values['shop_id']);
	           $this->db->delete('fav_shops');

	           return "novalue";
            }
        }


/* user favourite shop list
########################################################
--------------------------------------------------------*/ 

        public function fav_shop_list($post_values){  
            
			$this->db->select('fav_shops.*,
				               rating.shop_id as rshopid,
				               rating.rating,
				               shop_details.id as shid,
				  			   shop_details.shop_name,
							   shop_details.location,
							   shop_details.image,
							   shop_details.latitude,
							   shop_details.longitude'
							   
				               );
			$this->db->from("shop_details");
			$this->db->join('fav_shops','fav_shops.shop_id = shop_details.id','left');
			$this->db->join('rating', 'shop_details.id = rating.shop_id','left');
			$this->db->where('fav_shops.user_id',$post_values['user_id']);
		    
		    return $this;

        }       
		
	}
	
	
	
?>