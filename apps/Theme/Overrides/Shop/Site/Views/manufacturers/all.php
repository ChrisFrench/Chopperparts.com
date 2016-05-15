
<script type="text/javascript">
	jQuery(document).ready(function() {
		var window = $('body .container').width;
		var offset = 250;
	 	var duration = 300;
	 	var container = jQuery('.container').width()-30;
	 	jQuery('#return-btn').css('width',container);
		jQuery(window).scroll(function() {
	 		if (jQuery(this).scrollTop() > offset && container<=770) {
	 		jQuery('#return-btn').fadeIn(duration);
	 		} else {
	 			jQuery('#return-btn').fadeOut(duration);
	 		}
	 	});
		jQuery('#return-btn').click(function(event) {
			event.preventDefault();
	 		jQuery('html,body').animate({scrollTop: 0}, duration);
	 		return false;
	 	})
	 	//remove letters that dont exist
	 	var brandsArr =[];
		$('#brandlistings').html('');
		$('#brands-page h3').each( function( index, element ){
			var brandLink = $(this).attr('id');
			brandsArr.push(brandLink);
		});
		for(var i = 0; i <= (brandsArr.length-1); i++) {
		$('#brandlistings').append('<li><a href="brands#'+brandsArr[i]+'">'+brandsArr[i]+'</a></li>');
		}
			 	
	 	
	});
</script>
<div id="brands-page">
<div id="return-btn">
Back To Top
</div>
<h2>BRANDS</h2>
<div class="row"> 
<div class="col-lg-12 paddingTop">
		<ul class="list-inline">
			<li class="col-lg-2 col-md-4 col-sm-6 col-xs-6"><a href="/brand/grimmspeed">
				<img src="/theme/img/LogoIcon01_over.png" alt="160x66" class="img-responsive thumbnail">
			</a> </li>
			<li class="col-lg-2 col-md-4 col-sm-6 col-xs-6"><a href="/brand/kartboy">
				<img src="/theme/img/LogoIcon02_over.png" alt="160x66" class="img-responsive thumbnail">
			</a></li>
			<li class="col-lg-2 col-md-4 col-sm-6 col-xs-6"><a href="/brand/invidia">
				<img src="/theme/img/LogoIcon03_over.png" alt="160x66" class="img-responsive thumbnail">
			</a></li>
			<li class="col-lg-2 col-md-4 col-sm-6 col-xs-6"><a href="/brand/cobb-tuning">
				<img src="/theme/img/LogoIcon04_over.png" alt="160x66" class="img-responsive thumbnail">
			</a></li>
			<li class="col-lg-2 col-md-4 col-sm-6 col-xs-6"><a href="/brand/tomei">
				<img src="/theme/img/LogoIcon05_over.png" alt="160x66" class="img-responsive thumbnail">
			</a></li>
			<li class="col-lg-2 col-md-4 col-sm-6 col-xs-6"><a href="/brand/perrin">
				<img src="/theme/img/LogoIcon06_over.png" alt="160x66" class="img-responsive thumbnail">
			</a></li>
	
		</ul>
		
</div>

</div>
<hr/>
<div class="row"> 

<div class="col-lg-12 ">
<span class="col-lg-2 col-md-2">A-Z Brands List</span>
<ul id="brandlistings"class="col-lg-10  col-md-10 list-inline bold">
	<li><a href="brands#A">A</a>
	<li><a href="brands#B">B</a>
	<li><a href="brands#C">C</a>
	<li><a href="brands#D">D</a>
	<li><a href="brands#E">E</a>
	<li><a href="brands#F">F</a>
	<li><a href="brands#G">G</a>
	<li><a href="brands#H">H</a>
	<li><a href="brands#I">I</a>
	<li><a href="brands#J">J</a>
	<li><a href="brands#K">K</a>
	<li><a href="brands#L">L</a>
	<li><a href="brands#M">M</a>
	<li><a href="brands#N">N</a>
	<li><a href="brands#O">O</a>
	<li><a href="brands#P">P</a>
	<li><a href="brands#Q">Q</a>
	<li><a href="brands#R">R</a>
	<li><a href="brands#S">S</a>
	<li><a href="brands#T">T</a>
	<li><a href="brands#U">U</a>
	<li><a href="brands#V">V</a>
	<li><a href="brands#W">W</a>
	<li><a href="brands#X">X</a>
	<li><a href="brands#Y">Y</a>
	<li><a href="brands#Z">Z</a>
</ul>
</div>
</div>
<?php
/*
 * Loop THROUGH DOCS
 */
$package = array();
$numbers = array();
foreach ($brands as $doc): ?>

<?php
/*
 * PACKAGE THE BRANDS BY FIRST LETTER
 */
$letter = strtoupper(substr($doc['title'], 0,1)); 
if(is_numeric($letter)) {
	$numbers[] = $doc;	
} else {
	$package[$letter][] = $doc;
}


?>

<?php endforeach;?>
<?php if(!empty($numbers))  {
	$package['1-9'] = $numbers;
}?>



<?php 

$rows = array_chunk($package, 1, true);

foreach ($rows as $package) : ?>
<div class="row">
<?php foreach ($package as $key => $brands) : ?>

<div class="col-lg-2 col-md-2 paddingTop">

<h3 id="<?php echo $key;?>"><?php echo $key;?></h3>
</div>
<div class="col-lg-10 col-md-10 paddingTop">
<ul class="list-inline list-brands">
	<?php foreach ($brands as $doc) : ?>
	<li >
	<a href="/brand/<?php echo $doc['slug'];?>">
	<?php echo $doc['title'];?>
	</a>	
	</li>
	<?php endforeach; ?>
</ul>

</div>

<?php endforeach; ?>
</div>
<?php endforeach; ?>


</div>
