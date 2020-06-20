<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                
                    <div class="form-group ">
                        <label class="control-label" for="shop_id">Select shop</label>
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
                        <label class="control-label" for="offers">Offers</label>
                        <input type="text" name="offers" class="form-control required" placeholder="Enter Offer">
                    </div>
                    
                   
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Offers</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


