<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_controller.inc.php';

        //error handlers 
        $errors = [];


        if(is_input_empty($username, $password)) {
            $errors["empty_input"] = "Fill in all the fields!"; 
        }

        $result = get_user($pdo, $username);

        if(is_username_wrong($result)) {
            $errors['login_incorrect'] = "Incorrect login field";
        }

        if(!is_username_wrong($result) && is_password_wrong($password, $result['pwd'])) {
            $errors['login_credentials'] = "Incorrect Login Credentials!";
        }
        

        require_once 'config_session.inc.php';

        if($errors) {
            $_SESSION['errors_login'] = $errors;



            header("location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION['user_id'] = $result["id"];
        $_SESSION['user_username'] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../index.php?login=success");
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Connection failed:  " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
