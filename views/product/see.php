<?php if(isset($product)):?>
    <h1><?=$product->name?></h1>
    <div id="product-detail">
        <div class="image">
            <?php if($product->image != null): ?>
                <img src="<?=base_url?>uploads/images/<?=$product->image?>" />
            <?php else: ?>    
                <img src="<?=base_url?>assets/img/t-shirt.png" />
            <?php endif; ?>    
        </div>
        <div class="data">
            <p><?=$product->description?></p></br>            
            <p>$<?=$product->price?></p></br>
            <a href="<?=base_url?>cart/add&id=<?=$product->id?>" class="button">Buy</a>
        </div>
    </div>
<?php else: ?>
    <h1>The product does not exist</h1>
<?php endif; ?>