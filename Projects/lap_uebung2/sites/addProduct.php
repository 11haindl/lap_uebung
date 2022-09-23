<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
    include('../src/navbar.php');

    // get all Users
    $users = $database->getAllUsers();

    // check for needed data
    if(isset($_POST['save']) && isset($_POST['product-name']) && isset($_POST['product-price']) && isset($_POST['users'])){
        // create new Product in database
        $database->createProduct($_POST['product-name'], $_POST['product-price'], $_POST['users']);
        // redirect to product administration page
        header("Location: ./productAdministration.php");
    }
    
?>

<h1>Neues Produkt</h1>

<form action="addProduct.php" method="post">
    Name: <input type="text" required name="product-name"><br>
    Preis: <input type="number" step="any" required name="product-price"><br>
    <label for="users">Verkäufer:</label>
    <!-- select option field for product seller -->
    <select name="users" id="users">
        <!-- create an option for every user -->
        <?php foreach ($users as $option) { ?>
            <!-- value should be the id of the user -->
            <option value="<?php echo $option->id ?>">
                <!-- selectable text is the first and last name of the user -->
                <?php echo $option->firstName . " " . $option->lastName ?>
            </option>
        <?php } ?>
    </select><br>
    <input type="submit" name="save" value="Speichern">
</form>


<?php
    include('../src/footer.php');
?>