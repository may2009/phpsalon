<?php
//var_dump($this->session->userdata('booking_test'));
/*$data = $this->session->userdata('booking_test');
$user_details = $data['user_details'];
$booking_details = $data['booking_details'];
$shop_details = $data['shop_details'];*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Book My Salon </title>
    
	<!-- FONTS -->
    
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    
</head>
<body style="margin:70px;padding: 25px;">

	<!-- ABOUT-US-TITLE -->
	<div style="border:1px solid #e7e7e7;padding:20px;border-radius: 8px;">
		<div style="width:100%;text-align:center;">
			<img src="<?php echo base_url(); ?>assets/images/logo.png">
		</div>
		<!--<div style="margin-top: 20px;margin-bottom: 20px;display:inline-flex;list-style:none;width:100%;font-family: 'Open Sans',sans-serif;font-size:16px;background: #f49aa3; none repeat scroll 0 0;border-radius:5px;color:#fff;">
		<a href="#" style="width:100%;text-decoration:none;color:#fff;"><li style="width:100%;text-align:center;border-right:1px solid #fff;padding-top:10px;padding-bottom:10px;">Buy Product</li></a>
		<a href="#" style="width:100%;text-decoration:none; color:#fff;"><li style="width:100%;text-align:center;border-right:1px solid #fff;padding-top:10px;padding-bottom:10px;">Book Saloon</li></a>
		<a href="#" style="width:100%;text-decoration:none;color:#fff;"><li style="width:100%;text-align:center;padding-top:10px;padding-bottom:10px;">Browse Collections</li></a>
		</div>-->
		<?php
			$datetime = explode(" ", $booking_details->datetime);
			$date = $datetime[0];
			$time = $datetime[1];
			$booking_date = date("l jS M Y", strtotime($date));
			$booking_time = date("g:i A", strtotime($time));
		?>
		<div style="border-radius: 8px;font-family: 'Open Sans',sans-serif;font-size:16px;line-height:35px;text-align:justify;padding-bottom: 30px;border:1px solid #e7e7e7;margin-bottom:20px;padding: 30px;">
		<b>Hi <?php echo $user_details['username']; ?>, </b>
		<br>
		Your booking for <?php echo $shop_details->shop_name; ?>, <?php echo $shop_details->city; ?> on <?php echo $booking_date; ?> at <?php echo $booking_time; ?> is Confirmed! 
		<p style="margin:0;">Your Booking code is <b style="color:#30adb1;"><?php echo $booking_details->booking_order_id; ?></b></p>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;border-bottom:none;">
		<div style="text-align:center;width:100%;font-family: 'Open Sans',sans-serif;color:#30adb1;font-size: 20px;">Your Booking Information</div>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;border-bottom:none;">
		<div style="width:100%;">
		<table style="width:100%;">
		<tr style="width:100%;">
		<th style="width:50%;"><b>Booking Code</b></th>
		<th style="width:50%;"><b><?php echo $booking_details->booking_order_id; ?></b></th>
		</tr>
		<tr style="width:100%;">
		<td style="width:50%;font-size: 15px;">Date & Time</td>
		<td style="width:50%;font-size: 15px;"><?php echo $booking_date; ?> at <?php echo $booking_time; ?></td>
		</tr>
		<tr style="width:100%;">
		<td style="width:50%;font-size: 15px;">Payment Method</td>
		<td style="width:50%;font-size: 15px;">Pay on Visit </td>
		</tr>
        <?php
		$total = 0;
		$services = '';
		if(isset($booking_details->services)) {
			foreach($booking_details->services as $service_details) {
				$service = explode("<#>",$service_details);
				
				$total += $service[2];
				$services .= '<tr style="width:100%;">'.
							'<td style="width:50%;font-size: 15px;">'.strtoupper($service[0]).'</td>'.
							'<td style="width:50%;font-size: 15px;">
							<div style="width:100px; text-align:right;">
							&#x20B9; &nbsp;'.number_format($service[2],2).'
							</div></td></tr>';
			}
		}
		
		?>
		<tr style="width:100%;">
		<td style="width:50%;font-size: 15px;">Bill Amount</td>
		<td style="width:50%;font-size: 15px;">&#x20B9; &nbsp;<?php echo number_format($total,2); ?></td>
		</tr>
		<tr></tr>
		<tr></tr>
		<tr style="width:100%;background: #f49aa3;color:#fff;margin-top:20px;margin-bottom:20px;">
		<td style="width:50%;font-size: 15px;padding-left:10px;">Service Name</td>
		<td style="width:50%;font-size: 15px;padding-left:10px;">Price</td>
		</tr>
		<tr></tr>
		<tr></tr>
		<?php echo $services; ?>
		</table>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;">
		<table style="width:100%;">
		<tr style="width:100%;">
		<td style="width:50%;font-size: 15px;">Service Charge</td>
		<td style="width:50%;font-size: 15px;"><div style="width:100px; text-align:right;">Free</div></td>
		</tr>
		<tr style="width:100%;">
		<td style="width:50%;font-size: 15px;">Other Charges</td>
		<td style="width:50%;font-size: 15px;"><div style="width:100px; text-align:right;">Nil</div></td>
		</tr>
		</table>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;border-bottom:none;">
		<table style="width:100%;">
		<tr style="width:100%;">
		<td style="width:50%;font-size: 15px;"><b>TOTAL</b></td>
		<td style="width:50%;font-size: 15px;"><b><div style="width:100px; text-align:right;">&#x20B9; &nbsp;<?php echo number_format($total,2); ?></div></b></td>
		</tr>
		</table>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;border-bottom:none;">
		<div style="text-align:center;width:100%;font-family: 'Open Sans',sans-serif;color:#30adb1;font-size: 20px;">Where you need to go.</div>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;">
		<div style="font-size:13px;">
		 	<?php echo $shop_details->shop_name; ?>, <br>
			<?php echo $shop_details->location; ?>,<br>
            <?php echo $shop_details->city; ?>, <?php echo $shop_details->state; ?> <br>
			<?php echo $shop_details->country; ?>, <?php echo $shop_details->pincode; ?>
			</div>
		</div>
		<div style="text-align:center;width:100%;font-family: 'Open Sans',sans-serif;color:#30adb1;font-size: 20px;">Things to know before you go.</div>
		<hr style="border:1px solid rgb(244, 154, 163);margin-top:20px;margin-bottom:20px;">
		<h3 style="margin:0px;font-size:15px;">Redeeming Account</h3>
		<div style="font-size:13px;">
		 	 	To redeem your booking, please provide the booking code,
				<b><?php echo $booking_details->booking_order_id; ?></b>, to the salon's front desk when you visit
				</div>
		<!--<h3 style="margin:0px;font-size:15px;">Cancellation Policy</h3>
		<div style="font-size:13px;">
		 	 	 	Cancellation or re-scheduling is allowed only 4 (working)
					hours prior to the scheduled date.
					For prepaid appointment, the money will be refunded to your account in 7-10 working days form cancelation.<br><br>
					<b>We know that plans change, so if you can't make it for an appointment, please let us know, we will reschedule it for you.</b>
				</div>-->
				<div>
				If you need any further assistance, please contact us at <a style="color:#30adb1;text-decoration:none;" href="#">022-30987960 </a>or email us at <a style="text-decoration:none;color:#30adb1;" href="mailto:enquiry@bookmysalons.com">enquiry@bookmysalons.com</a>
				</div>
		</div>
		

		

		<div style="width:100%;background:#424047;color:#777382;font-family: 'Open Sans',sans-serif;text-align:center;padding-top: 10px;font-size:13px;">
		Copyright &copy; BOOKMYSALON. All rights reserved. <br>
		<div style="list-style:none;display:inline-flex;padding-top:10px;padding-bottom:10px;">
		<li style="padding:5px"><img src="<?php echo base_url(); ?>assets/images/facebook.png"></li>
		<li style="padding:5px"><img src="<?php echo base_url(); ?>assets/images/instagram.png"></li>
		<li style="padding:5px"><img src="<?php echo base_url(); ?>assets/images/twitter.png"></li>
		<li style="padding:5px"><img src="<?php echo base_url(); ?>assets/images/youtube.png"></li>
		</div>
		</div>
	</div>
 

</body>
</html>