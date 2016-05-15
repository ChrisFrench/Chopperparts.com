<?php $option = \Base::instance()->get('PARAMS.option'); ?>
<div class="container">
				<div class="modal-header">

					<a class="pull-right" data-dismiss="modal" aria-hidden="true"><i class="glyphicon x1 glyphicon-remove"></i></a>
					<ul class="nav nav-tabs" role="tablist" id="tabsModal">
					    <li role="presentation" class="active"><a href="#carttab" aria-controls="home" role="tab" data-toggle="tab" class="<?php if(empty($option)) {echo 'active in'; }?>">View Cart</a></li>

					    <li role="presentation"><a href="#wishlist" aria-controls="profile" role="tab" data-toggle="tab" class="<?php if($option == 'wishlist') {echo 'active in'; }?>">Wishlist</a></li>

    				</ul>
				</div>
				<div class="modal-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade  <?php if(empty($option)) {echo 'active in'; }?>" id="carttab">
							<div id="cartView">
							 <?php require 'cart.php';?>
							</div>
						</div>

						<div role="tabpanel" class="tab-pane fade <?php if($option == 'wishlist') {echo 'active in'; }?>" id="wishlist">
							<div id="wishlistContent">
							<?php require 'wishlist.php';?>
							</div>
						</div>

					</div>
				</div>
</div>