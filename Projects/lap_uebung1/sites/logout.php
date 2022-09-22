<?php
    session_start();
    // Destroy Session - all Session-Variables get unset
    session_destroy();
    // Redirect to Login
    header("Location: ./login.php");
?>