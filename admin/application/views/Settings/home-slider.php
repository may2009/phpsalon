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
                
                    <div class="form-group">
                        <label class="control-label" for="slider_text">Slider Text</label>
                        <input type="text" name="slider_text" class="form-control required" placeholder="Enter slider">
                    </div>
                    
     
                    <div class="form-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="form-control ">
                        <input type="file" name="image" class="required" size="20" />
                        </div>
                       
                    </div>
                    
                    <div class="form-group ">
                        <label class="control-label" for="order">Order</label>
                        <div class="controls">
                        <select id="selectError" name="order" class="col-md-3" data-rel="chosen" >
                           <option selected="selected">-?-</option>
                           <option>1</option>
                           <option>2</option>
                           <option>3</option>
                           <option>4</option>
                           <option>5</option>
                           <option>6</option>
                        </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Slider</button>
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
        <th>Slider</th>
        <th>Image</th>
        <th>Order</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $slider) {
	?>
    <tr>
        <td><?php echo $slider->slider_text; ?></td>
        <td class="center"><img src="<?php echo $slider->image; ?>" width="100" height="100"  /></td>
        <td class="center"><?php echo $slider->order; ?></td>
       
       
       
       
        <td class="center">
            <a class="btn btn-success btn-sm view-slider" href="javascript:void(0);" data-id="<?php echo $slider->id; ?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View
            </a>
            <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>settings/edit_slider/<?php echo $slider->id; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>settings/delete_slider/<?php echo $slider->id; ?>">
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>View Slider</h3>
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