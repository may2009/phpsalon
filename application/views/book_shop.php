<?php 
//var_dump($data);
if(isset($data->data) and !empty($data->data)) {
$data = $data->data[0];

$map_data = '{ "DisplayText": "'.$data->shop_name.'", "Location": "'.$data->location.'", "LatitudeLongitude": "'.$data->latitude.','.$data->longitude.'"}';
$maps = '['.$map_data.']';

$user_data = is_logged();
$main_id = "booking-process";
if(isset($user_data)) {
	$main_id = "user-process";
}?>
<div class="container">
        <div class="row">
            <div class="booking-main">
                <div class="col-lg-12 padding0">
                <div class="col-lg-8 padding0">
                    <div class="booking-shop" style="background-image:url(<?php echo $data->image; ?>);">
                        <div class="search-result-ratingbtm">
                    <div class="col-md-4 search-result-rating-txt font-white"><?php echo $data->rating_count; ?> Ratings
                      <?php
					  $rating = "0";
					  $rtg = "0";
					  if($data->total_rating) {
						  $rating = number_format($data->total_rating / $data->rating_count,1);
					  }
					  $rating = 5;
					  if($data->total_rating) {
						  $rating = $data->total_rating / $data->rating_count;
					  }
					  if(!empty($data->ratings)) {
						  $rt = 0;
						  $rating = explode("<=>", $data->ratings);
						  foreach($rating as $ra) {
							  $r = explode("<#>", $ra);
							  $rt += $r[1];
						  }
						  $rtg = number_format($rt/$data->rating_count,1);
					  }
					  ?>
                        <div class="search-result-rating"><?php echo $rtg; ?></div>
                    </div>
                        </div>
                        <div class="booking-shop-downlayer">
                            <div class="booking-shop-downlayer-wrap">
                                <div class="col-md-8">
                                    <div class="booking-shop-name font-white">
                                        <h1><?php echo $data->shop_name; ?></h1>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                   <?php
							$user_data = is_logged();
							$rating_class='id="custom-user-login"';
							if(isset($user_data)) {
								$rating_class='id="custom-user-rating" data-shop="'.$user_data['id']."-".$data->id.'"';
							}
						?> 
                                    
                               <div class="starss">
                    			 <div class="raty" data-read="true"  data-rate="<?php echo $rtg; ?>"></div>
                 				</div>
                                    
                                    
                                </div>
                            </div>
                     
                        </div>
                    </div>
                </div>
                    <div class="col-lg-4 padding0">
                        	<div class="booking-map" id="map-canvas" style="width:390px; height:345px;"> </div>
                    
                    </div>
                </div>
            </div>
            </div></div>
        
        
        
        
        
        
  <div class="container">
  <div class="booking-beauty-dept col-md-12">
    <div class="booking-beauty-dept-heading">
      <h1>SELECT A BEAUTY DEPARTMENT</h1>
    </div>
    <form id="book-shop" data-type="<?php echo $main_id; ?>">
    <input type="hidden" name="shop_name" value="<?php echo $data->shop_name; ?>"  />
    <input type="hidden" name="shop_id" value="<?php echo $data->id; ?>"  />
    <div class="booking-beauty-dept-main col-md-12">
      <div class="col-md-4">
        <div class="booking-slct">
          <h1> CHOOSE A SERVICE </h1>
          <ul>
          <?php
		  if($data->services) {
		  //echo $data->services;
		  $services = explode("<=>", $data->services);
		  $i=1;
		  foreach($services as $service_details) {
			  $i++;
			   $service = explode("<#>", $service_details);
		  ?>
            <li>
              <div class="switch demo4 service<?php echo $i; ?>">
                <input id="service<?php echo $i; ?>" class="service_check" type="checkbox" name="services[]" value="<?php echo trim($service_details); ?>">
                <label> <?php echo $service[0]; ?> </label>
              </div>
            </li>
          <?php
		  }}
		  ?>
          </ul>
        </div>
      </div>
      <div class="booking-slct-caldr">
        <div class="col-md-8">
          <h1> SELECT DATE &amp; TIME </h1>
          <input type="text" name="datetime" id="datetimepicker3"/>
        </div>
      </div>
    </div>
    <br />
    <div class="col-md-12">
    <br /><br />
    <div class="message">
    </div>
                  <div class="booking-hr"></div>
             <div class="row">
                 <div class="col-lg-9">
                 </div>
                 <div class="col-lg-3">
                 <div class="col-md-12">
                 <?php
				 	$user_data = is_logged();
					if(isset($user_data)) {
						?>
                        <input type="hidden" value="<?php echo $user_data['id']; ?>" name="user_id">
                        <input type="submit" value="CONFIRM BOOKING" class="viewprflbook-btn">
                        <?php
					}
					else {
						echo '<a href="javascript:void(0);" class="viewprflbook-btn btn" id="saloon-user-login">CONFIRM BOOKING </a>';
					}
				 ?>
                     
                     </div>
                    
                 </div>
             </div>
             </div>
    </form>
  </div>
  
</div>


        
        

        
        
        
          <!--BOOKING-DETAILS-->
        <div class="container">
        <div class="booking-result">
        	<div class="message">
            </div>
        
        </div>
     <div class="booking-details-wrapper" style="display:none;">
     
           
             
    
        </div>
        
            </div>

<!---- Maps -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1br9lwKFyEpCnS5elLan_90CCsYeak6I" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function() {
			//var data = '[{ "DisplayText": "adcv", "Location": "Jamiya Nagar Kovaipudur Coimbatore-641042", "LatitudeLongitude": "10.9435131,76.9383790" },{ "DisplayText": "abcd", "Location": "Coimbatore-641042", "LatitudeLongitude": "10.0143694,76.3101339"}]';
			var data = '<?php echo $maps; ?>';
            ViewCustInGoogleMap(data);
        });

    </script>
<?php
}
else {
	$this->load->view('error404');
}
?>