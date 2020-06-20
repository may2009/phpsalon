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
                <h2><i class="glyphicon glyphicon-pencil"></i> <?php echo $page_title; ?></h2>
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
                    
                    
                    
                  
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Save</button>
                   
                </form>

</div>
</div>
</div>
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
        <th>Shop Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $slider) {
	?>
    <tr>
        <td><?php echo $slider->shop_name; ?></td>
        
       
       
       
        <td class="center">
            <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>settings/delete_cycle_slider/<?php echo $slider->id; ?>">
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
    </div>
    <!--/span-->

</div><!--/row-->






