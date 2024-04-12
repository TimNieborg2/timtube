<?php

$servername = ""; // change to the servername.
$username = ""; // change to the database user his username.
$password = ""; // change to the database user his password.
$database = ""; // change to database name.

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Fout bij de verbinding met de database: " . $e->getMessage();
}
