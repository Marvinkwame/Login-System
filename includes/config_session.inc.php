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

if (isset($_SESSION['user_id'])) {
    //checks whether there is a cookie and updates it
    if (!isset($_SESSION["last_regeneration"])) {

        regenerate_session_id_loggedIn();
    } else {
        $interval = 60 * 30; //30 minutes
        if ((time() - $_SESSION['last_regeneration']) > $interval) {
            regenerate_session_id_loggedIn();
        }
    }
} else {
    //checks whether there is a cookie and updates it
    if (!isset($_SESSION["last_regeneration"])) {

        regenerate_session_id();
    } else {
        $interval = 60 * 30; //30 minutes
        if ((time() - $_SESSION['last_regeneration']) > $interval) {
            regenerate_session_id();
        }
    }
}

function regenerate_session_id()
{
    session_regenerate_id(true); //regenerates the seesion id to make it better and more secure
    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $userId;
        session_id($sessionId);
    $_SESSION["last_regeneration"] = time(); //checks the last time we updated our session id
}

function regenerate_session_id_loggedIn()
{
    session_regenerate_id(true); //regenerates the seesion id to make it better and more secure
    $_SESSION["last_regeneration"] = time(); //checks the last time we updated our session id
}
