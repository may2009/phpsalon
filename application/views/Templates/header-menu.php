
   <!-- SIGN IN SIGN UP -->
       
  <div class="cd-user-modal">
  <div class="cd-user-modal-container">
  <?php if(!isset($user_data)) { ?> 
    <ul class="cd-switcher">
      <li><a>Sign in</a></li>
      <li><a>New account</a></li>
    </ul>
    <div id="cd-login">
      <form class="cd-form validate" action="<?=base_url()?>/home/signIn" method="post">
        <p class="fieldset">
          <label class="image-replace cd-email" for="signin-email">Username or Email or Phone</label>
          <input class="full-width has-padding has-border required" id="signin-email" name="username" type="text" placeholder="Username or E-mail or Phone">
          <span class="cd-error-message">Enter Valid Username or Email or Phone!</span></p>
        <p class="fieldset">
          <label class="image-replace cd-password" for="signin-password">Password</label>
          <input class="full-width has-padding has-border required" id="signin-password" name="password" type="password" placeholder="Password">
          <span class="cd-error-message">Enter Valid Password!</span><a href="#" class="hide-password">Show</a></p>
        <p class="fieldset">
          <input type="checkbox" id="remember-me" checked>
          <label for="remember-me">Remember me</label>
        </p>
        <div class="message">
        </div>
        <p class="fieldset">
          <input class="full-width" type="submit" value="Login">
        </p>
      </form>
      <form class="cd-form validate" id="signIn_otp" style="display:none;">
        <p class="fieldset">
          <label class="image-replace cd-password">OTP</label>
          <input class="full-width has-padding has-border required" value="" name="otp" type="text" placeholder="Enter Your OTP">
          <span class="cd-error-message">You need to verify your account. Please enter the OTP received in your registered mobile!</span>
        </p>
        <p>
        <a href="javascript:void(0);" class="send_otp_again">Didn't received? Send again</a>
        <i class="fa"></i>
        </p>
        <div class="message">
        </div>
        <p class="fieldset">
          <input class="full-width has-padding" type="submit" value="Verify">
        </p>
      </form>
      <p class="cd-form-bottom-message"><a href="#">Forgot your password?</a></p>
    </div>
    <div id="cd-signup">
      <form class="cd-form validate" id="signUp">
        <p class="fieldset">
          <label class="image-replace cd-username" for="signup-username">Username</label>
          <input class="full-width has-padding has-border required" value="" id="signup-username" name="username" type="text" placeholder="Username">
          <span class="cd-error-message">Please Enter Username!</span></p>
        <p class="fieldset">
          <label class="image-replace cd-email" for="signup-email">E-mail</label>
          <input class="full-width has-padding has-border required" value="" id="signup-email" name="email_id" type="text" placeholder="E-mail">
          <span class="cd-error-message">Please Enter Valid Email!</span></p>
        <p class="fieldset">
          <label class="image-replace cd-password" for="signup-password">Password</label>
          <input class="full-width has-padding has-border required" value="" id="signup-password" name="password" type="password" placeholder="Password">
          <span class="cd-error-message">Please Enter Password!</span><a href="#" class="hide-password">Show</a></p>
        <p class="fieldset">
          <label class="image-replace cd-phone" for="signup-phone">Phone</label>
          <input class="full-width has-padding has-border required" value="" id="signup-password" name="phone_no" type="text" placeholder="Phone">
          <span class="cd-error-message">Please Enter Valid Phone No!</span></p>
        <p class="fieldset">
          <input type="checkbox" value="1" class="required" id="accept-terms">
          <span class="cd-error-message">Please Accept Terms!</span>
          <label for="accept-terms">I agree to the <a href="#">Terms</a></label>
          
        </p>
        <div class="message">
        </div>
        <p class="fieldset">
          <input class="full-width has-padding" type="submit" value="Create account">
        </p>
      </form>
      
      <form class="cd-form validate" id="signUp_otp" style="display:none;">
        <p class="fieldset">
          <label class="image-replace cd-password">OTP</label>
          <input class="full-width has-padding has-border required" value="" name="otp" type="text" placeholder="Enter Your OTP">
          <span class="cd-error-message">Please enter the OTP you received!</span>
        </p>
        <p>
        <a href="javascript:void(0);" class="send_otp_again">Didn't received? Send again</a>
        <i class="fa"></i>
        </p>
        <div class="message">
        </div>
        <p class="fieldset">
          <input class="full-width has-padding" type="submit" value="Verify">
        </p>
      </form>
    </div>
    <div id="cd-reset-password">
      <p class="cd-form-message modal-header">Lost your password?</p>
      <div class="cd-form-message"> Please enter your Email ID. You will receive a new password. You can change your password in profile details page. </div>
      <form class="cd-form validate" id="forgotForm">
        <p class="fieldset">
          <label class="image-replace cd-phone" for="reset-phone">Email ID</label>
          <input class="full-width has-padding has-border required" id="reset-phone" type="text" name="email_id" placeholder="Email ID">
          <span class="cd-error-message">Enter your Email ID here!</span></p>
        <div class="message">
        </div>
        <p class="fieldset">
          <input class="full-width has-padding" type="submit" value="Reset password">
        </p>
      </form>
      <p class="cd-form-bottom-message"><a href="#">Back to log-in</a></p>
    </div>
    <?php } ?>
    <div id="cd-change-city">
    <p class="cd-form-message modal-header">Change Homecity</p>
      <div class="cd-form-message">Type your city name</div>
      <form class="cd-form" id="cd-home-city">
        <div class="fieldset">
          <label class="image-replace cd-homecity" for="reset-city">E-mail</label>
          <input class="full-width has-padding has-border" id="reset-city" type="text" placeholder="City...">
          <ul class="dropdown-menu txtcity" role="menu" aria-labelledby="reset-city"  id="DropdownCity">
          </ul>
          </div>
        <p class="fieldset">
        </p>
      </form>
    </div>
    <a href="javascript:void(0);" class="cd-close-form"> </a>
    </div>
