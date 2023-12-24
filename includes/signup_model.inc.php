<?php
//Querying the database
//This file only interacts with the database

declare(strict_types=1);

function get_username(object $pdo, string $username) {
    $query = "SELECT username FROM users WHERE username = :username;"; //placeholder :username
    $stmt = $pdo->prepare($query); //statement
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch assoc is fetching it as an associative array
    return $result;

}


//checking for email in the database
function get_email(object $pdo, string $email)  {
    $query = "SELECT username FROM users WHERE email = :email;"; //placeholder :username
    $stmt = $pdo->prepare($query); //statement
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch assoc is fetching it as an associative array
    return $result;
}


function set_user(object $pdo, string $username, string $password, string $email) {
    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);"; //placeholder :username
    $stmt = $pdo->prepare($query); //statement

    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);



    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

}

