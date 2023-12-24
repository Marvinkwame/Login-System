<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username =  $_POST["username"];
    $password =  $_POST["password"];
    $email = $_POST["email"];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_controller.inc.php';

        //error handlers 
        $errors = [];


        if(is_input_empty($username, $password, $email)) {
            $errors["empty_input"] = "Fill in all the fields!"; 

        }

        //checks whether its valid
        if(is_email_invalid($email)) {
            $errors["invalid-_email"] = "Invalid Email!"; 
        }

        //check for username
        if(is_user_taken($pdo, $username)) {
            $errors["username_taken"] = "Username has already been taken!"; 
        }
        
        //heck if email is already registered
        if(is_email_registered($pdo, $email)) {
            $errors["email_taken"] = "Email has already exists!"; 
        }

        require_once 'config_session.inc.php';

        if($errors) {
            $_SESSION['error_signups'] = $errors;

            $signupData = [
                "username"  => $username,
                "email" => $email
            ];

            $_SESSION['signup_data'] = $signupData;


            header("location: ../index.php");
            die();
        }

        create_user($pdo, $username, $password, $email);

        header("Location: ../index.php?signup=success");
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
