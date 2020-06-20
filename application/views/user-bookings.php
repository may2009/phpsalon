<?php
$username = htmlentities($user['firstname']). " " . htmlentities($user['lastname']);
if($username == " ") {
	$username = $user['email_id'];
}

$user_pic = $user['profile_pic'];
if($user_pic == "") {
	$user_pic = base_url()."assets/images/avatar.png";
}
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
        <h4 class="modal-title booking-profile-popup" id="myModalLabel">Rate and Review us</h4>
      </div>
      <form id="ratingsForm">
      <div class="modal-body">
	  <div class="booking-profile-popup-content">
	    
      <div class="booking-profile-popup-content-ratting">
	    <h3>How much will you rate us?</h3>
		<br>
          
        <div class="booking-profile-popup-starss">
            <div id="rating" class="raty" data-read="false" data-rate="0"></div>
         </div>
	  </div><br>
      
	  <div class="booking-profile-popup-content-review">
      <input type="hidden" name="booking_id" id="booking_id" value="" />
      <input type="hidden" name="shop_id" id="shop_id" value="" />
	  <textarea id="review" class="booking-profile-popup-content-review-textarea" name="comments" rows="2" cols="50" placeholder="Add your valuable comments and feedbacks.."></textarea>
	  </div>
	  </div>
          <div class="message">
          </div>
      </div>
      <div class="modal-footer align-center">
        <a href="javascript:void(0);" class="btn booking-profile-popup-button feedback">Submit</a>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="profile-main">
         	<div class="profile-main-bg">
         		
                <div class="col-md-2">
                	<div class="prfl-pic" style="background-image:url(<?php echo $user_pic; ?>)">
                	</div>
                </div>
            	<div class="col-md-9">
                	<div class="booking-profile">
            			<div class="row">
                 			<div class="booking-profile-name"><?php echo $username; ?></div>
                		</div>
                        <div class="row">
                        <div class="booking-profile-number"><?php echo $user['phone_no']; ?></div>
                        </div>
                        
             		</div>
          		</div>
			 	<div class="col-md-1">
			 		<div class="booking-profile-logo"><img src="<?php echo base_url(); ?>assets/images/bms-white-logo.png"></div>
			 	</div>
		
         	</div>
        </div>
    </div>
    <?php
	if($data) {
	foreach($data as $booking) {
	$rating = 0;
	$review = '';
	if($booking->rating) {
		$rating = $booking->rating;
	}
	if($booking->comments) {
		$review = $booking->comments;
	}
	?>
    <li>
        <div class="row">
            <div class="booking-profile-wrap">
                <div class="col-md-5">
                    <div class="booking-profile-shop-ratting" style="background-image:url(<?php echo $booking->shop_image; ?>)">
                        <a href="javascript:void(0);">
                           <div class="overlay">
                         	   <div class="booking-profile-shop-image">
                             	   <button type="button" class="btn btn-primary btn-lg position_absolute transparent booking-profile-shop-ratting-button rate-us" data-toggle="modal" data-target="#myModal" data-booking="<?php echo $booking->booking_id; ?>">
                                   <input type="hidden" class="review-<?php echo $booking->booking_id; ?>" value="<?php echo $review; ?>" />
                                   <input type="hidden" class="rating-<?php echo $booking->booking_id; ?>" value="<?php echo $rating; ?>" />
                                   <input type="hidden" class="shop-<?php echo $booking->booking_id; ?>" value="<?php echo $booking->shop_id; ?>" />
               						  <div class="ratting-image"> <img src="<?php echo base_url(); ?>assets/images/rattingpopup.png"></div><br>
               						  Rate us
                					</button>
                				</div>
                             </div>
                        </a>
                        
                     </div>
                </div>
                  
                  <div class="col-md-5 padding0">
                      <div class="booking-profile-shop-details">
                         <div class="row">
                             <div class="booking-profile-shop-name">
                                 <a href="<?php echo base_url()."shop/view/".str_replace(" ","-",strtolower($booking->shop_name))."-".$booking->shop_id; ?>"><?php echo $booking->shop_name; ?></a>
                             </div>
                             
                             <div class="booking-profile-time-date">
                                 <?php echo $booking->booking_time; ?>  |  <?php echo date("D, jS M, Y", strtotime($booking->booking_date)); ?>
                             </div>
                             <div class="booking-profile-time-date">
                                 <h4>Booking ID :  <?php echo $booking->booking_order_id; ?></h4>
                             </div>
                         </div>
                      </div>
                      <div class="booking-profile-shop-services">
                          <div class="row">
                          <?php
						  if(!empty($booking->services)) {
							  $services = explode("<=>",$booking->services);
							  foreach($services as $service) { 
						  ?>
                              <div class="booking-profile-service1"><?php echo $service; ?></div>
                          <?php
							  }
						  }
						  ?>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 padding0">
                      <div class="booking-profile-amount">
                          Total&nbsp;&nbsp;&#8377;<?php echo $booking->total; ?>
                      </div>
                  </div>
             </div>
         </div>
     </li>
     <?php
	}
	}
	else{
	?>
    <br /><br />
    <div class="message">
    	<div class="error">
        	<div> No bookings found </div>
        </div>
    </div>
    <?php
	}
	?>
    
</div>