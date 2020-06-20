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
        <h2><i class="glyphicon glyphicon-eye-open"></i> <?php echo $page_title; ?></h2>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        
        <th class="hidden">Id</th>
        <th>Business Name</th>
        <th>Username</th>
        <th>Phone Number</th>
        <th>Email address</th>
        <th>Profile Status</th>
        <th>City</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $customer) {
	?>
    <tr>
        
        <td class="hidden"><?php echo $customer->id; ?></td>
        <td class="center"><?php echo $customer->business_name; ?></td>
        <td class="center"><?php echo $customer->username; ?></td>
        <td class="center"><?php echo $customer->phone_no; ?></td>
        <td class="center"><?php echo $customer->email_id; ?></td>
        <td ><?php   
		$value=$customer->status;
		 if ($value=="0")
		  echo '<span class="label-warning label label-default">Pending</span>';
		 else if($value=="1") {
			 echo '<span class="label-success label label-default">Approved</span>';
		      }
		  ?>
		 
		 </td>
        <td class="center"><?php echo $customer->city; ?></td>
        
        <td class="center">
            <a class="btn btn-success btn-sm view-customer" href="javascript:void(0);" data-id="<?php echo $customer->id; ?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View
            </a>
            <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>customer/edit_customer/<?php echo $customer->id; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>customer/delete_customer/<?php echo $customer->id; ?>">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
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

<div class="modal modal-wide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>View customer</h3>
                </div>
                <div class="modal-body">
                    <p class="text-center"><img src="<?php echo base_url(); ?>assets/images/ajax-loader-4.gif" /></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>