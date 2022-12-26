<?php
session_start();
require_once "../config/connection.php";

// take data from parameters and session
$appointment_date = $_GET['appointmentdate'];
$time_slot = $_GET['timeslot'];
$clinic_id = $_GET['clinicid'];
$doctor_id = $_GET['doctorid'];
$patient_id = $_SESSION['id'];

// check if more patient can be equipped in the same time slot
$sql = "SELECT COUNT(`ID`) AS total FROM `Appointment` WHERE `Date`='$appointment_date' AND `Time`='$time_slot' AND `DoctorID`=$doctor_id AND `Status`=0";

if($conn->query($sql)->fetch_assoc()['total'] > 6){
    http_response_code(204); // returning no content
    exit;
}

$sql = "SELECT COUNT(`ID`) AS total FROM `Appointment` WHERE `Date`='$appointment_date' AND `Time`='$time_slot' AND `DoctorID`=$doctor_id AND `PatientID`=$patient_id AND `Status`=0";
if($conn->query($sql)->fetch_assoc()['total'] > 0){
    http_response_code(204); // returning no content
    exit;
}


$sql = "INSERT INTO `Appointment` (`Date`, `Time`, `PatientID`, `DoctorID`, `ClinicID`) VALUES ('$appointment_date', '$time_slot', '$patient_id', '$doctor_id', '$clinic_id')";

// execute the query and send a response code 
if ($conn->query($sql)) {
    http_response_code(201); // data has been created
} else {
    http_response_code(502); // failed to add data to database 
}

$conn->close();
?>