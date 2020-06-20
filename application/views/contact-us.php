<div class="container">
		<div class="bms-abt-title">
			<div class="row">
				<div class="col-lg-6">
					<div class="bms-abt-text">
						Book My Salon provides 24/7 access to top <br>salons & spa
					</div>
				</div>
				<div class="col-lg-6"></div>
			</div>
		</div>
		<div class="abt-us-content">
			<div class="row">
				<div class="col-md-2">
					<h1>Contact Us</h1>
					<hr style="width:120px;">
				</div>
				<div class="col-md-10">
				</div>
			</div>
		</div>
		<div class="contact-us-details">
			<div class="row">
				<div class="col-md-5">
                <div class="message" style="margin-bottom:10px;">
                <?php
					if($this->session->flashdata('message')) {
  					$message = $this->session->flashdata('message');
  				?>
                <div class="<?php echo $message['class']; ?>"><div><?php echo $message['message']; ?></div></div>
                <?php
					}
				?>
        		</div>
				<div class="contact-left">
					<p>PLEASE USE THE FOLLOWING FORM TO CONTACT US.</p>
					<form method="post" id="contactForm" class="cd-form validate" style="padding:0;">
                    <div class="row padding-left20 padding-right20">
						<p class="fieldset">
                        Your Name :<br>
						<input type="text" name="name" class="required padding-left20 has-border bms-cntct-input">
                        <span class="cd-error-message">Enter Your Name!<p></p></span>
                        </p>
                        
					</div>
					<div class="row padding-left20 padding-right20">
						<p class="fieldset">
                        Your Email ID :<br>
						<input type="text" name="email_id" class="bms-cntct-input required padding-left20 has-border">
                        <span class="cd-error-message">Enter Your Email Id!</span>
                        </p>
                        <p></p>
					</div>
					<div class="row padding-left20 padding-right20">
						<p class="fieldset">
                        Mobile No :<br>
						<input type="text" name="phone_no" class="bms-cntct-input required padding-left20 has-border">
                        <span class="cd-error-message ">Enter Your Mobile Number!</span></p>
                        </p>
                        <p></p>
					</div>
					<div class="row padding-left20 padding-right20">
                    	<p class="fieldset">
						Message :<br>
						<textarea rows="4" name="message" class="bms-cntct-input required padding-left20 padding-top10 has-error " style="height: 100px !important;"></textarea>
                        <span class="cd-error-message">Enter Your Message!</span></p>
                        </p>
                        <p></p>
					</div>
					<div class="row padding-left20 padding-right20 align-right">
						<button type="submit" class="submt-btn">Submit</button>
					</div>
                    </form>
				</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-5 padding0">
					<div class="contact-right">
						<div class="row padding-left20">
							Call<br>
							<div class="contct-sec">
							<div class="col-md-1 padding0"><img src="<?php echo base_url();?>assets/images/booking-phone.png"></div>
							<div class="col-md-11 padding0">+91-011-11111</div>
							</div>
						</div>
						<br>
						<div class="row padding-left20">
							E-Mail<br>
							<div class="contct-sec">
							<div class="col-md-1 padding0"><img src="<?php echo base_url();?>assets/images/booking-message.png"></div>
							<div class="col-md-11 padding0">info@bookmysalons.co.in</div>
							</div>
						</div><br>
						<div class="row padding-left20">
							Contact Us<br>
							<div class="contct-sec">
							<div class="col-md-12 padding0">
								Techware Solution, Heavenly Plaza,<br>
								Kakkanad, Cochin,<br>
								Kerala-682021
							</div>
							</div>
						</div>

					</div>
					<hr>
					<div class="follow-us">
							Follow Us<br>
							<div class="slogo padding-left0"><img src="<?php echo base_url();?>assets/images/facebook.png"></div>
							<div class="slogo"><img src="<?php echo base_url();?>assets/images/youtube.png"></div>
							<div class="slogo"><img src="<?php echo base_url();?>assets/images/instagram.png"></div>
							<div class="slogo"><img src="<?php echo base_url();?>assets/images/twitter.png"></div>
						</div>
				</div>
			</div>
		</div>
	</div>