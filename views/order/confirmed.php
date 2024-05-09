<?php if(isset($_SESSION['order']) && $_SESSION['order'] == 'confirmed'): ?>
    <h1>Your order has been confirmed</h1>
    <p>Your order has been saved successfully. After you make the payment to the account 098304958304, 
        the order will be processed and shipped.</p>
    <br>

    <?php if(isset($order)): ?>
        <h3>Order details:</h3>
        Order number: <?=$order->id?><br>
        Total amount: <?=$order->cost?><br><br>
        Products:<br>

        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Units</th>
            </tr>
            <?php while($product = $products->fetch_object ()): ?>
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
                <?=$product->units?>
            </td>
            </tr>
        </table>
        <?php endwhile; ?>    
    <?php endif; ?>
<?php elseif(isset($_SESSION['order']) && $_SESSION['order'] != 'confirmed'): ?>
    <h1>Your order has not been confirmed</h1>
<?php endif; ?>    

