<div class="row">
	
    <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Booking Summary </h2>
                </div>
                <div class="box-content">
                <?php
				$booking = $data[0];
				?>
                <dl>
                  <dt>
                  Shop Name
                  </dt>
                  <dd>
                  <?php echo $booking->shop_name; ?>
                  </dd>
                  
                  <dt>
                  Username
                  </dt>
                  <dd>
                  <?php echo $booking->username; ?>
                  </dd>
                  
                  <dt>
                  Booking ID
                  </dt>
                  <dd>
                  <?php echo $booking->booking_order_id; ?>
                  </dd>
                  
                  <dt>
                  Booking Date
                  </dt>
                  <dd>
                  <?php echo $booking->booking_date.", ".$booking->booking_time; ?>
                  </dd>
                  <dt>
                  	<?php
						$label = "success";
						if($booking->status == "Booked") {
							$label = "info";
						}
					?>
                 	<span class="label label-<?php echo $label; ?>"><?php echo $booking->status; ?></span>
                  </dt>
                  
               	</dl>	
                	
                </div>
            </div>
    </div>
	
	<div class="box col-md-6">
    	<div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Booking Details </h2>
                    <?php
					if($booking->status == "Booked") {
					?>
                    <div class="box-icon">
                      <a class="btn btn-minimize btn-round btn-default" href="javascript:void(0);" id="btn-minimize">
                      <i class="glyphicon glyphicon-chevron-up"></i>
                      </a>
                    </div>
                    <?php
					}
					?>
					
                </div>
                <div class="box-content">
                <?php
				$booking_services = array();
				foreach($data as $shop) {
					$booking_services[] = $shop->booking_service_id;
				?>
                    <div class="row">
                    	<div class="col-md-6">
                        	<h6><?php echo $shop->service_name; ?>
                            <?php
							if($shop->service_type == "1") {
								?>
                            <i class="glyphicon glyphicon-star"></i>
                            <?php
							}
							?>
                            </h6>
                            
                        </div>
                        <div class="col-md-6">
                        	<h6><?php echo $shop->price; ?></h6>
                        </div>
                    </div>
                <?php
				}
				?>
               		<hr style="margin:0px" />
                	<div class="row">
                    	<div class="col-md-6">
                        	<h5><strong>Total</strong></h5>
                        </div>
                        <div class="col-md-6">
                        	<h5><strong><?php echo $shop->total; ?></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <?php
			if($booking->status == "Booked") {
		 ?>
         <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Add New Services </h2>
                    
                    <div class="box-icon">
                      <a class="btn btn-minimize btn-round btn-default" href="javascript:void(0);">
                      <i class="glyphicon glyphicon-chevron-up"></i>
                      </a>
                    </div>
                   
					
                </div>
                <div class="box-content" style="display:block;">
                <form id="new_services_form">
                <?php
				$i = 0;
				foreach($new_services as $new) {
					if(!in_array($new->id, $booking_services)) {
						$i++;
				?>
                <div class="row">
                    	<div class="col-md-6">
                        	<h6><?php echo $new->service_name; ?></h6>
                        </div>
                        <div class="col-md-4">
                        	<h6><?php echo $new->price; ?></h6>
                        </div>
                        <div class="col-md-2">
                        	<div class="checkbox" style="margin-top:7px;">
								<input type="checkbox" name="new_service[]" value="<?php echo $new->id; ?>">
                            </div>
                        </div>
                    </div>
                <?php
					}
				}
				?>
                </form>
               		<hr style="margin:0px" />
                    <?php
					if($i > 0) {
					?>
                	<div class="row">
                        <div class="col-md-6" style="margin-top:5px;">
                        	<a class="btn btn-sm btn-primary" data-id="<?php echo $booking->booking_id;?>" data-shop="<?php echo $booking->booking_shop_id;?>" href="javascript:void(0);" id="add_new_services"> Save </a>
                        </div>
                        <div class="col-md-12 new_service_message" style="margin-top:5px; display:none;">
                        <div class="alert alert-danger" style="padding:7px 15px;">
                        	<button class="close" data-dismiss="alert" type="button">&times;</button>
                        	Please select services
                        </div>
                        </div>
                    </div>
                    <?php
					}
				if($i == 0) {
				?>
                <div class="row">
                <div class="col-md-12" style="margin-top:5px;">
                    <div class="alert alert-danger" style="padding:7px 15px;">
                        No new services found.
                    </div>
                </div>
                </div>
				<?php	
				}
					?>
                </div>
            </div>
         </div>
          <?php
			}
		  ?>
    </div>
    
    
</div>

