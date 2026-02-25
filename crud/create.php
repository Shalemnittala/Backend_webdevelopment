<?php
require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name  = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute([$name, $email]);

    echo "User created successfully. ID: " . $pdo->lastInsertId();

} else {
    echo "Only POST method allowed.";
}
?>