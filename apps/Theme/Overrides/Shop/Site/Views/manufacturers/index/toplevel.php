<div class="row">
<div class="page-head" style="background: url('/asset/<?php echo $category->{'featured_image.slug'}; ?>') no-repeat;">
<span class="page-title"><?php echo $category->title; ?></span>

</div>
</div>

<div class="row">

<?php $cats = $category->getChildCategories(); ?>
<?php foreach($cats as $cat) :?>

	<?php if(empty($cat->{'featured_image.slug'})) {
		$bg = 'http://lorempixel.com/350/350/transport';
	} else {
		$bg = '/asset/'. $cat->{'featured_image.slug'};
	} ?>


		
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 paddingTop">
			  <div class="subCategoryTitle" style="background: url('<?php echo $bg;?>') no-repeat;">
			    <a class="subCategory" href="/shop/category<?php echo $cat->get('path'); ?>"><?php echo $cat->title; ?></a>
			  </div>
			</div>
	
		
	
<?php endforeach; ?>
</div>

<?php if ($category->title =="Engine") { ?>
	<div class="row">
		<div class="col-lg-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<a href="/shop/product/aeromotive-fuel-rails-subaru-wrx-2002-2014-sti-2007-2015">
							<div class="flag blue"><span>50%</br>OFF</span></div>
							<img src="/asset/thumb/2015-02-23-catalog-photos-products-aeromotive-aer-14134-1-lg-jpg"  class="img-responsive">
							</a>
							<a href="/shop/product/aeromotive-fuel-rails-subaru-wrx-2002-2014-sti-2007-2015">
								<h4>Aeromotive Fuel Rails Subaru WRX</h4>
							</a>								
								<h4><strong>$206.00 </strong> <strike><small>$229.82</small></strike></h4>
	
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<a href="/shop/product/beatrush-crank-pulley-most-subaru-models-inc-2002-2014-wrx-2004-2015-sti">
							<div class="flag orange"><span>NEW</span></div>
							<img src="/asset/2015-02-23-catalog-photos-products-beatrush-bea-s96010pa-1-lg-jpg" class="img-responsive">
							</a>
							<a href="/shop/product/beatrush-crank-pulley-most-subaru-models-inc-2002-2014-wrx-2004-2015-sti">
								<h4>Beatrush Crank Pulley </h4>
							</a>								
								<h4><strong>$330.60 </strong> <strike><small>$359.82</small></strike></h4>

						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<a href="/shop/product/grimmspeed-ceramic-coated-38-40mm-v-band-external-wastegate-uppipe-subaru-models-inc-2002-2014-wrx-2004-2015-sti">
							<img src="/asset/2015-02-23-catalog-photos-products-grimmspeed-grm-059002-1-lg-jpg" class="img-responsive">
							</a>
							<a href="/shop/product/grimmspeed-ceramic-coated-38-40mm-v-band-external-wastegate-uppipe-subaru-models-inc-2002-2014-wrx-2004-2015-sti">
								<h4>GrimmSpeed Ceramic Coated 38/40mm V-Band Uppipe</h4>
							</a>								
								<h4><strong>$345.82 </strong> <strike><small>$450.82</small></strike></h4>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<a href="/shop/product/act-streetlite-flywheel-subaru-models-inc-1998-2001-impreza-2-5rs">
							<img src="/asset/2015-02-23-catalog-photos-products-act-act-600185-1-lg-jpg" class="img-responsive">
							</a>
							<a href="/shop/product/act-streetlite-flywheel-subaru-models-inc-1998-2001-impreza-2-5rs">
								<h4>ACT StreetLite Flywheel</h4>
							</a>
								<h4><strong>$259.00 </strong> <strike><small>$359.82</small></strike></h4>
							
						</div>
			</div>
		</div>
<?php  } ?>