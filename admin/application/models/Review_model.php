<?php 

class Review_model extends CI_Model {
	
	public function _consruct(){
		parent::_construct();
 	}
	
	function get_reviews() {
		
		
		$this->db->select('shop_details.id, shop_details.shop_name, count(distinct review.id) as review_count, count(distinct rating.id) as rating_count, sum(distinct rating.rating) as total_rating');
		$this->db->from('shop_details');
		$this->db->join('review', 'shop_details.id = review.shop_id','left');
		$this->db->join('rating', 'shop_details.id = rating.shop_id','left');
		
		$menu = $this->session->userdata('admin');
	 	if($menu!='1'){
			$user = $this->session->userdata('id');
			$this->db->where('shop_details.created_user', $user);
		}
		$this->db->group_by("shop_details.id"); 
	
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function get_shop_reviews($id) {
		$this->db->select('review.comments, users.username, users.firstname, users.lastname, count(distinct rating.id) as rating_count, sum(distinct rating.rating) as total_rating');
		$this->db->from('users');
		$this->db->join('review', "users.id = review.user_id and review.shop_id='$id'",'left');
		$this->db->join('rating', "users.id = rating.user_id and rating.shop_id='$id'",'left');
		$this->db->where('review.shop_id', $id);
		$this->db->or_where('rating.shop_id', $id);
		$this->db->group_by("users.id, review.user_id, rating.user_id, review.id");
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
}