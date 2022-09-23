<?php
  session_start();
  $browser = get_browser(null, true);
  //if the user uses internet explorer, give them a message
  if($browser['browser'] == "IE"){
    echo "Sie verwenden einen nicht unterstützen Browser. Bitte laden Sie einen anderen herunter.";
  }else{
    //Redirect to login
    header('Location: ./sites/login.php');
  }
?>
