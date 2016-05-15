<head>
	<base href="<?php echo $SCHEME . "://" . $HOST . $BASE . "/"; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo $this->app->get('meta.keywords'); ?>" />
	<meta name="description" content="<?php echo $this->app->get('meta.description'); ?>" />
	<meta name="generator" content="<?php echo $this->app->get('meta.generator'); ?>" />
	<?php if(!empty($canonical)) :?>
	<link rel="canonical" href="<?php echo $canonical;?>" />
	<?php endif; ?>
	<?php if(!empty($noindex)) :?>
	 <meta name="robots" content="noindex">
	 <?php endif; ?>
	<meta name="author" content="rallysportdirect.com">
	<link rel="icon" type="image/png" href="/favicon.ico">
	
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
       
    <!--[if lt IE 9]>
    <script src="/theme/js/html5shiv.min.js"></script>
    <script src="/theme/js/respond.min.js"></script>
    <![endif]-->
	
	
	<?php if($DEBUG) :  ?>
	 <link href="/minify/css" rel="stylesheet">
	<?php else :?>
	 <link href="/theme/css/styles.min.css" rel="stylesheet">
	<?php endif;?>
	
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<?php if($DEBUG) :  ?>
	<script src="/minify/js"></script>
	<?php else :?>
	<script src="/theme/js/scripts.min.js"></script> 
	<?php endif;?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<title><?php echo $this->app->get('meta.title'); ?></title>
	<meta property="fb:app_id" content="1485845135043370"/>
	<?php  $openGraph = $this->app->get('og');?>
	<?php foreach ($openGraph as $key => $value) : ?>
		<?php if(!empty($key) && !empty($value) && is_string($value)) : ?>
		<meta property="og:<?php echo $key;?>" content="<?php echo (string) $value;?>" />
		<?php endif;?>
	<?php endforeach;?>
	<?php if(!empty($metaproduct) && !empty($item)) : ?>
	<meta property="product:retailer_item_id"       content="<?php echo $item->{'tracking.model_number'}?>" />
  	<meta property="product:price:amount"           content="<?php echo number_format($item->price(), 2);?>" />
  	<meta property="product:price:currency"         content="USD" />
  	<meta property="product:shipping_weight:value"  content="<?php echo $item->{'shipping.weight'};?>" />
  	<meta property="product:shipping_weight:units"  content="lb" />
  	<meta property="product:age_group"  content="adult" />
  	<?php /*?>
  	<meta property="product:sale_price:amount"      content="Sample Sale Price: " />
 	<meta property="product:sale_price:currency"    content="Sample Sale Price: " />
  	<meta property="product:sale_price_dates:start" content="Sample Sale Price Dates: Start" />
  	<meta property="product:sale_price_dates:end"   content="Sample Sale Price Dates: End" />
  	<?php */ ?>
  	<?php if($item->inventory_count):?>
  	<meta property="product:availability"           content="in stock" />
  	<?php  else :?>
  	<meta property="product:availability"           content="available for order" />
  	<?php endif;?>
  	<meta property="product:condition"              content="new" />

	<?php if($item->{'manufacturer.title'}):?>
	<meta property="product:brand"              content="<?php echo $item->{'manufacturer.title'}?>" />
	<?php endif;?>

	<?php if($item->{'categories.0.title'}):?>
	<meta property="product:category"              content="<?php echo $item->{'categories.0.title'}?>" />
	<meta property="product:retailer_category"     content="<?php echo $item->{'categories.0.title'}?>" />

	<?php endif;?>

	<?php endif;?>
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#000000">
	<meta name="theme-color" content="#000000">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-5720398-1', 'auto');
		ga('require', 'ec');
	</script>
	<!-- Facebook Conversion Code for Checkouts - RallySport Direct 1 -->
	<script>(function() {
	var _fbq = window._fbq || (window._fbq = []);
	if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = 'https://connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
	}
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6031427322776', {'value':'0.00','currency':'USD'}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6031427322776&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
	<script src="//media.richrelevance.com/rrserver/js/<?php echo $RichRelVersion ; ?>/p13n.js"></script>
</head>