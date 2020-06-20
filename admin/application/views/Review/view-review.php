
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-eye-open"></i> <?php echo $page_title; ?></h2>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Shop Name</th>
        <th>Total Review</th>
        <th>Total Rating</th>
        <th>Rating Avg.</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
	foreach($data as $shop) {
		$rating = 0;
		if($shop->rating_count > 0) {
			$rating = $shop->total_rating / $shop->rating_count;
		}
	?>
    <tr>
        <td><?php echo $shop->shop_name; ?></td>
        <td class="center"><?php echo $shop->review_count; ?></td>
        <td class="center"><?php echo $shop->rating_count; ?></td>
        <td class="center"><div class="raty" data-rate="<?php echo $rating ?>"></div></td>
        <td class="center">
            <a class="btn btn-success btn-sm view-review" href="javascript:void(0);" data-id="<?php echo $shop->id; ?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                View Details
            </a>
        </td>
    </tr>
    <?php
	}
	?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Reviews</h3>
                </div>
                <div class="modal-body">
                    <p class="text-center"><img src="<?php echo base_url(); ?>assets/images/ajax-loader-4.gif" /></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>