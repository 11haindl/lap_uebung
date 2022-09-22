<?php
session_start();
require_once('../classes/database.php');
include('../src/header.php');
include('../src/navbar.php');
include('../src/search.php');

/* The Code for the cart is from https://codeshack.io/shopping-cart-system-php-mysql/
    - very useful for creating a shopping cart system */

// If the user clicked the button "zum Warenkorb hinzufügen", check submitted data
if (isset($_POST['product-id'], $_POST['quantity']) && is_numeric($_POST['product-id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $productId = (int)$_POST['product-id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0) {
        // Check if cart session variable already exists
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            // Check if product-id to be added is already in cart
            if (array_key_exists($productId, $_SESSION['cart'])) {
                // Yes: update quantity
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                // No: Add to cart with correct quantity
                $_SESSION['cart'][$productId] = $quantity;
            }
        } else {
            // No session variable for cart exists - create it and add first product to cart
            $_SESSION['cart'] = array($productId => $quantity);
        }
    }
}

// set up an array for all products in cart (ids and quantity)
$productsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
// create an empty array - will be filled with product objects
$products = array();
// iterate through all product ids in cart
foreach (array_keys($productsInCart) as $idInCart) {
    // get current product form database
    $dbProduct = $database->getProductById($idInCart);
    // push current product to products array
    array_push($products, $dbProduct);
}

// if user clicked "löschen", check for correct submitted data
if (isset($_POST['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_POST['delete-id']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_POST['delete-id']]);
    // redirect to cart-page for refreshing
    header("Location: ./cart.php");
}

?>

<h1>Warenkorb</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Bezeichnung</th>
        <th>Preis</th>
        <th>Menge</th>
        <th>Gesamtpreis</th>
    </tr>
    <?php
    // set total sum to 0.00
    $total = 0.00;
    // interate through products
    foreach ($products as $product) {
        // get quantity in cart of current product
        $quantity = $_SESSION['cart'][$product->id];
        // calculate subtotal for quantity of current product in cart
        $subtotal = ($product->price) * ($quantity);
        // sum up total sum with subtotal
        $total += $subtotal;
    ?>
    <!-- fill table with data from every product in cart  -->
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
                    <?php echo $quantity ?>
                    <input type="hidden" value="<?php echo $product->id ?>" name="delete-id">
                    <input type="submit" value="löschen" name="remove">
                </form>
            </td>
            <td>
                <?php echo $subtotal ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <?php echo $total ?>
        </td>
    </tr>
</table>

<!-- Print cart -->
<button onclick="window.print()">Drucken</button>


<?php
include('../src/footer.php');
?>