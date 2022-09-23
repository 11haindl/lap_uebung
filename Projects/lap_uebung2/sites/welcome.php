<?php
session_start();
require_once('../classes/database.php');
require_once('../classes/activityType.php');
include('../src/header.php');
include('../src/navbar.php');
include('../src/search.php');

// if the user session varible is set
if (isset($_SESSION['user'])) {
    // unserialize to user object
    $user = unserialize($_SESSION['user']);
    // get last login for user
    $activity = $database->getLastActivityByType(ActivityType::LOGIN, $user->id);
}
?>

<h1>Willkommen!</h1>

<!-- personalized welcome message -->
Willkommen bei unserem Webshop, <?php echo $user->firstName . " " . $user->lastName ?>!<br><br>

<?php 
    //if there could be no login activity found, echo a message
    if($activity == false){
        echo "Sie haben sich zum Ersten Mal eingeloggt.";
    }else {
        // last login found - so show information to user
        echo "zu letzt eingeloggt am ". $activity->timeStamp ." - ". $activity->description;
    }
    // get browser information
    $browser = get_browser(null, true);
    // get users ip address
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    // create a new login activity in database
    $database->createActivity(ActivityType::LOGIN, "Browser: ".$browser['browser']. ", IP-Adresse: ". $ipAddress, $user->id);
?>


<?php
include('../src/footer.php');
?>