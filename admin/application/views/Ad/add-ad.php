<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> Add <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                
                    <div class="form-group ">
                        <label class="control-label" for="type">Type</label>
                        <div class="controls">
                        <select id="selectError" name="type" class="col-md-3" data-rel="chosen" >
                           <option selected="selected">-?-</option>
                           <option>white</option>
                           <option>black</option>
                           <option>orange</option>
                           <option>yellow</option>
                           <option>blue</option>
                           <option>violet</option>
                         </select>
     
                    <div class="form-group">
                        <label class="control-label" for="image">Image</label>
                        <div class="form-control ">
                        <input type="file" name="image" class="required" size="20" />
                        </div>
                       
                    </div>
                    
                   
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Ad</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


