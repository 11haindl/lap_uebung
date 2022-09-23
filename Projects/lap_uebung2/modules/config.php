<?php
    require_once('../classes/database.php');

    // define database credencials
    define('DB_HOST', 'localhost');
    define('DB_USER', 'lapuser');
    define('DB_PASS', 'Q^jtvXrRTbah)8FN');
    define('DB_NAME', 'lap_uebung');

    // create new Database
    $database = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>