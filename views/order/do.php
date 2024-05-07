<?php if(isset($_SESSION['identify'])): ?>
    <h1>Make order</h1>
    <p>
        <a href="<?=base_url?>cart/index">View the products and the price of your order</a>
    </p>
    </br>

    <h3>Shipping address</h3>
    <form action="<?=base_url.'order/add'?>" method="POST">
        <label for="province">State or province</label>
        <input type="text" name="province" required/>

        <label for="location">Location</label>
        <input type="text" name="location" required/>

        <label for="address">Address</label>
        <input type="text" name="address" required/>
        
        <input type="input" name="Confirm order" />
    </form>

<?php else: ?>
    <h1>You need to sign in to place your order</h1>
<?php endif; ?>

