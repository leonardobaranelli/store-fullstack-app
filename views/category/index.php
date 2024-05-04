<h1>Manage categories</h1>

<a href="<?=base_url?>category/create" class="button button-small">
    Create Category
</a>

<table>
    <tr>
        <th>ID</td>
        <th>NAME</td>
    </tr>        
    <?php while($category = $categories->fetch_object()): ?>
        <tr>
            <td><?=$category->id?></td>
            <td><?=$category->name?></td>
        </tr>        
    <?php endwhile;?>
</table>