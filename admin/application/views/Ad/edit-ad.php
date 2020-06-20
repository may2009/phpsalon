<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                
                    <div class="form-group ">
                        <label class="control-label" for="type">Type</label>
                        <div class="controls">
                        <select id="selectError" name="type" class="col-md-3" data-rel="chosen" >
                           <option selected="selected">-?-</option>
                           <option value="shop" <?php echo ($data->type == "shop") ? "selected" : "";?>>Shop page</option>
                         </select>
     
                    <div class="form-group">
                        <label class="control-label" for="image">Website</label>
                        <input type="text" name="website" value="<?php echo $data->website; ?>" placeholder="http://www.example.com" class="form-control required" size="20" />
                       
                    </div>
                    
                    <div class="form-group">
                         <img src="<?php echo $data->image; ?>" width="100px;" height="100px" />
                        <div class="form-control ">
                        <input type="file" name="image" class="" size="20" />
                        </div>
                       
                    </div>
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update Ad</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


