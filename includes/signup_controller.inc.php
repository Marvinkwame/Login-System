<?php

//Controller files interacts with functions in the model files
//Takes care of handling inputs from the user 

declare(strict_types=1);

function is_input_empty(string $username, string $password, string $email) {
    if(empty($username) || empty($password) || empty($email)) {
        return true;

    } else {
        return false;
    }
}


function is_email_invalid(string $email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;

    } else {
        return false;
    }
}

function is_user_taken(object $pdo, string $username): bool {
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) {
    if(get_email($pdo, $email)) {
        //Check to see if email already exists in database. If it does, return true. Otherwise, return false.
        return true;
    } else {
        return false;
    }

    
}

function create_user(object $pdo, string $username, string $password, string $email) {
    set_user( $pdo, $username, $password, $email);
}