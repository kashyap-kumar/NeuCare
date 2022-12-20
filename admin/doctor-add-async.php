<?php require_once "includes/session.php"; ?>

<?php

// connect to database
require_once "../config/connection.php";

$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// get data from post request and session
	$fees 	    = $_POST["fees"];
	$doctor_id 	= $_POST["id"];

	// sql query to check if same row exist in database
	$sql = "SELECT `ID` FROM `Doctor_Clinic` WHERE `DoctorID`='$doctor_id' AND `ClinicID`='$clinic_id'";

	// attempt to execute the query
	$result = $conn->query($sql);

	// check if doctor is added already
	if ($result->num_rows == 1) {
		$error = true; //"Doctor already added"
	}

	// check errors before creating new row
	if (!$error) {
		// sql query to add new row
		$sql = "INSERT INTO `Doctor_Clinic` (`DoctorID`, `ClinicID`, `Fees`) VALUES ($doctor_id, $clinic_id, $fees)";

		// execute the query and send a response code 
		if ($conn->query($sql)) {
			http_response_code(204); // all gone well, returning nothing
		} else {
			http_response_code(502); // failed to add data to database (internal server error)
		}
	} else {
		http_response_code(200); // doctor already added to clinic
	}
}

// close database connection
$conn->close();
?>