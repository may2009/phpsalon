<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                
                    <div class="form-group">
                        <label class="control-label" for="slider_text">Slider Text</label>
                        <input type="text" name="slider_text" value="<?php echo $data->slider_text; ?>" class="form-control required" placeholder="Enter slider">
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
                 
                    
                    <div class="form-group ">
                        <label class="control-label" for="order">Order</label>
                        <div class="controls">
                        <select class="col-md-3" data-rel="chosen" name="order">
                           <option >-?-</option>
                           <option <?php if ($data->order=="1") {echo "selected"; }?>>1</option>
                           <option <?php if ($data->order=="2") {echo "selected"; }?>>2</option>
                           <option <?php if ($data->order=="3") {echo "selected"; }?>>3</option>
                           <option <?php if ($data->order=="4") {echo "selected"; }?>>4</option>
                           <option <?php if ($data->order=="5") {echo "selected"; }?>>5</option>
                           <option <?php if ($data->order=="6") {echo "selected"; }?>>6</option>
                        </select>
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Slider</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


