
<div class="row">
    <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Shop Details</h2>
                </div>
                <div class="box-content">
                    <dl>
                    	<dt>
                        Shop Name
                        <dt>
                        <dd>
                        <?php echo $data->shop_name; ?>
                        </dd>
                        
                        <dt>
                        Category
                        <dt>
                        <dd>
                        <?php 
                        if($data->category == 1) {
                        echo "Unisex"; 
                        }
                        else if($data->category == 2) {
                        echo "Male"; 
                        }
                        else if($data->category == 3) {
                        echo "Female"; 
                        }
                        ?>
                        </dd>
                        
                        
                        <dt>
                        Phone
                        <dt>
                        <dd>
                        <?php echo $data->phone_no; ?>
                        </dd>
                        
                        <dt>
                        Email
                        <dt>
                        <dd>
                        <?php echo $data->email_id; ?>
                        </dd>
                        
                        <dt>
                        Website
                        <dt>
                        <dd>
                        <?php echo $data->website; ?>
                        </dd>
                        
                        <dt>
                        Working Hours
                        <dt>
                        <dd>
                        <?php echo $data->working_time; ?>
                        </dd>
                        
                        <dt>
                        Create Date
                        <dt>
                        <dd>
                        <?php echo date("d-M-Y", strtotime($data->created_date)); ?>
                        </dd>

                        <dd>
                    <ul class="thumbnails gallery">
                        <li class="thumbnail" data-id="<?php echo $data->image; ?>">
                            <a style="background:url(<?php echo $data->image; ?>) no-repeat; background-size:200px; width:190px; height:190px;"
                                   title="<?php echo $data->shop_name; ?>" href="<?php echo $data->image; ?>"></a>
                        </li>
                    </ul>
                        </dd>
                    </dl>
                </div>
            </div>
    </div>
    
    <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Shop Details</h2>
                </div>
                <div class="box-content">
                    <dl>
                    	<dt>
                        Location
                        <dt>
                        <dd>
                        <?php echo $data->location; ?>
                        </dd>
                        
                        <dt>
                        City
                        <dt>
                        <dd>
                        <?php echo $data->city; ?>
                        </dd>
                        
                        <dt>
                        State
                        <dt>
                        <dd>
                        <?php echo $data->state; ?>
                        </dd>
                        
                        <dt>
                        Country
                        <dt>
                        <dd>
                        <?php echo $data->country; ?>
                        </dd>
                        
                        <dt>
                        Pincode
                        <dt>
                        <dd>
                        <?php echo $data->pincode; ?>
                        </dd>
                        
                        <dt>
                        Description
                        <dt>
                        <dd>
                        <?php echo $data->description; ?>
                        </dd>
  
                   
                    </dl>
                </div>
            </div>
    </div>
    
    <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Shop Services</h2>
                </div>
                <div class="box-content">
                <?php
				if($services) {
				foreach($services as $service) {
				?>
                    <div class="row">
                    	<div class="col-md-6">
                        	<h6><?php echo $service->service_name; ?></h6>
                        </div>
                        <div class="col-md-4">
                        	<h6><?php echo $service->price; ?></h6>
                        </div>
                        <div class="col-md-1">
                        	<h6><a href="javascript:void(0);" data-id="<?php echo $service->id; ?>" class="remove_services red"><i class="glyphicon glyphicon-trash icon-white"></i></a></h6>
                        </div>
                    </div>
                <?php
				}
				}
				else {
					echo 'No services added yet. <br><br><a href="'.base_url().'shop/assign_service">Assign Service</a>';
				}
				?>
                </div>
                
              <dt>
                        MAP
                        <dt>
                        <dd>
                        <iframe src="https://maps.google.com/maps?q=<?php echo $data->latitude; ?>,<?php echo $data->longitude; ?>&hl=es;z=14&amp;output=embed" width="320" height="280" frameborder="0" style="border:0" allowfullscreen>
                        </dd>  
                
            </div>
    </div>

</div>

