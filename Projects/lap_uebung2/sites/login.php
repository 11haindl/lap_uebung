<?php
    session_start();
    require_once('../classes/database.php');
    include('../src/header.php');
?>

<h1>Login</h1>

<div class="grid-container">
  <div class="grid-item">
    User-Login
    <form action="processLogin.php" method="post">
        E-Mail: <input type="email" name="email" id="email" required><br>
        Passwort: <input type="password" name="password" id="password" required><br>
        <input type="hidden" name="role" value="2">
        <input type="submit" value="User-Login" name="user-login">
    </form>
  </div>
  <div class="grid-item">
    Administrator-Login
    <form action="processLogin.php" method="post">
        E-Mail: <input type="text" name="email"><br>
        Passwort: <input type="password" name="password"><br>
        <input type="hidden" name="role" value="1">
        <input type="submit" value="Administrator-Login">
    </form>
  </div>
</div>



<?php
    include('../src/footer.php');
?>
