<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');

    // get all products from database
    $products = $database->getProducts("");
?>

<h1>Produktverwaltung</h1>

<!-- add new product -->
<form action="addProduct.php" method="get">
    <input type="submit" name="add-product" value="neues Produkt hinzufügen">
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Bezeichnung</th>
        <th>Preis</th>
        <th></th>
    </tr>
    <?php 
        // iterate through all products
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
            <!-- edit current product -->
            <form action="productEdit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $product->id ?>">
                <input type="submit" name="edit" value="Bearbeiten">
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
    include('../src/footer.php');
?>