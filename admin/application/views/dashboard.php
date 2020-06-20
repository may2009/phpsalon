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
$menu = $this->session->userdata('admin');
?>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="<?php base_url(); ?>shop/view_shops">
            <i class="glyphicon glyphicon-briefcase blue"></i>

            <div>Total Shops</div>
            <div><?php echo $shops; ?></div>
            <!--<span class="notification">6</span>-->
        </a>
    </div>
	<?php
	if($menu=='1'){
		?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="<?php base_url(); ?>customer/view_customer">
            <i class="glyphicon glyphicon-user green"></i>

            <div>Total Customers</div>
            <div><?php echo $customers; ?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="<?php base_url(); ?>user/view_user">
            <i class="glyphicon glyphicon-user yellow"></i>

            <div>Total Users</div>
            <div><?php echo $users; ?></div>
        </a>
    </div>
<?php
	}
	?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="<?php base_url(); ?>booking">
            <i class="glyphicon glyphicon-shopping-cart red"></i>

            <div>Total Bookings</div>
            <div><?php echo $bookings; ?></div>
        </a>
    </div>
</div>