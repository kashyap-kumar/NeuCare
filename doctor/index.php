<?php

// initialize a session
session_start();

// check if the user is already logged in or not, if not, redirect to login page
if (!isset($_SESSION["is_doctor_loggedin"]) || $_SESSION["is_doctor_loggedin"] !== true) {
    header("location: register.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Profile</title>
</head>
<body>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <p class="text-muted text-center fs-4">Hi <?= $_SESSION["name"] ?>, thanks for registering in our platform! Currently we don't have any feature for doctors. Please ask your clinics to add you in their clinic by providing your email to them.</p>
    </div>
</body>
</html>