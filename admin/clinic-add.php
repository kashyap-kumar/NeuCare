<?php require_once "includes/session.php"; ?>

<?php

// connect to database
require_once "../config/connection.php";

// define and initialize variables with empty values
$email = $password = $name = $city = $address = $contact = "";
$email_err = $password_err = "";

// this block will be executed only when request method is post (after clicking submit button)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// initialize variables with form data
	$email = $_POST["email"];
	$password = $_POST["password"];
	$name = $_POST["name"];
	$city = $_POST["city"];
	$address = $_POST["address"];
	$contact = $_POST["contact"];

	// sql query to check email existence
	$sql = "SELECT `ID` FROM `Clinic` WHERE `Email`='$email'";

	// attempt to execute the query
	$result = $conn->query($sql);

	// check email if already taken
	if ($result->num_rows == 1) {
		$email_err = "Email already registered";
	}

	// check email if empty
	if (empty($email)) {
		$email_err = "Please eneter an email";
	}

	// check password if empty
	if (empty($password)) {
		$password_err = "Please enter a password";
	}

	// check input errors before creating new user
	if (empty($email_err) && empty($password_err)) {
		// to encrypt the password before inserting
		$password = password_hash($password, PASSWORD_DEFAULT); // creates a password hash

		// sql query to add new user
		$sql = "INSERT INTO `Clinic` (`Name`, `Email`, `Password`, `City`, `Address`, `Contact`) VALUES ('$name', '$email', '$password', '$city', '$address', '$contact')";

		// execute the query
		if ($conn->query($sql)) {
			echo '
				<script>
					window.onload = () => Toastify({
											text: "Clinic added",
											duration: 3000,
											backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
										}).showToast()
				</script>
			';
		} else {
			echo '
				<script>
					window.onload = () => Swal.fire({
											icon: "error",
											title: "Oops...",
											text: "Something went wrong!",
										})
				</script>
			';
		}

		// clear variables so that it doesn't show up in the form fields after submitting the form
		$email = $password = $name = $city = $address = $contact = "";
	}
}

// close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>New Clinic - NeuCare Admin Dashboard</title>

	<link rel="stylesheet" href="assets/css/main/app.css" />
	<link rel="stylesheet" href="assets/css/main/app-dark.css" />
	<link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css" />
	<link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />

	<link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png" />
</head>

