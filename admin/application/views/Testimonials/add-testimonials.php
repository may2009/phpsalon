
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                 <form role="form" method="post" class="validate" enctype="multipart/form-data">
                    
                    
                    <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control required" placeholder="Enter Name">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="description">Description</label>
                        <textarea name="description" placeholder="Description" rows="3" class="form-control required"></textarea>
                    </div>
                    
                    
                     <div class="form-group">
                        <label class="control-label" for="image">Profile Picture</label>
                        <input type="file" multiple name="image" size="20" />
                       
                    </div>
                    
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Add Testimonials</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


