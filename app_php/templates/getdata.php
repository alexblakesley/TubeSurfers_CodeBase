<?php

// $servername = "";
// $username = "";
// $password = "";
// $dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo $_POST['station_from'];

// $station_from = $_POST['station_from'];
// $station_to = $_POST['station_to'];
// $line = $_POST['line'];
// $data_type = $_POST['data_type'];
// $data_name = $_POST['data_name'];

$station_from = mysqli_real_escape_string($conn, $_POST['station_from']);
$station_to = mysqli_real_escape_string($conn, $_POST['station_to']);
$line = mysqli_real_escape_string($conn, $_POST['line']);
$data_type = mysqli_real_escape_string($conn, $_POST['dataType']);
$data_name = mysqli_real_escape_string($conn, $_POST['dataName']);

if ($data_type == "Timestamp") {
    $sql = 'SELECT MIN(`Timestamp`) FROM `Timestamps` WHERE `FromStation` = "' . $station_from . '" AND `ToStation` = "' . $station_to . '" AND `TubeLine` = "' . $line . '"';
}
else {
    $sql = 'SELECT * FROM `Timestamps` LEFT JOIN `Data` ON `Timestamps`.`DBid` = `Data`.`TimestampID` WHERE `FromStation` = "' . $station_from . '" AND `ToStation` = "' . $station_to . '" AND `TubeLine` = "' . $line . '" AND `DataType` = "' . $data_type . '" AND `DataName` = "' . $data_name . '"';

}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode("{}");
}

$conn->close();
?>