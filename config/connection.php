<?php
    require_once "credentials.php";

    // attempt to connect the database
    $conn = new mysqli($db_host, $db_username, $db_password, $db_database);

    // fail attempt, redirect to error page
    if($conn->connect_error) header("location: ../error.html");
?>