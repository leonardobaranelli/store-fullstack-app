<h1>Product management</h1>

<a href="<?=base_url?>product/create" class="button button-small">
    Create Product
</a>

<?php if(isset($_SESSION['product']) && $_SESSION['product'] == 'completed'): ?>
    <strong class="alert-green">The product has been created successfully</strong>
<?php elseif(isset($_SESSION['product']) && $_SESSION['product'] != 'completed'): ?>
    <strong class="alert-red">The product has not been created correctly</strong>
<?php endif; ?>
<?php Utils::delete_session('product'); ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed'): ?>
    <strong class="alert-green">The product has been deleted successfully</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'completed'): ?>
    <strong class="alert-red">The product has not been deleted correctly</strong>
<?php endif; ?>
<?php Utils::delete_session('delete'); ?>

<table>
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>PRICE</th>
        <th>STOCK</th>
        <th>ACTIONS</th>
    </tr>        
    <?php while($product = $products->fetch_object()): ?>
        <tr>
            <td><?=$product->id?></td>
            <td><?=$product->name?></td>
            <td><?=$product->price?></td>
            <td><?=$product->stock?></td>
            <td>
                <a href="<?=base_url?>product/edit&id=<?=$product->id?>" class="button button-management">Edit</a>
                <a href="<?=base_url?>product/delete&id=<?=$product->id?>" class="button button-management button-red">Delete</a>                
            </td>
        </tr>        
    <?php endwhile; ?>
</table>