<aside id="sidebar">

<div id="cart" class="block-aside" >
    <h3>My cart</h3>
    <ul>
        <?php $stats = Utils::stats_cart(); ?>
        <li><a href="<?=base_url?>cart/index">Products (<?=$stats['count']?>)</a></li>        
        <li><a href="<?=base_url?>cart/index">Total: $<?=$stats['total']?></a></li>    
        <li><a href="<?=base_url?>cart/index">See the cart</a></li>
    </ul>
</div>

<div id="login" class="block-aside" >

    <?php if(!isset($_SESSION['identify'])): ?>
    <h3>Enter the website</h3>
    <form action="<?=base_url?>user/login" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" />

        <label for="password">Password</label>
        <input type="password" name="password" />

        <input type="submit" value="Send" />
    </form>    
    <?php else: ?>
        <h3><?=$_SESSION['identify']->name?> <?=$_SESSION['identify']->last_name?></h3>
    <?php endif; ?>

    <ul>        
        <?php if(isset($_SESSION['admin'])):?>
            <li><a href="<?=base_url?>category/index">Manage categories</a></li>
            <li><a href="<?=base_url?>product/management">Manage products</a></li>
            <li><a href="<?=base_url?>order/management">Manage orders</a></li>
        <?php endif; ?>  
        
        <?php if(isset($_SESSION['identify'])):?>
            <li><a href="<?=base_url?>order/my_orders">My orders</a></li>            
            <li><a href="<?=base_url?>user/logout">Logout</a></li>            
        <?php else: ?>   
            <li><a href="<?=base_url?>user/register">Sign up here</a></li>               
        <?php endif; ?>   
    </ul>
</div>

</aside>

<div id="central">