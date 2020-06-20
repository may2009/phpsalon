<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-eye-open"></i> <?php echo $data[0]->shop_name;; ?> - Gallery</h2>
    </div>
    <div class="box-content">
    <ul class="thumbnails gallery">
                            <?php
							foreach($data as $shop) {
								$image_path = $shop->image_path;
								?>
                            <li class="thumbnail" data-id="<?php echo $shop->id; ?>">
                                <a style="background:url(<?php echo $image_path; ?>) no-repeat; background-size:120px;"
                                   title="<?php echo $shop->shop_name; ?>" href="<?php echo $image_path; ?>"></a>
                            </li>
                            <?php
							}
							?>
    </ul>
    </div>
    </div>
    </div>
    <!--/span-->

    </div>

