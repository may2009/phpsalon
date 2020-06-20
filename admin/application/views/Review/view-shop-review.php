
<div class="row">
	
	<?php
	foreach($data as $shop) {

        $user = $shop->firstname." ".$shop->lastname;
        if(empty(trim($user))) {
            $user = $shop->username;
        }
	?>
    <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> <?php echo $user; ?></h2>
                </div>
                <div class="box-content">
                <div class="row">
                <div class="col-md-12">
                <?php
				$rating = 0;
				if($shop->rating_count > 0 and $shop->total_rating > 0) {
					$rating = $shop->total_rating / $shop->rating_count;;
				}
				?>
                <div class="raty" data-rate="<?php echo $rating; ?>"></div>
                </div>
                </div>
                    <p><?php echo $shop->comments; ?></p>
                </div>
            </div>
    </div>
    <?php
	}
	?>
    
    
    
</div>

