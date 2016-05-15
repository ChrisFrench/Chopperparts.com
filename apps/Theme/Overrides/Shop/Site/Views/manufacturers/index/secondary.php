<div class="row">

<?php $cats = $category->getChildCategories(); ?>
<?php foreach($cats as $cat) :?>

	<?php if(empty($cat->{'featured_image.slug'})) {
		$bg = 'http://lorempixel.com/350/350/transport';
	} else {
		//featured_image is set in the admin Images Tab.
		$bg = '/asset/'. $cat->{'featured_image.slug'};
	} ?>

	
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 paddingTop">
			  <div class="subCategoryTitle" style="background: url('<?php echo $bg;?>') no-repeat;">
			    <a class="subCategory" href="/shop/category<?php echo $cat->get('path'); ?>"><?php echo $cat->title; ?></a>
			  </div>
			</div>
	
	
<?php endforeach; ?>
</div>




