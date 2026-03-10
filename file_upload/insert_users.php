<?php

$dsn = "mysql:host=localhost;dbname=csci6040_study";
$user = "root";
$pass = "";

try {
    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

// open the CSV file
$handle = fopen(__DIR__ . "/data.csv", "r");

// skip the first row (header)
fgetcsv($handle);

while (($data = fgetcsv($handle)) !== false) {

    $name = $data[0];
    $email = $data[1];
    $pass = $data[2];

    // hash the password
    $hashPassword = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $email, $hashPassword]);
}

fclose($handle);

echo "Users added successfully!";
?>