</div>
	

<div class="row nav-row">
  <div class="col-lg-8">
    <div class="row">
      <div class="col-lg-3">
      <div class="logo-main col-lg-12 col-xs-4">
      <a href="<?php echo base_url();?>">
        <img src="<?php echo base_url();?>assets/images/logo.png" class="img-responsive" alt="logo"/>
       </a>
      </div>
      </div>
      <div class="col-lg-9 pad-none-1">
        <nav class="navbar navbar-default nav-secondary">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="<?=base_url()?>">Accueil<span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo base_url();?>about">Qui sommes-nous ?</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Rendez-vous</a></li>
                <li><a href="<?php echo base_url();?>contact">Contact</a></li>
              </ul>

            </div>
          </div>
        </nav>
      </div>
    </div>

  </div>
  <div class="col-lg-4 second-sec-nav">
    <div class="row">
      <div class="col-lg-6 col-xs-7">
        <div class="slct_cuntry">
          <div class="box">
            <div class="city-txt"> CITY : </div>
            <div class="city">
              <div class="styled-select">Chennai </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-xs-5 pad-none">
        <?php if($user_data) { ?>

          <div class="in">
            <div class="col-sm-6 col-xs-6 padding0">
              <div class="logedin">
                <h5> Welcome ,</h5>
              </div>
            </div>
            <div class="col-sm-6 col-xs-6 padding0">

              <div class="logdetails">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?php echo $username ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="<?php echo base_url();?>user/profile"> <img src="<?php echo base_url();?>assets/images/my_profile.png" alt=""> My Profile</a></li>
                    <li><a href="<?php echo base_url();?>user/bookings"> <img src="<?php echo base_url();?>assets/images/my_booking.png" alt=""> My bookings</a></li>
                    <li><a href="<?php echo base_url();?>logout"> <img src="<?php echo base_url();?>assets/images/logout.png" alt=""> Log Out</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        <?php } else { ?>
        <div class="signup">
          <nav class="main-nav">
            <ul>
              <li><a class="cd-signin" href="javascript:void(0);">Sign in</a></li>
              <li><a class="cd-signup" href="javascript:void(0);">Sign up</a></li>
            </ul>
          </nav>
        </div>
        <?php } ?>
      </div>
    </div>

  </div>
</div>


