<div class="row">
	
	
	<div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Slider</h2>
                </div>
                <div class="box-content">
                    <dl>
                    
                    	<dt>
                        Slider Text
                        </dt>
                        <dd>
                        <?php echo $data->slider_text; ?>
                        </dd>
                        
                        
                        <dd>
                    <ul class="thumbnails gallery">
                    	<li class="thumbnail" data-id="<?php echo $data->image; ?>">
                        	<a style="background:url(<?php echo $data->image; ?>) no-repeat; background-size:200px; width:190px; height:190px;"
                                    href="<?php echo $data->image; ?>"></a>
                        </li>
                    </ul>
                        </dd>
                        
                        <dt>
                        Order
                        </dt>
                        <dd>
                        <?php echo $data->order; ?>
                        </dd>
                        
                        
                    </dl>
                </div>
            </div>
    </div>
	

    
</div>

