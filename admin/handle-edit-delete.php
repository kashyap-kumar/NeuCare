<?php 
require_once "../config/connection.php";

// edit clinic
if(isset($_GET['edit-clinic'])){
    header('Content-type: application/json; charset=utf-8');
    $id = $_GET['edit-clinic']; // get the id of the clinic to be edited

    $sql = "SELECT `Name`, `Contact`, `Address`, `City` FROM `Clinic` WHERE `ID`=$id";

    echo json_encode($conn->query($sql)->fetch_assoc());
    exit;
}

// update clinic
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["clinicid"];
    $name = $_POST["name"];
    $city = $_POST["city"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];

    $sql = "UPDATE `Clinic` SET `Name` = '$name', `City` = '$city', `Contact` = '$contact', `Address` = '$address' WHERE `Clinic`.`ID` = $id ";

    // execute the query and send a response code 
    if ($conn->query($sql)) {
        http_response_code(204); // all gone well, returning nothing
    } else {
        http_response_code(502); // failed to update data in database
    }
    exit;
}

// delete clinic
if(isset($_GET['delete-clinic'])){
    $id = $_GET['delete-clinic']; // get the id of the clinic to be deleted

    $sql = "DELETE FROM `Clinic` WHERE `Clinic`.`ID` = $id";

    if ($conn->query($sql)) {
        http_response_code(204); // all gone well, returning nothing
    } else {
        http_response_code(502); // failed to delete data from database
    }
    exit;
}


// delete doctor
if(isset($_GET['delete-doctor'])){
    $id = $_GET['delete-doctor']; // get the id of the doctor to be deleted

    $sql = "DELETE FROM `Doctor` WHERE `Doctor`.`ID` = $id"; // for admin of this app
    // $sql = "DELETE FROM `Doctor_Clinic` WHERE `DoctorID` = $id AND `ClinicID`=$clinic_id"; // for admin of clinic

    if ($conn->query($sql)) {
        http_response_code(204); // all gone well, returning nothing
    } else {
        http_response_code(502); // failed to delete data from database
    }
    exit;
}


// delete patient
if(isset($_GET['delete-patient'])){
    $id = $_GET['delete-patient']; // get the id of the patient to be deleted

    $sql = "DELETE FROM `Patient` WHERE `Patient`.`ID` = $id"; // for admin of this app

    if ($conn->query($sql)) {
        http_response_code(204); // all gone well, returning nothing
    } else {
        http_response_code(502); // failed to delete data from database
    }
    exit;
}

?>