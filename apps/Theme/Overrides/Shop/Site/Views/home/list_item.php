<?php $item = $this->item; ?>

<article id="product-<?php echo $item->id; ?>" class="list-item product-<?php echo $item->id; ?>">

    <?php if ($item->{'details.featured_image.slug'}) { ?>
    <div class="product_thumb dsc-wrap">
        <div class="dsc-wrap product_listimage">
            <a href="<?php echo $item->_url; ?>">
                <img src="./asset/thumb/<?php echo $item->{'details.featured_image.slug'}; ?>" title="<?php echo $item->{'metadata.title'}; ?>" alt="<?php echo $item->{'metadata.title'}; ?>">
            </a>
        </div>
    </div>
    <?php } ?>
    
    <div class="dsc-wrap product-info">
        <h3 class="dsc-wrap product_name">
            <a href="<?php echo $item->_url; ?>"> <?php echo $item->{'metadata.title'}; ?> </a>
        </h3>    

        <div class="dsc-wrap product-price-wrapper">
            <span id="product-price-<?php echo $item->id; ?>" class="product-price">[cur][price]</span>
            <h4><strong>$206.00 </strong> <strike><small>$229.82</small></strike></h4>
        </div>
    </div>

</article>