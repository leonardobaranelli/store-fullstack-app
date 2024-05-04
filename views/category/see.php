<?php if(isset($category)):?>
    <h1><?=$category->name?></h1>
    <?php if($products->num_rows == 0): ?> 
        <p>There are not products to show</p>
    <?php else: ?>                    
        <?php while($product = $products->fetch_object()): ?>
            <div class="product">
                <a href="<?=base_url?>product/see&id=<?=$product->id?>">
                <?php if($product->image != null): ?>
                    <img src="<?=base_url?>uploads/images/<?=$product->image?>" />
                <?php else: ?>    
                    <img src="<?=base_url?>assets/img/t-shirt.png" />
                <?php endif; ?>    
                <h2><?=$product->name?></h2>
                <h2><?=$product->description?></h2>
                <h2><?=$product->price?></h2>
                <a href="<?=base_url?>cart/add&id=<?=$product->id?>" class="button">Buy</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
<?php else: ?>
    <h1>The category does not exist</h1>
<?php endif; ?>