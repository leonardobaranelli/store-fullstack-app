<?php if(isset($management)) : ?>
    <h1>Manage my orders</h1>
<?php else: ?>
    <h1>My orders</h1>
<?php endif; ?>
<table>
    <tr>
        <th>Order number</th>
        <th>Cost</th>        
        <th>Date</th>
        <th>Status</th>
    </tr>
    <?php while($order = $order->fetch_object()): ?>
        <tr>
            <td>
                <a href="<?=base_url?>order/details&id=<?=$order->id?>"><?=$order->id?></a>
            </td>
            <td>
                $ <?=$order->cost?>
            </td>
            <td>
                <?=$order->date?>
            </td>            
            <td>
                <?=Utils::show_status($order->status)?><br>
            </td>            
        </tr>
    <?php endwhile; ?>
</table>