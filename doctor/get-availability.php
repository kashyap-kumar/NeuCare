<?php
header('Content-type: application/json; charset=utf-8');

// database connection
require_once "../config/connection.php";

// get data from request
$doctor_id = $_GET['doctorid'];
$clinic_id = $_GET['clinicid'];
$appointment_date = $_GET['appointmentdate'];

// fetch data from database
$sql = "SELECT StartTime, EndTime FROM `Availability` WHERE Date='$appointment_date' AND DoctorID=$doctor_id AND ClinicID=$clinic_id";
$time_slots = $conn->query($sql)->fetch_all();

// response
echo json_encode($time_slots);

$conn->close();
exit;
?>