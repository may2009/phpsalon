<div class="row">
	
	
	<div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Whats New</h2>
                </div>
                <div class="box-content">
                    <dl>
                    
                    	<dt>
                        Title
                        </dt>
                        <dd>
                        <?php echo $data->title; ?>
                        </dd>
                        
                        <dt>
                        Subtitle
                        </dt>
                        <dd>
                        <?php echo $data->subtitle; ?>
                        </dd>
                        
                        <dt>
                        Shopname
                        </dt>
                        <dd>
                        <?php echo $data->shop_name; ?>
                        </dd>
                        
                        <dt>
                        Status
                        </dt>
                        <dd>
                        <?php echo ($data->status == 0) ? "Disable" : "Enable" ; ?>
                        </dd>
                        
                        
                    </dl>
                </div>
            </div>
    </div>
    
	<div class="box col-md-4">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Description</h2>
                </div>
                <div class="box-content">
                    <dl>
                    
                        
                        <dt>
                        Description
                        </dt>
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
                    <h2><i class="glyphicon glyphicon-th"></i> Image</h2>
                </div>
                <div class="box-content">
                    <dl>
                    
                        
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

