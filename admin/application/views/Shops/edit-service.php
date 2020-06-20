
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php echo $page_title; ?></h2>

            </div>
            <div class="box-content">
                <form role="form" method="post" class="validate">
                    <div class="form-group">
                        <label class="control-label" for="service_name">Service Name</label>
                        <input type="text" name="service_name" value="<?php echo $data->service_name; ?>" class="form-control required" placeholder="Enter service Name">
                    </div>
                    
                    
                    
                    <button type="submit" class="btn btn-custom"><i class="glyphicon glyphicon-plus"></i> Update Service</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