<body>
	<script src="assets/js/initTheme.js"></script>
	<div id="app">
		<div id="sidebar" class="active">
			<div class="sidebar-wrapper active">
				<div class="sidebar-header position-relative">
					<div class="d-flex justify-content-between align-items-center">
						<div class="logo">
							<a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo" srcset="" /></a>
						</div>
						<div class="theme-toggle d-flex gap-2 align-items-center mt-2">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
								height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
								<g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
									stroke-linejoin="round">
									<path
										d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
										opacity=".3"></path>
									<g transform="translate(-210 -1)">
										<path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
										<circle cx="220.5" cy="11.5" r="4"></circle>
										<path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
										</path>
									</g>
								</g>
							</svg>
							<div class="form-check form-switch fs-6">
								<input class="form-check-input me-0" type="checkbox" id="toggle-dark"
									style="cursor: pointer" />
								<label class="form-check-label"></label>
							</div>
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
								preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
								<path fill="currentColor"
									d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
								</path>
							</svg>
						</div>
						<div class="sidebar-toggler x">
							<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
						</div>
					</div>
				</div>
				<div class="sidebar-menu">
					<ul class="menu">
						<li class="sidebar-title">Menu</li>

						<li class="sidebar-item">
							<a href="index.php" class="sidebar-link">
								<i class="bi bi-grid-fill"></i>
								<span>Dashboard</span>
							</a>
						</li>

						<li class="sidebar-item active has-sub">
							<a href="#" class="sidebar-link">
								<i class="bi bi-house-add-fill"></i>
								<span>Clinics</span>
							</a>
							<ul class="submenu active">
								<li class="submenu-item">
									<a href="clinic-list.php">Clinic List</a>
								</li>
								<li class="submenu-item active">
									<a href="clinic-add.php">Add Clinic</a>
								</li>
							</ul>
						</li>

						<li class="sidebar-item has-sub">
							<a href="#" class="sidebar-link">
								<i class="bi bi-person-square"></i>
								<span>Doctors</span>
							</a>
							<ul class="submenu">
								<li class="submenu-item">
									<a href="doctor-list.php">Doctor List</a>
								</li>
								<li class="submenu-item">
									<a href="doctor-add.php">Add Doctor</a>
								</li>
							</ul>
						</li>

						<li class="sidebar-item">
							<a href="patients.php" class="sidebar-link">
								<i class="bi bi-people-fill"></i>
								<span>Patients</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a href="appointments.php" class="sidebar-link">
								<i class="bi bi-calendar-check-fill"></i>
								<span>Appointments</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="main">
			<header class="mb-3">
				<a href="#" class="burger-btn d-block d-xl-none">
					<i class="bi bi-justify fs-3"></i>
				</a>
			</header>

			<div class="page-heading">
				<div class="page-title">
					<div class="row">
						<div class="col-12 col-md-6 order-md-1 order-last">
							<h3>Clinics</h3>
							<p class="text-subtitle text-muted">
								View and manage clinics here.
							</p>
						</div>
						<div class="col-12 col-md-6 order-md-2 order-first">
							<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Clinics
									</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<!-- // Basic multiple Column Form section start -->
				<section id="multiple-column-form">
					<div class="row match-height">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add New Clinic</h4>
								</div>
								<div class="card-content">
									<div class="card-body">

										<form class="form" data-parsley-validate
											action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
											<div class="row">
												<div class="col-md-6 col-12">
													<div class="form-group mandatory">
														<label for="name" class="form-label">Clinic Name</label>
														<input type="text" id="name" class="form-control"
															value="<?= $name; ?>" placeholder="Clinic Name" name="name"
															data-parsley-required="true" />
													</div>
												</div>
												<div class="col-md-6 col-12">
													<div class="form-group mandatory">
														<label for="contact" class="form-label">Contact</label>
														<input type="text" id="contact" class="form-control"
															value="<?= $contact; ?>" placeholder="Contact Number"
															name="contact" data-parsley-required="true" />
													</div>
												</div>
												<div class="col-md-6 col-12">
													<div class="form-group mandatory">
														<label for="city" class="form-label">City</label>
														<input type="text" id="city" class="form-control"
															value="<?= $city; ?>" placeholder="City" name="city"
															data-parsley-required="true" />
													</div>
												</div>
												<div class="col-md-6 col-12">
													<div class="form-group mandatory">
														<label for="address" class="form-label">Address</label>
														<input type="text" id="address" class="form-control"
															value="<?= $address; ?>" name="address"
															placeholder="Address" data-parsley-required="true" />
													</div>
												</div>
												<div class="col-md-6 col-12">
													<div class="form-group mandatory">
														<label for="email" class="form-label">Email</label>
														<input type="email" id="email" class="form-control" name="email"
															value="<?= $email; ?>" placeholder="Email"
															data-parsley-required="true" />
													</div>
												</div>
												<div class="col-md-6 col-12">
													<div class="form-group mandatory">
														<label for="password" class="form-label">Password</label>
														<input type="password" id="password" class="form-control"
															value="<?= $password; ?>" name="password"
															placeholder="Password" data-parsley-required="true" />
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-12 d-flex justify-content-end">
													<button type="submit" class="btn btn-primary me-1 mb-1"
														name="submit">
														Submit
													</button>
													<button type="reset" class="btn btn-light-secondary me-1 mb-1">
														Reset
													</button>
												</div>
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- // Basic multiple Column Form section end -->
			</div>

			<footer>
				<div class="footer clearfix mb-0 text-muted">
					<div class="float-start">
						<p>&copy;
							<script>document.write(new Date().getFullYear());</script> NeuCare
						</p>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/app.js"></script>

	<script src="assets/extensions/jquery/jquery.min.js"></script>
	<script src="assets/extensions/parsleyjs/parsley.min.js"></script>
	<script src="assets/js/pages/parsley.js"></script>

	<script src="assets/extensions/toastify-js/src/toastify.js"></script>
	<script src="assets/js/pages/toastify.js"></script>

	<script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
	<script src="assets/js/pages/sweetalert2.js"></script>
</body>

</html>