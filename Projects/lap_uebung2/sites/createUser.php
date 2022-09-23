<?php
session_start();
require_once('../classes/database.php');
include('../src/header.php');
include('../src/navbar.php');

// get all user-roles
$roles = $database->getRoles();

// check if all needed data got submitted
if (
    isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['date-of-birth'])
    && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['street']) && isset($_POST['postalcode'])
    && isset($_POST['house-number']) && isset($_POST['city']) && isset($_POST['roles'])
) {
    // create new user in database
    $database->createUser(
        $_POST['first-name'],
        $_POST['last-name'],
        $_POST['email'],
        $_POST['date-of-birth'],
        $_POST['street'],
        $_POST['postalcode'],
        $_POST['house-number'],
        $_POST['city'],
        $_POST['roles'],
        $_POST['password']
    );
}

?>

<h1>Neuer Benutzer</h1>

<!-- form for user creation with limitations and validations for different fields -->
<form action="createUser.php" method="post">
    Vorname: <input type="text" required name="first-name" maxlength="255"><br>
    Nachname: <input type="text" required name="last-name" maxlength="255"><br>
    Geburtsdatum: <input type="date" required name="date-of-birth" max="<?php echo date("Y-m-d") ?>"><br>
    E-Mail: <input type="email" required name="email" maxlength="255"><br>
    Passwort: <input type="password" required name="password" maxlength="255" minlength="10"><br>
    Straße: <input type="text" required name="street" maxlength="255"><br>
    PLZ: <input type="text" required name="postalcode" maxlength="10"><br>
    Hausnummer: <input type="text" required name="house-number" maxlength="30"><br>
    Ort: <input type="text" required name="city" maxlength="255"><br>
    <label for="roles">Benutzerrolle:</label>
    <!-- select option field for roles -->
    <select name="roles" id="roles">
        <!-- create an option for every role -->
        <?php foreach ($roles as $role) { ?>
            <!-- value should be the id of the role -->
            <option value="<?php echo $role->id ?>">
                <!-- selectable text is role-name -->
                <?php echo $role->name ?>
            </option>
        <?php } ?>
    </select><br>
    <input type="submit" name="add-user" value="Benutzer anlegen">
</form>



<?php
include('../src/footer.php');
?>