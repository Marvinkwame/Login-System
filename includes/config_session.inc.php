<?php 


//making sessions make secure
ini_set('session.use_only_cookies', 1); //SETTING IT TO TRUE
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, //
    'httponly' => true
]);


session_start();

//checks whether there is a cookie and updates it
if(!isset( $_SESSION["last_regeneration"])) {

    regenerate_session_id();
} else {
    $interval = 60*30; //30 minutes
    if((time() - $_SESSION['last_regeneration']) > $interval) { 
        regenerate_session_id();
     }
}


function regenerate_session_id() {
    session_regenerate_id(); //regenerates the seesion id to make it better and more secure
    $_SESSION["last_regeneration"] = time(); //checks the last time we updated our session id
}


?>