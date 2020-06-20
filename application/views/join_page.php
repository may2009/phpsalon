<div class="container">
		<div class="bms-abt-title">
			<div class="row">
				<div class="col-lg-6">
					<div class="bms-join-text">
						Join now and Receive a Complementary trial
					</div>
				</div>
				<div class="col-lg-6"></div>
			</div>
		</div>

		<div class="join-us-box-wrapper">
			<div class="col-md-3">
				<div class="join-us-box">
					<div class="abt-us-top-img">
						<img src="<?php echo base_url(); ?>assets/images/bms-new-client.png">
					</div>
					<h3>New Clients</h3>
					<p>
					Showcase your business to thousands of potential clients on a custom profile page. 
					</p>
				</div>
			</div>
			<div class="col-md-3">
					<div class="join-us-box">
					<div class="abt-us-top-img">
						<img src="<?php echo base_url(); ?>assets/images/fill-seats.png">
					</div>
					<h3>Fill seats</h3>
					<p>
					Maximize occupancy by publicizing inventory in real time, including last minute openings. 
					</p>
				</div>
			</div>
			<div class="col-md-3">
					<div class="join-us-box">
					<div class="abt-us-top-img">
						<img src="<?php echo base_url(); ?>assets/images/bms-booking.png">
					</div>
					<h3>24/7 Booking</h3>
					<p>
						Better service clients with desktop and mobile booking. 
					</p>
				</div>
			</div>
			<div class="col-md-3">
					<div class="join-us-box">
					<div class="abt-us-top-img">
						<img src="<?php echo base_url(); ?>assets/images/connect.png">
					</div>
					<h3>Connect</h3>
					<p>
						 Confirmations, review requests & reactivation emails keep you in touch with clients. 
					</p>
				</div>
			</div>
		</div>
		<div class="join-trial-wrap">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<button class="join-trial-btn">Join now & Receive a Complementary Trial</button>
			</div>
			<div class="col-md-3"></div>
		</div>
	

	</div>

	<div class="container">
		<div class="join-form-wrapper">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="join-form-outter">
					<div class="join-header">
						Join Now & Receive a Complementary Trial
					</div>
					<div class="join-sub">
						interested in becoming a salon or spa partner? Complete the form below and we'll be in<br>
						touch within 48hours.
						<div style="width:100%;padding-left: 42%;padding-right: 42%;">
							<div class="join-sub-line"></div>
						</div>
					</div>
					<div class="join-content">
                    <?php
					if($this->session->flashdata('message')) {
					  $message = $this->session->flashdata('message');
					  ?>
                      <div class="message">
						<div class="<?php echo $message['class']; ?>">
						<?php echo $message['message']; ?>
						</div>
					 </div>
					<?php
					}
					?>
						<?php echo form_open(base_url().'join', array('class' => 'custom_validate')); ?>
                        <div class="row">
							<div class="col-md-6">
								Your Name*<br><br>
								<input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" class="join-input required">
							</div>
							<div class="col-md-6">
								Phone Number*<br><br>
								<input type="text" name="phone_no" value="<?php echo set_value('phone_no'); ?>" class="join-input required">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Email Address*<br><br>
								<input type="text" name="email_id" value="<?php echo set_value('email_id'); ?>" class="join-input required">
							</div>
							<div class="col-md-6">
								Business Name*<br><br>
								<input type="text" name="business_name" value="<?php echo set_value('business_name'); ?>" class="join-input required">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Website<br><br>
								<input type="text" nemae="website" value="<?php echo set_value('website'); ?>" class="join-input">
							</div>
							<div class="col-md-3">
								
							</div>
							<div class="col-md-3"><br><br>
								<button type="submit" class="join-btn">Join Now</button>
							</div>
						</div>
                        </form>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>