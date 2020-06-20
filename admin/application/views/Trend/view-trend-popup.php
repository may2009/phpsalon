<div class="row">
	
	
	<div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Trend Name </h2>
                </div>
                <div class="box-content">
                    <dl>
                    	<dt>
                        Trend Name
                        <dt>
                        <dd>
                        <?php echo $data->title; ?>
                        </dd>
                        
                      
                        
                    </dl>
                </div>
            </div>
    </div>
	
	
	
    <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Trend Description</h2>
                </div>
                <div class="box-content">
                    <dl>
                    	
                        
                        <dt>
                        Description
                        <dt>
                        <dd>
                        <?php echo $data->description; ?>
                        </dd>
                        
                      
                    </dl>
                </div>
            </div>
    </div>
    
    <div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Picture</h2>
                </div>
                <div class="box-content">
                    <dl>
                    	<dt>
                        Picture
                        <dt>
                        <dd>
                        <ul class="thumbnails gallery">
                    	<li class="thumbnail" data-id="<?php echo $data->image; ?>">
                        	<a style="background:url(<?php echo $data->image; ?>) no-repeat; background-size:200px; width:190px; height:190px;"
                                    href="<?php echo $data->image; ?>"></a>
                        </li>
                    </ul>
                        </dd>
                       
                    </dl>
                </div>
            </div>
    </div>
    
    
</div>

