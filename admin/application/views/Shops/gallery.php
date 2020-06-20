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
                <h2><i class="glyphicon glyphicon-plus"></i> Add <?php echo $page_title; ?></h2>
                <div class="box-icon">
          			<a class="btn btn-minimize btn-round btn-default" href="#">
            			<i class="glyphicon glyphicon-chevron-up"></i>
          			</a>
       	 		</div>
            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label class="control-label" for="shop_id">Select Shop</label>
                        <div class="controls">
                        <select id="selectError" class="col-md-3" data-rel="chosen" name="shop_id">
                            <?php
							foreach($data as $shop) {
							
							echo "<option value='".$shop->id."'>".$shop->shop_name."</option>";
							
							}
							
							?>
                        </select>
                    	</div>
                    </div>
                    
                    <div class="form-group ">
                        <label class="control-label" for="shopimage">Select Images</label>
                        <input type="file" multiple name="shopimage[]" size="20" />
                        <p class="help-block">You can upload multiple images.</p>
                    </div>
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Gallery</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div>


<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-eye-open"></i> View <?php echo $page_title; ?></h2>
        <div class="box-icon">
          			<a class="btn btn-minimize btn-round btn-default" href="#">
            			<i class="glyphicon glyphicon-chevron-up"></i>
          			</a>
       	 		</div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th class="hidden">Id</th>
        <th>Shop Name</th>
        <th>Total Images</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($gallery as $shop) {
	?>
    <tr>
        <td class="hidden"><?php echo $shop->shop_id; ?></td>
        <td><?php echo $shop->shop_name; ?></td>
        <td><?php echo $shop->total_images; ?></td>
        <td class="center">
            <a class="btn btn-primary btn-sm view-gallery" href="<?php echo base_url(); ?>shop/view_shop_gallery/<?php echo $shop->shop_id; ?>" >
                <i class="glyphicon glyphicon-picture icon-white"></i>
               View Gallery
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
                    <h3>Gallery Details</h3>
                </div>
                <div class="modal-body">
                    <p class="text-center"><img src="<?php echo base_url(); ?>assets/images/ajax-loader-4.gif" /></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>