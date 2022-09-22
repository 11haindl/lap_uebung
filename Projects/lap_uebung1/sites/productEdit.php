<?php
session_start();
require_once('../classes/database.php');
include('../src/header.php');
include('../src/navbar.php');

$users = $database->getAllUsers();

// check if product id is submitted
if (isset($_POST['id'])) {
    // get product to be edit by its id
    $product = $database->getProductById($_POST['id']);
}

// if user clicked "speichern", check for needed data to update product
if (isset($_POST['save']) && isset($_POST['product-id']) && isset($_POST['product-name']) && isset($_POST['product-price']) && isset($_POST['users'])) {
    // update product in database
    $database->updateProductInfo($_POST['product-id'], $_POST['product-name'], $_POST['product-price'], $_POST['users']);
    // get updated product
    $product = $database->getProductById($_POST['product-id']);
}

// if user clicked "Löschen", check for product id of product to be deleted
if (isset($_POST['delete']) && isset($_POST['product-id'])) {
    // delete product from database
    $database->deleteProduct($_POST['product-id']);
    // redirect to product administration page after deleting product
    header("Location: ./productAdministration.php");
}
?>

<h1>Produkt-Bearbeitung</h1>

<form action="productEdit.php" method="post">
    ID: <?php echo $product->id ?><br>
    <input type="hidden" required name="product-id" value="<?php echo $product->id ?>">
    Name: <input type="text" required name="product-name" value="<?php echo $product->name ?>"><br>
    Preis: <input type="number" step="any" required name="product-price" value="<?php echo $product->price ?>"><br>
    <label for="users">Verkäufer:</label>
    <!-- select option field for product seller -->
    <select name="users" id="users">
        <!-- create an option for every user -->
        <?php foreach ($users as $option) { ?>
            <!-- value should be the id of the user. If the id of the user is equal to the userId of the product, it should be marked as selected -->
            <option value="<?php echo $option->id ?>" <?php if($option->id == $product->userId){ echo "selected";} ?>>
                <?php echo $option->firstName . " " . $option->lastName ?>
            </option>
        <?php } ?>
    </select><br>

    <input type="submit" name="save" value="Speichern">
    <input type="submit" name="delete" value="Löschen">
</form>


<?php
include('../src/footer.php');
?>