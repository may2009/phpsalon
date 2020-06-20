<?php
$username = $user['firstname']. " " . $user['lastname'];
if($username == " ") {
	$username = $user['email_id'];
}

$user_pic = $user['profile_pic'];
if($user_pic == "") {
	$user_pic = base_url()."assets/images/avatar.png";
}
?>
<div class="container">
    <div class="row">
        <div class="profile-main">
           <div class="profile-main-bg">
              <div class="col-md-2">
                  <div class="prfl-pic" style="background-image:url(<?php echo $user_pic; ?>)"></div>
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
        <!-- Tab  -->
        <div class="shop-page-tabs">
            <div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
                <ul role="tablist" class="nav nav-tabs " id="myTabs">
                   <li class="active" role="presentation">
                      <a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="profile-tab" href="#profile">
                      	EDIT PROFILE
                      </a>
                   </li>
                   <li role="presentation">
                      <a aria-controls="profile" data-toggle="tab" id="changepass-tab" role="tab" href="#change-pass">
                      	CHANGE PASSWORD
                      </a>
                   </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="home-tab" id="profile" class="tab-pane fade in active" role="tabpanel">
                    	
                        <div class="edit-profile-details">
                        	<?php
							if($this->session->flashdata('message')) {
							  $message = $this->session->flashdata('message');
							  ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="message edit-profile1">
                                        <div class="<?php echo $message['class']; ?>"><div><?php echo $message['message']; ?>.</div></div>
                                    </div>
                                </div>
                        	</div>
							<?php
							}
							?>
                            
                            <div class="row">
                               <div class="col-md-6">
                                   <div class="edit-profile1">
                              		   E-mail<br>
                                       <input type="text" class="edit-profile" disabled="disabled" value="<?php echo $user['email_id']; ?>" placeholder="E-mail" name="email_id">
                                   </div>
                              </div>
                                                                                                                                                                            			  <div class="col-md-6">
                                  <div class="edit-profile1">
                          			  Phone Number<br>
                                      <input type="text" class="edit-profile" disabled="disabled" value="<?php echo $user['phone_no']; ?>" placeholder="Phone Number" name="phone_no">
                                  </div>
                              </div>
                          </div>
                            
                           <form method="post" enctype="multipart/form-data">
                           
                           
                           
                           <div class="row">
                                <div class="col-md-6">
                                    <div class="edit-profile1">
                              			First Name<br>
                                        <input type="text" class="edit-profile" value="<?php echo $user['firstname']; ?>" placeholder="First Name" name="firstname">
                                    </div>
                                </div>
                                                                                                                                                            								<div class="col-md-6">
                                    <div class="edit-profile1">
                         				Last Name<br>
                                        <input type="text" class="edit-profile" value="<?php echo $user['lastname']; ?>" placeholder="Last Name" name="lastname">
                                    </div>
                               </div>
                           </div>
                                                                                                                                                                					   
                          
                          <div class="row">
                               <div class="col-md-6">
                                   <div class="edit-profile1">
                              		   City<br>
                                       <input type="text" class="edit-profile" value="<?php echo $user['city']; ?>" placeholder="City" name="city">
                                   </div>
                              </div>
                                                                                                                                                                            			  <div class="col-md-6">
                                  <div class="edit-profile1">
                          			  Country<br>
                                      <input type="text" class="edit-profile" value="<?php echo $user['country']; ?>" placeholder="Country" name="country">
                                  </div>
                              </div>
                          </div>
                                                                                                                                                                                	   <div class="row">
                             <div class="edit-profile1 edit-profile2">
                          		Gender<br>
                                <?php
								$Male = $Female = "";
								$$user['gender'] = "checked";
								?>
                                <div class="edit-profile-gender">
                                    <input id="male" type="radio" <?php echo $Male; ?> name="gender" value="Male">
                                    <label for="male">Male</label>
                                </div>
                                <div class="edit-profile-gender">
                                     <input id="female" type="radio" <?php echo $Female; ?> name="gender" value="Female">
                                     <label for="female">Female</label>
                                </div>
                              </div>
                          </div>
                           <div class="row">
                              <div class="edit-profile1 edit-profile2">
                          		  Date of birth<br>
                                  
                                  <div class="edit-profile-date">
                                      <div class="edit-profile-date-sub">
                                          <input id="example1" value="<?php echo $user['birthdate']; ?>" name="birthdate">
                                      </div>
                                  </div>
                               </div>
                          </div>
                                                                                                                                                                                      <div class="row">
                              <div class="edit-profile1 edit-profile2">
                                  Browse for profile picture 
                                  <input type="file" name="profile_pic">
                              </div>
                          </div>                                                                                             
                                                                                                                                                                                      <div class="row edit-profile1">
                              <div class="checkbox checkbox-success edit-profile3">
                                  <input type="checkbox" id="checkbox3" name="alerts">
                                  <label for="checkbox3"></label>
                                  <div class="edit-profile-gender-label">Get Alerts on mobile for</div>
                               </div>
                          </div>
                                                                                                                                                                                      <div class="row">
                              <div class="edit-profile1">
                                  <input type="submit" value="UPDATE" class="edit-profile-update" name="update" />
                               </div>
                           </div>  
                           </form>                 
                        </div>
                      </div>
                                                                                                                                                                               <div aria-labelledby="profile-tab" id="change-pass" class="tab-pane fade" role="tabpanel">
                        <div class="edit-profile-details">
                            
                            <form method="post" id="change-password-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pwd_change message edit-profile1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="edit-profile1">
                              			Current Password<br>
                                        <input type="password" class="edit-profile required" placeholder="Current Password" name="old_password">
                                    </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                   <div class="edit-profile1">
                              		   New Password<br>
                                       <input type="password" class="edit-profile required" placeholder="New password" name="new_password">
                                    </div>
                                </div>
                             </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="edit-profile1">
                              			Confirm Password<br>
                                        <input type="password" class="edit-profile required" placeholder="Confirm Password" name="confirm_password">
                                    </div>
                                 </div>
                            </div>
                            </form>
                            <div class="row">
                                <div class="edit-profile1">
                                    <a href="javascript:void(0);" id="change-password">
                                      <div class="edit-profile-update">VERIFY</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                                                                                    
            </div>
                                                                                                                                                                   </div>
                                                                                                                                                                   <!--End Tab  -->
    </div>
</div>