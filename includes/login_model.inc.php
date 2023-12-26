<?php


declare(strict_types=1);

function get_user(object $pdo, string $username) {
    $query = "SELECT * FROM users WHERE username = :username;"; //placeholder :username
    $stmt = $pdo->prepare($query); //statement
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); //fetch assoc is fetching it as an associative array
    return $result;
}

?>