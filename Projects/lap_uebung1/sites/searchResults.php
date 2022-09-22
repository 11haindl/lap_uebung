<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');
    include('../src/search.php');

    // Check is there is a search string
    if(isset($_POST['search-product'])){
        // get all products that contain the search string
        $products = $database->getProducts($_POST['search-product']);
    }
?>



<h1>Suchergebnisse</h1>

<?php
    // If there are products found, display table
    if($products){
?>
<table>
    <tr>
        <th>ID</th>
        <th>Bezeichnung</th>
        <th>Preis</th>
        <th></th>
    </tr>
    <?php 
    
        foreach($products as $product){
    ?>
    <tr>
        <td>
            <?php echo $product->id ?>
        </td>
        <td>
            <?php echo $product->name ?>
        </td>
        <td>
            <?php echo $product->price ?>
        </td>
        <td>
            <form action="cart.php" method="post">
                <input type="hidden" value="<?php echo $product->id ?>" name="product-id">
                <input type="number" min="0" value="0" name="quantity">
                <input type="submit" value="zum Warenkorb hinzufügen" name="add-to-chart">
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
<?php
    } else {
        echo "Keine Produkte gefunden";
    }
?>




<?php
    include('../src/footer.php');
?>