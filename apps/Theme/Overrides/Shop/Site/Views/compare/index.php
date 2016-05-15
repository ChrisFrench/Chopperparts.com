<?php $columns = 3;?>

<table class="table table-hover table-striped">

<?php $specs = $category->product_specs;
?>
<thead>
<td class="col-sm-<?php echo $columns; ?>"><h3>COMPARE</h3></td>
<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?> topAlign">
	<div class="product_listimage">
            <a href="/shop/product/<?php echo $item->slug; ?>">
            <?php   if (((int) $item->get('flag.enabled') > 0) && strlen($item->get('flag.text')) ) { ?>
           		 <div class="flag orange"><span><?php echo $item->get('flag.text'); ?></span></div>
           	<?php } ?>
                <img class="img-responsive" src="<?php echo \RallyShop\Models\Products::mobile_thumb_rsd($item->{'featured_image.slug'});?>" title="<?php echo $item->{'metadata.title'}; ?>" alt="<?php echo $item->{'metadata.title'}; ?>">
            </a>
            
            
            <div class="text-center paddingTopSm compareFix"><small><?php echo $item->title; ?></small></div>
           
           <a href="/shop/product/<?php echo $item->slug; ?>" class="btn btn-block btn-primary" >See Product   <small><i class="fa fa-chevron-right"></i></small></a>
	</div>
</td>

<?php endforeach;?>
</thead>

<?php /*=========================PRICE=========================*/?>
<tr class="price">
<td class="col-sm-<?php echo $columns; ?>">
<strong>Sale Price</strong>
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">
 <?php if ($item->{'policies.hide_price'}) : ?>
                <p>Call for price.</p>
            <?php  else : ?>       
                  
            
                    <strong class="newPrice"><?php echo \Shop\Models\Currency::format( $item->price() ); ?></strong>
               

  <?php endif; ?>
</td>


<?php endforeach;?>
</tr>


<?php /*=========================STOCK STATUS=========================*/?>
<tr class="stockState">
<td class="col-sm-<?php echo $columns; ?>">
<strong>Stock Status</strong>
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">
  <?php switch ($item->stockStatus()) : 

												case 'instock': ?>

													INSTOCK
													<?php break; ?>
													
													<?php case 'outofstock': ?>
													OUT OF STOCK
												
													<?php break; ?>
													
													<?php //NOTE ONORDER IS NOT BUILT YET ?>
													<?php case 'onorder': ?>
													ON ORDER
													<?php break; ?>
											
	 <?php	endswitch; ?>
</td>


<?php endforeach;?>
</tr>




<?php /*=========================SHIPPING=========================*/?>
<?php /*?>
<tr class="shipping">
<td class="col-sm-<?php echo $columns; ?>">
Shipping
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">

DOES THIS EVEN APPLY?
</td>


<?php endforeach;?>
</tr>
<?php */ ?>
<?php /*=========================RETURNS=========================*/?>

<tr class="returns">
<td class="col-sm-<?php echo $columns; ?>">
<strong>Returns</strong>
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">

<?php if(!empty($item->{'policies.returns'})) : ?>
<?php switch ($item->{'policies.returns'}) {
	case 'rsd':
	echo '<h4><i><small>This product is covered by</small></i><br>
									<strong>100% Satisfaction Guarantee</strong><br>
									<i><small>30 Days - No Questions Asked</small></i>
		</h4>';
	break;
	case 'standard':
		echo '<h4>STANDARD</h4>';
	break;
	
	default:
		;
	break;
}?>
<?php else :?>
N/A
<?php endif;?>
</td>


<?php endforeach;?>
</tr>


<?php /*=========================RATINGS=========================*/?>
<tr class="ratings">
<td class="col-sm-<?php echo $columns; ?>">
<strong>Ratings</strong>
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">

<?php if(!empty($item->{'review_rating_counts.overall'})) : ?>
	<?php
		$stars = $item->{'review_rating_counts.overall'};
		echo \RallyShop\Models\UserContent::outputStars($stars, 5, true);
		echo ' (' . $item->{'review_rating_counts.total'} . ')'
	?>
	<br>
	<?php echo $item->{'review_rating_counts.overall'}?> out of 5 stars
<?php else : ?> 
						Not Yet Rated
													<?php endif;?>

</td>


<?php endforeach;?>
</tr>



<?php /*=========================VIDEOS=========================*/ /*?>
<tr class="ratings">
<td class="col-sm-<?php echo $columns; ?>">
Videos
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">

TODO NEED DATA
</td>


<?php endforeach;?>
</tr><?php */ ?>


<?php /*=========================WARRANTY=========================*/?>
<tr class="ratings">
<td class="col-sm-<?php echo $columns; ?>">
<strong>Warranty</strong>
</td>

<?php foreach($products as $item) :  ?>
<td class="col-sm-<?php echo $columns; ?>">
<?php if(!empty($item->{'manufacturer_warranty_period'})) :?>
<?php echo $item->{'manufacturer_warranty_period'} ?>
<?php else :?>
Not Available
<?php endif;?>
</td>
<?php endforeach;?>
</tr>

<?php
$i = 0;
foreach($specs as $key => $value) : ?>
<tr>
<td class="col-sm-<?php echo $columns; ?>">
<strong><?php echo $key; ?></strong>
</td>

<?php foreach($products as $item) :  ?>

<td class="col-sm-<?php echo $columns; ?>">
<?php echo $item->{'specs.'.$key};?>
</td>


<?php endforeach;?>
</tr>
<?php endforeach;?>



</table>
