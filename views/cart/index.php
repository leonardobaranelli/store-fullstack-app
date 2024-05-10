<h1>Shopping Cart</h1>

<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) >= 1): ?>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach($cart as $index => $element): 
        $product = $element['product'];
    ?>
        <tr>
            <td>
                <?php if($product->image != null): ?>
                    <img src="<?=base_url?>uploads/images/<?=$product->image?>" class="img-cart"/>
                <?php else: ?>    
                    <img src="<?=base_url?>assets/img/t-shirt.png" class="img-cart"/>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?=base_url?>/product/see&id=<?=$product->id?>"><?=$product->name?></a>
            </td>
            <td>
                <?=$product->price?>
            </td>
            <td>
                <?=$product['units']?>
                <div class="up-down">
                    <a href="<?=base_url?>cart/up&index=<?=$index?>" class="button">+</a>
                    <a href="<?=base_url?>cart/down&index=<?=$index?>" class="button">-</a>
                </div>
            </td>
            <td>
                <a href="<?=base_url?>cart/delete&index=<?=$index?>" class="button button-delete button-red">Delete</a>    
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</br>
<div class="delete-cart">
    <a href="<?=base_url?>cart/delete_all" class="button button-delete button-red">Empty Cart</a>    
</div>
<div class="total-cart">
    <?php $stats = Utils::stats_cart(); ?>
    <h3>Total Price: $<?=$stats['total']?></h3>
    <a href="<?=base_url?>order/do" class="button button-order">Proceed to Checkout</a>    
</div>

<?php else: ?>
    <p>Your cart is empty</p>
<?php endif; ?>