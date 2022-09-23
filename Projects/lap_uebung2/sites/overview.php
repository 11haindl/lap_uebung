<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');
    include('../src/search.php');

    // get all products from database
    $products = $database->getProducts("");
?>

<h1>Produkte</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Bezeichnung</th>
        <th>Preis</th>
        <th></th>
    </tr>
    <?php 
        // create a row for each product
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
            <!-- add product to cart -->
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
    include('../src/footer.php');
?>