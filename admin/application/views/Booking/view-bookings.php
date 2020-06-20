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
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th class="hidden">Id</th>
        <th>Username</th>
        <th>Shop Name</th>
        <th>Booking ID</th>
        <th>Amount</th>
        <th>Booking Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $shop) {
		$label = "success";
		if($shop->status == "Booked") {
			$label = "info";
		}
	?>
    <tr>
    	<td class="hidden"><?php echo $shop->id; ?></td>
        <td><?php echo $shop->username; ?></td>
        <td class="center"><?php echo $shop->shop_name; ?></td>
        <td class="center"><?php echo $shop->booking_id; ?></td>
        <td class="center"><?php echo $shop->total; ?></td>
        <td class="center"><?php echo date("d-M-Y", strtotime($shop->booking_date)).", ".$shop->booking_time; ?></td>
        <td class="center"><span class="label label-<?php echo $label; ?>"><?php echo $shop->status; ?></span></td>
        <td class="center">
            <a class="btn btn-success btn-sm view-bookings" href="javascript:void(0);" id="view-<?php echo $shop->id; ?>" data-status="<?php echo $shop->status; ?>" data-id="<?php echo $shop->id; ?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View Details
            </a>
        </td>
    </tr>
    <?php
	}
	?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div>
<script>
$(document).ready(function() {
						   setTimeout(function() {
						   $('#view-15').click();
											   },1000);
						   });
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Booking Details</h3>
                </div>
                <div class="modal-body">
                    <p class="text-center"><img src="<?php echo base_url(); ?>assets/images/ajax-loader-4.gif" /></p>
                </div>
                <div class="modal-footer">
                     <a href="javascript:void(0);" class="btn btn-primary" data-id="" id="complete-booking" >Complete</a>
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    
                </div>
            </div>
        </div>
    </div>