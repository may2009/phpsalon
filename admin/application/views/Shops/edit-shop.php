
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label" for="shop_name">Shop Name</label>
                        <input type="text" name="shop_name" value="<?php echo $data->shop_name; ?>" class="form-control required" placeholder="Enter Shop Name">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="location">Category</label><br>
                         <select id="dropdown" class="col-md-3" data-rel="chosen" name="category">
                        	 <option value="2" <?php if ($data->category=="2") {echo "selected"; }?> name="aft_qst">Male</option>
                             <option value="3" <?php if ($data->category=="3") {echo "selected"; }?> name="aft_exm">Female</option>
                             <option value="1" <?php if ($data->category=="1") {echo "selected"; }?> name="aft_exm">Unisex</option>
                            
                        </select>  
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="location">Location</label>
                        <input type="text" name="location" value="<?php echo $data->location; ?>" class="form-control required" placeholder="Enter Location">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="location">City</label>
                        <input type="text" name="city" value="<?php echo $data->city; ?>" class="form-control required" placeholder="Enter Location">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="state">State</label>
                        <input type="text" name="state" value="<?php echo $data->state; ?>" class="form-control required" placeholder="Enter State">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="country">Country</label>
                        <input type="text" name="country" value="<?php echo $data->country; ?>" class="form-control required" placeholder="Enter Country">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="pincode">Pincode</label>
                        <input type="text" name="pincode" value="<?php echo $data->pincode; ?>" class="form-control required" placeholder="Enter Pincode">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="phone_no">phone_no</label>
                        <input type="text" name="phone_no" value="<?php echo $data->phone_no; ?>" class="form-control required" placeholder="Enter Phone No">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="email_id">Email address</label>
                        <input type="email" name="email_id" value="<?php echo $data->email_id; ?>" class="form-control required" placeholder="Enter Email">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="website">Website</label>
                        <input type="text" name="website" value="<?php echo $data->website; ?>" class="form-control required" placeholder="Enter Website">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="working_time">Working Time</label>
                         <input type="text" value="<?php echo $data->working_time; ?>"  name="working_time" class="form-control required" placeholder="Working Time">
                         
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="description">Description</label>
                        <textarea name="description" placeholder="Description" rows="3" class="form-control required"><?php echo $data->description; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="latitude">Latitude</label>
                        <input type="text" value="<?php echo $data->latitude; ?>"  name="latitude" class="form-control required" placeholder="Enter latitude">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="longitude">Longitude</label>
                        <input type="text" value="<?php echo $data->longitude; ?>"  name="longitude" class="form-control required" placeholder="Enter longitude">
                        <span><a href="javascript:void(0)" id='pick-map'>Pick from map</a></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="image">Picture</label>
                        <div class="form-control ">
                        <input type="file" name="image" class="" size="20" />
                        </div>
                       <div>
                       <img src="<?php echo $data->image; ?>" width="100px;" height="100px" />
                       </div>
                    </div>
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update Shop</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<div class="modal fade modal-wide" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select location</h4>
                  </div>
                  <div class="modal-body">
                    <div id='map_canvas'></div>
                    <div id="current">Nothing yet...</div>
                    <input type="hidden" id="pick-lat" />
                    <input type="hidden" id="pick-lng" />
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-custom select-location">Select Location</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>