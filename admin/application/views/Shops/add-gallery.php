
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $page_title; ?></h2>

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

</div><!--/row-->