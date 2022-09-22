<?php
    session_start();
    require_once('../classes/database.php');

    // Check if email and password has been submitted
    if(isset($_POST['email']) && isset($_POST['password'])){
        // get user from database
        $user = $database->getUserByMail($_POST['email']);
        // check if correct login was used
        if($_POST['role'] == $user->roleId){
            // check for valid password
            if(password_verify($_POST['password'], $user->password)){
                // store user in session-variable
                $_SESSION['user'] = serialize($user);
                // redirect depending on userrole
                if($user->roleId == 1){
                    header("Location: ./productAdministration.php");
                }else{
                    header("Location: ./overview.php");
                }
            } else {
                header("Location: ./login.php");
            }
        } else {
            header("Location: ./login.php");
        }
    }
?>