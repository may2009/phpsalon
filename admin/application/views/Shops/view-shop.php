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
        <th>Shop Name</th>
        <th>Category</th>
        <th>Location</th>
        <th>State</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Website</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
   
	foreach($data as $shop) {
		
				 
	?>
    <tr>
        <td class="hidden"><?php echo $shop->id; ?></td>
        <td><?php echo $shop->shop_name; ?></td>
        <td>
		<?php 
		$category = $shop->category;
		if($category == "1") {
			echo "Unisex"; 
		}
		elseif($category == "2") {
			echo "Male"; 
		}
		else {
			echo "Female"; 
		}
		?>
        </td>
        <td class="center"><?php echo $shop->location; ?></td>
        <td class="center"><?php echo $shop->state; ?></td>
        <td class="center"><?php echo $shop->phone_no; ?></td>
        <td class="center"><?php echo $shop->email_id; ?></td>
        <td class="center"><?php echo $shop->website; ?></td>
        <td class="center">
            <a class="btn btn-success btn-sm view-shop" href="javascript:void(0);" data-id="<?php echo $shop->id; ?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View
            </a>
            <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>shop/edit_shop/<?php echo $shop->id; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>shop/view_shop_gallery/<?php echo $shop->id; ?>">
                <i class="glyphicon glyphicon-picture icon-white"></i>
                Gallery
            </a>
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>shop/delete_shop/<?php echo $shop->id; ?>">
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
                    <h3>View Shop</h3>
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