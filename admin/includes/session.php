<?php
session_start();

// check if the admin is already logged in or not, if not, redirect to login page
if (!isset($_SESSION["is_app_admin_loggedin"]) || $_SESSION["is_app_admin_loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// session variables needed in admin panel will go here
$admin_name = strval($_SESSION["name"]);
$admin_id = strval($_SESSION['id']); // for app admin panel
$clinic_id = strval($_SESSION['id']); // for clinic admin panel
?>