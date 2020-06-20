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
                    
                    <div class="form-group ">
                        <label class="control-label" for="service_name">Select service</label>
                        <div class="controls">
                        <select id="selectError" class="col-md-3" data-rel="chosen" name="service_id">
                            <?php
							foreach($services as $service) {
							
							echo "<option value='".$service->id."'>".$service->service_name."</option>";
							
							}
							
							?>
                        </select>
                    	</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="price">Price</label>
                        <input type="text" name="price" class="form-control required" placeholder="Enter price">
                    </div>
                    
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Save</button>
                   
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->