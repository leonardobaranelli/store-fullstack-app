<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>T-shirt store</title>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
    </head>
    <body>
        <div id="container" >
            <header>
                <div id="logo">
                    <img src="<?=base_url?>assets/img/t-shirt.png" alt="T-shirt logo" />
                    <a href="<?=base_url?>">
                        <h1>T-shirt store</h1>
                    </a>
                </div>
            </header>

            <?php $categories = Utils::show_categories(); ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">Home</a>
                    </li>
                    <?php while($category = $categories->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url?>category/see&id<?=$category->id?>"><?=$category->name?></a>
                        </li>            
                    <?php endwhile; ?>        
                </ul>
            </nav>

            <div id="content">