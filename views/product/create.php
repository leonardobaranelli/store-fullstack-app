<?php if(isset($edit) && isset($product) && is_object($edit)) : ?>
    <h1>Edit product <?=$product->name?></h1>
    <?=$url_action = base_url.'product/save&id='.$product->id?>
<?php else: ?>
    <h1>Create product</h1>
    <?=$url_action = base_url.'product/save'?>
<?php endif; ?>    

<form class="form-container" action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?=isset($product) && is_object($product) ? $product->name : '';?>"/>

    <label for="description">Description</label>
    <textarea name="description"><?=isset($product) && is_object($product) ? $product->name : '';?></textarea>

    <label for="price">Price</label>
    <input type="text" name="price" value="<?=isset($product) && is_object($product) ? $product->price : '';?>"/>

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=isset($product) && is_object($product) ? $product->stock : '';?>"/> 
    
    <label for="category">Category</label>
    <?php $categories = Utils::show_categories(); ?>

    <select name="category">
        <?php while($category = $categories->fetch_object()): ?>            
            <option value="<?=$category->id?>" <?=isset($product) && is_object($product) && $category->id == $product->category_id ? 'selected' : '';?>>
                <?=$category->name?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="image">Image</label>
    <?php if(isset($product) && is_object($product) && !empty($product->image)): ?>
        <img src="<?=base_url?>uploads/images/<?=$product->image?>" class="thumb"/>
    <?php endif; ?>
    <input type="file" name="image" />

    <input type="submit" value="Save" />
</form>