<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                
                    <div class="form-group ">
                        <label class="control-label" for="shop_name">Select shop</label>
                        <div class="controls">
                        <select id="selectError" class="col-md-3" data-rel="chosen" name="shop_id">
                            <?php
							foreach($shops as $shop) {
							$s = "";
							if($shop->id == $data->shop_id) {
								$s = "selected";
							}
							echo "<option value='".$shop->id."' ".$s.">".$shop->shop_name."</option>";
							
							                         }
							?>
                        </select>
                    	</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="slider_text">Title</label>
                        <input type="text" name="title" value="<?php echo $data->title; ?>" class="form-control required" placeholder="Enter Title">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="slider_text">Subtitle</label>
                        <input type="text" name="subtitle" value="<?php echo $data->subtitle; ?>" class="form-control required" placeholder="Enter Subtitle">
                    </div>
     				
                    <div class="form-group">
                        <label class="control-label" for="">Description</label>
                        <textarea name="description" class="form-control required" placeholder="Enter description">
                            <?php echo $data->description; ?>
                        </textarea>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label" for="status">Status</label><br>
                        <select id="dropdown" class="col-md-3" data-rel="chosen" name="status">
                        	 <option value="1" name="aft_qst" <?php echo ($data->status == 0) ? "" : "selected";?>>Enable</option>
                             <option value="0" name="aft_exm" <?php echo ($data->status == 1) ? "" : "selected";?>>Disable</option>
                            
                        </select>    
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="form-control ">
                        <input type="file" name="image"  size="20" />
                        </div>
                       <div>
                       <img src="<?php echo $data->image; ?>" width="100px;" height="100px" />
                       </div>
                    </div>
                 
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


