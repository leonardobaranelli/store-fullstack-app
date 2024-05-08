<?php if(isset($order)): ?>
    <?php if(isset($_SESSION['admin'])): ?>
        <h3>Change the status of the order:</h3>
        <form action="<?=base_url?>order/status" method="POST">
            <input type="hidden" value="<?=$order->id?>" name="order_id"/>
            <select name="status">
                <option value="pending" <?=$order->status == 'pending' ? 'selected' : '';?>>Pending</option>
                <option value="preparation" <?=$order->status == 'preparation' ? 'selected' : '';?>>Preparation</option>
                <option value="ready" <?=$order->status == 'ready' ? 'selected' : '';?>>Ready to Ship</option>
                <option value="sent" <?=$order->status == 'sent' ? 'selected' : '';?>>Sent</option>
            </select>
            <input type="submit" value="Change status">
        </form>
        </br>
    <?php endif; ?>
    <h3>Shipping Address</h3>
    Province: <?=$order->province?></br>
    Location: <?=$order->location?></br>
    Address: <?=$order->address?></br></br>

    <h3>Order Detais:</h3>
    Status: <?=Utils::show_status($order->status)?></br>
    Order Number: <?=$order->id?></br>
    Total Cost: <?=$order->coste?></br></br>
    Products:</br>

    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
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
        <?php endwhile; ?>    
    </table>
<?php endif; ?>