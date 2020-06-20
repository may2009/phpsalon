<?php
if($this->session->flashdata('message')) {
  $message = $this->session->flashdata('message');
  ?>
<div class="alert alert-<?php echo $message['class']; ?>">
<button class="close" data-dismiss="alert" type="button">×</button>
<?php echo $message['message']; ?>
</div>
<?php
}
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label" for="username">User Name</label>
                        <input type="text" name="username" value="<?php echo $data->username; ?>" class="form-control required" placeholder="Enter Shop Name">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="password">Password</label>
                        <input type="text" name="password" value="<?php echo $data->password; ?>" class="form-control required" placeholder="Enter Password">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="firstname">Firstname</label>
                        <input type="text" name="firstname" value="<?php echo $data->firstname; ?>" class="form-control required" placeholder="Enter Firstname">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="lastname">Lastname</label>
                        <input type="text" name="lastname" value="<?php echo $data->lastname; ?>" class="form-control required" placeholder="Enter Lastname">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="phone_no">Phone Number</label>
                        <input type="text" name="phone_no" value="<?php echo $data->phone_no; ?>" class="form-control required" placeholder="Enter Phone Number">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="email_id">Email address</label>
                        <input type="email" name="email_id" value="<?php echo $data->email_id; ?>" class="form-control required" placeholder="Enter Email ">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="birthdate">Birth Date</label>
                        <input type="text" name="birthdate" value="<?php echo $data->birthdate; ?>" class="form-control required" placeholder="Enter Birth Date">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="gender">Gender</label>
                        <input type="text" name="gender" value="<?php echo $data->gender; ?>" class="form-control required" placeholder="Enter Gender">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="city">City</label>
                        <input name="city" placeholder="City" value="<?php echo $data->city; ?>" rows="3" class="form-control required"></input>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="country">Country</label>
                         <input type="text" name="country" value="<?php echo $data->country; ?>" class="form-control required" placeholder="Country">
                        
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label" for="profile_pic">Profile Picture</label>
                        <div class="form-control ">
                        <input type="file" name="profile_pic" size="20" />
                        </div>
                        <div>
                       <img src="<?php echo base_url().$data->profile_pic; ?>" width="100px;" height="100px" />
                       </div>
                    </div>
                    
                    
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update Profile</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->



































