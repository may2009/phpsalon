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
                        <label class="control-label" for="shop_name">Select shop</label>
                        <div class="controls">
                        <select id="selectError" class="col-md-3" data-rel="chosen" name="shop_id">
                            <?php
							foreach($shops as $shop) {
							
							echo "<option value='".$shop->id."'>".$shop->shop_name."</option>";
							
							                         }
							?>
                        </select>
                    	</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="">Title</label>
                        <input type="text" name="title" class="form-control required" placeholder="Enter Title">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control required" placeholder="Enter Subtitle">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="">Description</label>
                        <textarea name="description" class="form-control required" placeholder="Enter description"></textarea>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label" for="status">Status</label><br>
                        <select id="dropdown" class="col-md-3" data-rel="chosen" name="status">
                        	 <option value="1" name="aft_qst">Enable</option>
                             <option value="0" name="aft_exm">Disable</option>
                            
                        </select>    
                    </div>
                    
     
                    <div class="form-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="form-control ">
                        <input type="file" name="image" class="required" size="20" />
                        
                        </div>
                       <p class="help-block">Preferred image size is 465 x 500.</p>
                    </div>
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Save</button>
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
        <th>Title</th>
        <th>Subtitle</th>
        <th>Shop</th>
        <th>Image</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $slider) {
	?>
    <tr>
        <td><?php echo $slider->title; ?></td>
        <td><?php echo $slider->subtitle; ?></td>
        <td><?php echo $slider->shop_name; ?></td>
        <td class="center"><img src="<?php echo $slider->image; ?>" width="100" height="100"  /></td>
       <td><?php echo ($slider->status == 0) ? "Disable" : "Enable" ; ?></td>
       
       
       
        <td class="center">
            <a class="btn btn-success btn-sm view-whats-new" href="javascript:void(0);" data-id="<?php echo $slider->id; ?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View
            </a>
            <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>settings/edit_whats_new/<?php echo $slider->id; ?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>settings/delete_whats_new/<?php echo $slider->id; ?>">
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