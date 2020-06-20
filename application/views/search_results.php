<?php
//var_dump($data->query);
$shopname = $services = "";
$page = 1;
if(!empty($post_data['shopname'])) {
	$shopname = $post_data['shopname'];
	$services = $post_data['services'];
	$page = $post_data['page'];
}


?>       
            
<!-- CLM 1  EASY AND SIMPLE  --> 
<div class="search-result-main">
  <div class="container">
    <div class="row">
    
    <div class="col-md-12 search-rslt-hding">
    	<div class="search-rslt-hding-lft"> <h1> Search </h1> </div>
        <div class="search-rslt-hding-cntr"> <img src="<?php echo base_url(); ?>assets/images/srch_rslt_icon.png" alt=""> </div>
        <div class="search-rslt-hding-rht"> <h1> Results </h1>  </div>
				<div class="search-rslt-wrap">
					<form class="shop-autocomplete shop_filter_form">
                    <div class="searchbox">
						<input type="search" autocomplete="off" id="search-shop" data-submit="1" placeholder="Shop Name......" name="shopname" value="<?php echo $shopname; ?>" class="searchbox-input"></input>
						<span class="searchbox-icon"><img src="<?php echo base_url(); ?>assets/images/search-results-icon.png"></span>
                        </div>
                        <ul class="dropdown-menu txtshop" style="margin-left:15px;margin-right:0px; width:94%; margin-top:0px;" role="menu" aria-labelledby="search-shop"  id="DropdownShop">
          		</ul>
					</form>
				</div>
			</div>
    
      <div class="col-md-4">
        <div class="search-result-left">
        <h1> FILTERS</h1>
        <form class="shop_filter_form" id="shop_filter_form">
        
        <input type="hidden" name="page" value="<?php echo $page; ?>" id="current_page">
        <div class="srch-rslt-lft-sortby">
        	<h2>SORT BY</h2>
              <div class="sortby-select">
                <select name="services" id="fxselect" class="services_filter filter-field">
                  <option value="">All Services</option>
                  <?php 
				  if(isset($data->services)) {
				  foreach($data->services as $service) { 
						$selected = ($service->id == $services ? "selected" : ""); 
				  ?>
                  <option value="<?php echo $service->id; ?>" <?php echo $selected; ?>><?php echo $service->service_name; ?></option>
				  <?php 
				  } 
				  }
				  ?>
                </select>
              </div>
            
        </div>
        
        
        <!--<div class="srch-rslt-lft-location">
              <h2>SHOP NAME</h2>
              <div class="srchlocation-input">
                <input type="text" name="shopname" value="<?php //echo $shopname; ?>" class="form-control filter-field" placeholder="Type to filter( eg: Lakme)" aria-describedby="basic-addon1" >
              </div>
        </div>-->
                
        <div class="srch-rslt-lft-location">
              <h2>LOCATION</h2>
              <div class="srchlocation-input">
                <input type="text" name="location" class="form-control filter-field" placeholder="Type to filter( eg: Cochin)" aria-describedby="basic-addon1" >
              </div>
        </div>   
         
         
         
         <div class="srch-rslt-lft-location-map" id="map-canvas" style="width:320px; height:300;"> </div>
         
        
         
         
         
            <div class="srch-rslt-lft-gender">
        	<h2>GENDER</h2>
                <div class="checkbox checkbox-success">
                <input type="checkbox" name="gender[]" value="1" id="checkbox1" class="filter-field">
                <label for="checkbox1">
                Unisex
                </label>
                </div>
                
                <div class="checkbox checkbox-success">
                <input type="checkbox" name="gender[]" value="2" id="checkbox2" class="filter-field">
                <label for="checkbox2">
                Men
                </label>
                </div>
                
                <div class="checkbox checkbox-success">
                <input type="checkbox" name="gender[]" value="3" id="checkbox3" class="filter-field">
                <label for="checkbox3">
                Women
                </label>
                </div>
            </div>
            
            
            <div class="srch-rslt-lft-gender">
        	<h2>PRICES & OFFERS</h2>
            
                <div class="checkbox checkbox-success">
                <input type="checkbox" name="offers[]" value="40" id="checkbox4" class="filter-field">
                <label for="checkbox4">
                Above 40% off
                </label>
                </div>
                
                <div class="checkbox checkbox-success">
                <input type="checkbox" name="offers[]" value="20" id="checkbox5" class="filter-field">
                <label for="checkbox5">
                Above 20% off
                </label>
                </div>
                
                <div class="checkbox checkbox-success">
                <input type="checkbox" name="offers[]" value="10" id="checkbox6" class="filter-field">
                <label for="checkbox6">
                Above 10% off
                </label>
                </div>
            
            </div>
            
            
            <div class="col-md-12"> <input type="reset" class="srch-rslt-lft-btn reset-filter" value="Reset"  /> </div>
         
         </form>
         
      
         
         
        
        
        </div>
      </div>
      
      <!-- Search Result Right  -->
      <div class="col-md-8">
      
		
    
    	<div class="spinner" style="float:left; height:40px; width:100%; margin-bottom:10px;">
        <img src="<?php echo base_url();?>assets/images/loading.gif" style="height:40px; width:40px; margin-left:45%;" />
        </div>
        <div class="search-result-right">
          <ul>
            
            
            
            
            <?php
			$user_data = is_logged();
			$map_data = array();
      $maps = '[]';
			if(!empty($data->shops)) {
			foreach($data->shops as $shop) {
				$rating_class='id="custom-user-login"';
				if(isset($user_data)) {
					$rating_class='id="custom-user-rating" data-shop="'.$user_data['id']."-".$shop->id.'"';
				}
				$rating = 0;
				if($shop->total_rating) {
					$rating = $shop->total_rating / $shop->rating_count;
				}
            ?>
            <li class="shop-details">
              <div class="row">
                <div class="col-md-5"> <img class="shopimage" src="<?php echo $shop->image; ?>" alt="<?php echo $shop->shop_name; ?>"> </div>
                <div class="col-md-7">
                  <h1> <?php echo $shop->shop_name; ?> </h1>
                  <div class="search-result-sparator"></div>
                  <div class="search-result-loction"> <?php echo $shop->location; ?> </div>
                  <div class="starss">
                  	<div class="raty" data-read="true" data-rate="<?php echo $rating; ?>"></div>
                   <?php /*?> <form id="shop_ratingsForm">
                      <div class="stars" <?php echo $rating_class; ?>>
                        <input type="radio" name="star" class="star-1" id="<?php echo $shop->id; ?>-star-1" value="1"/>
                        <label class="star-1" for="<?php echo $shop->id; ?>-star-1">1</label>
                        <input type="radio" name="star" class="star-2" id="<?php echo $shop->id; ?>-star-2" value="2" />
                        <label class="star-2" for="<?php echo $shop->id; ?>-star-2">2</label>
                        <input type="radio" name="star" class="star-3" id="<?php echo $shop->id; ?>-star-3" value="3" />
                        <label class="star-3" for="<?php echo $shop->id; ?>-star-3">3</label>
                        <input type="radio" name="star" class="star-4" id="<?php echo $shop->id; ?>-star-4" value="4" />
                        <label class="star-4" for="<?php echo $shop->id; ?>-star-4">4</label>
                        <input type="radio" name="star" class="star-5" id="<?php echo $shop->id; ?>-star-5" value="5" />
                        <label class="star-5" for="<?php echo $shop->id; ?>-star-5">5</label>
                        <span></span> </div>
                    </form><?php */?> 
                  </div>
                  <!--end ratting-->
                  <div class="search-result-ratingbtm">
                    <div class="col-md-4 search-result-rating-txt"> <span class="total-ratings"><?php echo $shop->rating_count; ?></span> Ratings
                      <div class="search-result-rating average-rating">
					  <?php if($shop->rating_count) { 
					  			echo number_format($shop->total_rating / $shop->rating_count,1); 
					  } 
					  else {
						  echo "0";
					  }?>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <p class="fieldset">
                        <a href="<?php echo base_url()."shop/view/".str_replace(" ","-",strtolower($shop->shop_name))."-".$shop->id; ?>" class="viewprflbook-btn btn">VIEW PROFILE & BOOK</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            
            <?php
			$map_data[] = '{ "DisplayText": "'.$shop->shop_name.'", "Location": "'.$shop->location.'", "LatitudeLongitude": "'.$shop->latitude.','.$shop->longitude.'"}';
			}
			$maps = '['.implode(",", $map_data).']';
			//echo $maps;
			}
			else
			{
				?>
                <div class="message"><div class="error"><div>Sorry, No shops found. Please try with different keywords. </div></div></div>
                <?php				
			}
			if(!empty($data->shops) and count($data->shops) > 9) {
			?>
            <div class="load_more_shops"></div>
            	<div class="col-md-12 load-more-button" style="text-align:center">
                      <div class="col-md-6">
                        <a href="javascript:void(0);" class="viewprflbook-btn" id="load-more">Load More</a>
                      </div>
                    </div>
            <?php
			}
			?>
          </ul>
        </div>
      </div>
      <!-- End Search Result Right  -->
      
    </div>
  </div>
</div>
</div>

<!---- Maps -->

    <script type="text/javascript">

       // $(document).ready(function() {
			//var data = '[{ "DisplayText": "adcv", "Location": "Jamiya Nagar Kovaipudur Coimbatore-641042", "LatitudeLongitude": "10.9435131,76.9383790" },{ "DisplayText": "abcd", "Location": "Coimbatore-641042", "LatitudeLongitude": "10.0143694,76.3101339"}]';
			var data = '<?php echo $maps; ?>';
     
           /* ViewCustInGoogleMap(data);
        });*/

    </script>
<!-- End CLM 1 --> 
    
 

    
<!---->    
      

