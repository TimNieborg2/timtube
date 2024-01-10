<?php

$servername = "localhost"; // change to the servername.
$username = "test_user"; // change to the database user his username.
$password = "wachtwoord"; // change to the database user his password.
$database = "timtube"; // change to database name.

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Fout bij de verbinding met de database: " . $e->getMessage();
}