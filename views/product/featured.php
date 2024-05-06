<h1>Some of our products</h1>

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

