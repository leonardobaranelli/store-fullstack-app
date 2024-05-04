<h1>Register</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <strong >Registration completed successfully</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <strong >Registration failed, please enter the data correctly</strong>
<?php endif; ?>
<?php Utils::delete_session('register'); ?>

<form class="form-container" action="<?=base_url?>/user/save" method="POST">
    <label for="name">Name</label>    
    <input type="text" name="name" required />

    <label for="last_name">Last name</label>    
    <input type="text" name="last_name" required />

    <label for="email">Email</label>    
    <input type="email" name="email" required />

    <label for="password">Password</label>    
    <input type="password" name="password" required />

    <input type="submit" value="Sign up" />
</form>