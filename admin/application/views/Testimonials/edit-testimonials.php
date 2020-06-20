
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $data->name; ?>" class="form-control required" placeholder="Enter User Name">
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="description">Description</label>
                        <textarea name="description" placeholder="Description" rows="3" class="form-control required"><?php echo $data->description; ?></textarea>
                    </div>
                  
                    
                    <div class="form-group">
                        <label class="control-label" for="profile_pic">Profile Picture</label>
                        <div class="form-control ">
                        <input type="file" name="image" class="" size="20" />
                        </div>
                       <div>
                       <img src="<?php echo $data->image; ?>" width="100px;" height="100px" />
                       </div>
                    </div>
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update Testimonials</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


