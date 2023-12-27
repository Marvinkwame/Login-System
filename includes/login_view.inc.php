<?php

declare(strict_types=1);

function output_username() {
    if(isset($_SESSION["user_id"])) {
        echo "You are logged in as " . $_SESSION["user_username"];
    } else {
        echo "You are logged out!";
    }
}

function check_login_erros() {
    if(isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p class='error-message'> " . $error . "</p>";
        }

        unset($_SESSION['erros_signups']);
    } else {
        if (isset($_GET['login']) && $_GET['login'] === "success") {
            echo '<br>';
            echo '<p class="form-sucess">Login Sucess</p>';
        }
    }
}

?>