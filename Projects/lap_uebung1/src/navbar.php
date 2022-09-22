<!-- navbar -->
<?php
// check if there is a user session variable set
if (isset($_SESSION['user'])) {
  // unserialize the user session variable to a user object
  $currentUser = unserialize($_SESSION['user']);
}
?>
<ul>
  <li><a href="./overview.php">Produkte</a></li>
  <li><a href="./cart.php">Warenkorb</a></li>
  <?php
  // menu items that only a user with role 1 should have access to
  if (($currentUser->roleId) == 1) {
  ?>
    <li><a href="./productAdministration.php">Produktverwaltung</a></li>
    <li><a href="./createUser.php">Benutzer anlegen</a></li>
  <?php } ?>
  <li><a href="./logout.php">Logout</a></li>
</ul>