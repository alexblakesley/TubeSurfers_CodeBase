<?php

// $servername = "";
// $username = "";
// $password = "";
// $dbname = "";

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