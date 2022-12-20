<?php

// connect to database
require_once "../config/connection.php";

$email = $_POST['email'];

// sql query to check email existence
$sql = "SELECT `ID`, `Name` FROM `Doctor` WHERE `Email`='$email'";

// attempt to execute the query
$result = $conn->query($sql);

header('Content-type: application/json; charset=utf-8');

if ($result->num_rows == 0) {
    http_response_code(204);
} else {
    $data = $result->fetch_assoc();
    echo json_encode($data);
}

?>