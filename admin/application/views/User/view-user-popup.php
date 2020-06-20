<div class="row">
	
	
	<div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> user Login </h2>
                </div>
                <div class="box-content">
                    <dl>
                    	<dt>
                        User Name
                        <dt>
                        <dd>
                        <?php echo $data->username; ?>
                        </dd>
                        
                     
                        <dt>
                        Password
                        <dt>
                        <dd>
                        <?php echo $data->password; ?>
                        </dd>
                        
                        <dt>
                        Profile Picture
                        <dt>
                        <dd>
                        <ul class="thumbnails gallery">
                    	<li class="thumbnail" data-id="<?php echo $data->profile_pic; ?>">
                        	<a style="background:url(<?php echo $data->profile_pic; ?>) no-repeat; background-size:200px; width:190px; height:190px;"
                                   title="<?php echo $data->username; ?>" href="<?php echo $data->profile_pic; ?>"></a>
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
                    <h2><i class="glyphicon glyphicon-th"></i> user Details</h2>
                </div>
                <div class="box-content">
                    <dl>
                    	
                        
                        <dt>
                        Firstname
                        <dt>
                        <dd>
                        <?php echo $data->firstname; ?>
                        </dd>
                        
                        <dt>
                        Lastname
                        <dt>
                        <dd>
                        <?php echo $data->lastname; ?>
                        </dd>
                        
                       
                        <dt>
                        Gender
                        <dt>
                        <dd>
                        <?php echo $data->gender; ?>
                        </dd>
                        
                        <dt>
                        Birth Date
                        <dt>
                        <dd>
                        <?php echo $data->birthdate; ?>
                        </dd>
                    </dl>
                </div>
            </div>
    </div>
    
    <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Contact Details</h2>
                </div>
                <div class="box-content">
                    <dl>
                    	<dt>
                        Phone Number
                        <dt>
                        <dd>
                        <?php echo $data->phone_no; ?>
                        </dd>
                        
                        <dt>
                        Email address
                        <dt>
                        <dd>
                        <?php echo $data->email_id; ?>
                        </dd>
                        
                        <dt>
                        City
                        <dt>
                        <dd>
                        <?php echo $data->city; ?>
                        </dd>
                        
                        <dt>
                        Country
                        <dt>
                        <dd>
                        <?php echo $data->country; ?>
                        </dd>
                    </dl>
                </div>
            </div>
    </div>
    
    
</div>

