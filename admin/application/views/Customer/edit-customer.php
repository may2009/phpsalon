
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label class="control-label" for="business_name">Business Name</label>
                        <input type="text" name="business_name" value="<?php echo $data->business_name; ?>" class="form-control required" placeholder="Enter Business Name">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="username">User Name</label>
                        <input type="text" name="username" value="<?php echo $data->username; ?>" class="form-control required" placeholder="Enter User Name">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="password">Password</label>
                        <input type="text" name="password" value="<?php echo $data->password; ?>" class="form-control required" placeholder="Enter Password">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="firstname">Firstname</label>
                        <input type="text" name="firstname" value="<?php echo $data->firstname; ?>" class="form-control required" placeholder="Enter firstname">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="lastname">Lastname</label>
                        <input type="text" name="lastname" value="<?php echo $data->country; ?>" class="form-control required" placeholder="Enter lastname">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="phone_no">Phone Number</label>
                        <input type="text" name="phone_no" value="<?php echo $data->phone_no; ?>" class="form-control required" placeholder="Enter Phone Number">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="email_id">Email address</label>
                        <input type="email" name="email_id" value="<?php echo $data->email_id; ?>" class="form-control required" placeholder="Enter Email address">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="birthdate">Birth Date</label>
                        <input type="text" name="birthdate" value="<?php echo $data->birthdate; ?>" data-field="date" class="form-control required" placeholder="Enter Birth Date">
                    </div>
                    <div id="dtBox"></div>
                    <div class="form-group col-md-12" style="padding-left:0px;">
                        <label class="control-label col-md-12" style="padding-left:0px;" for="gender">Gender</label>
                        <?php
								$Male = $Female = '';
								$gender = $data->gender;
								$$gender = "checked";
						?>
                        <div class="radio-control">
                            <input type="radio" name="gender" id="radio1" value="Male" class="radio" <?php echo $Male;?>/>
                            <label for="radio1" class="radio">Male</label>
                        </div>
        
                        <div class="radio-control">
                            <input type="radio" name="gender" id="radio2" value="Female" class="radio" <?php echo $Female;?>/>
                            <label for="radio2" class="radio">Female</label>
                        </div>
                   </div>
                   
                    <div class="form-group">
                        <label class="control-label" for="status">Profile Status</label><br>
                        <select id="dropdown" class="col-md-3" data-rel="chosen" name="status">
                        	 <option value="1"<?php if ($data->status=="1") {echo "selected"; }?> name="aft_qst" >Approve</option>
                             <option value="0" <?php if ($data->status=="0") {echo "selected"; }?> name="aft_exm">Pending</option>
                            
                        </select>    
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="city">City</label>
                        <input type="text" name="city" placeholder="City" rows="3" class="form-control required" value="<?php echo $data->city; ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="country">Country</label>
                        <input type="text" name="country" placeholder="Country" rows="3" class="form-control required" value="<?php echo $data->country; ?>" />
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label" for="website">Website</label>
                         <input type="text" name="website" class="form-control" placeholder="Website">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="profile_pic">Profile Picture</label>
                        <div class="form-control ">
                        <input type="file" name="profile_pic" class="" size="20" />
                        </div>
                       <div>
                       <img src="<?php echo $data->profile_pic; ?>" alt="No profile picture" width="100px;" height="100px" />
                       </div>
                    </div>
                    
                    <div class="checkbox">
                    <!-- <label>
                    <input type="checkbox" name="notify" /> Notify customer through mail
                    </label> -->
                    </div>
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update customer</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


