<?php

declare(strict_types=1);

function signup_input() {
    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION['error_signups']['username_taken'])) {
        echo '<input type="text" name="username" placeholder="username" value="' . $_SESSION["signup_data"]["username"] . '" >';
    } else {
        echo '<input type="text" name="username" placeholder="username" >';
    }

    echo '<input type="password" name="password" placeholder="password" >';

    if(isset($_SESSION["signup_data"]["email"]) && 
    !isset($_SESSION['error_signups']['email_taken']) && $_SESSION['error_signups']['invalid-_email']) {
        echo '<input type="text" name="email" placeholder="email" value="' . $_SESSION["signup_data"]["email"] . '" >';
    } else {
        echo '<input type="text" name="email" placeholder="Email" >';
    }
}

function check_signups_errors()
{
    if (isset($_SESSION["error_signups"])) {
        $errors = $_SESSION["error_signups"];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p class='error-message'> " . $error . "</p>";
        }


        //When we have data inside our session variables that we dont need, we should delete them
        //Bascially for session security
        unset($_SESSION['erros_signups']);
    } else {
        if (isset($_GET['signup']) && $_GET['signup'] === "success") {
            echo '<br>';
            echo '<p class="form-sucess">Signup Sucess</p>';
        }
    }
}
