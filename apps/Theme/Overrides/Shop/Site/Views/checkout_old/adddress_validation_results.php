
<?php if(count($addresses) == 1) : ?>
<h3>We've found the following address match:</h3>
<?php else :?>
<h3>We've found the following addresses that match:</h3>
<?php endif; ?>

<?php if(!empty($addresses)) : ?>

<?php foreach($addresses as $key =>  $address) :?>
<div class="alert alert-info alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<input type="radio" class="validationAddress" value='<?php echo $key;?>'

<?php foreach ($address as $addressKey => $addressValue) :?>
 data-<?php echo $addressKey; ?>="<?php echo $addressValue; ?>" 
<?php endforeach;?>
> &nbsp; 

<?php if(!empty($address['address1'])) {  echo  $address['address1']. ' ' ; }?>
<?php if(!empty($address['city'])) { echo  $address['city']. ',' ;  }?>
<?php if(!empty($address['stateProvince'])) { echo ' '. $address['stateProvince'] . ' ' ; }?>
<?php if(!empty($address['postalCode'])) { echo $address['postalCode'] ;  }?>



</div>

<?php endforeach; ?>



<?php endif;?>
