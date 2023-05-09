<?php

$servername = "tubesurfers-db.cql9ooxely3d.eu-west-2.rds.amazonaws.com";
$username = "masterUsername";
$password = "TubeSurfers1234!";
$dbname = "ts_db";

// BASE_URL = "tubesurfers.co.uk"
// DB_NAME = "tubesurfers-db.cql9ooxely3d.eu-west-2.rds.amazonaws.com"
// DB_DEFAULT_SCHEMA = "ts_db"
// DB_USERNAME = "masterUsername"
// DB_PASSWORD = "TubeSurfers1234!"

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<script>console.log('Nonono' );</script>";
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "<script>console.log('Works!' );</script>";
}

?>

Hello World!