<?php require_once "includes/session.php"; ?>

<?php
require_once "../config/connection.php";

$sql = "SELECT COUNT(`ID`) FROM `Doctor`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_doctors = reset($row); // reset() gives the first value of an array if there is an element inside the array

$sql = "SELECT COUNT(`ID`) FROM `Clinic`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_clinics = reset($row);

$sql = "SELECT COUNT(`ID`) FROM `Patient`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_patients = reset($row);

$sql = "SELECT COUNT(`ID`) FROM `Appointment`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_appointments = reset($row);

$sql = "SELECT COUNT( CASE WHEN `Gender` = 'male' THEN 1 END ) AS `Male`, COUNT( CASE WHEN `Gender` = 'female' THEN 1 END ) AS `Female`, COUNT( CASE WHEN `Gender` = 'other' THEN 1 END ) AS `Other` FROM `Patient`";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_male = $row["Male"];
$total_female = $row["Female"];
$total_other = $row["Other"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Dashboard - NeuCare Admin Dashboard</title>

	<link rel="stylesheet" href="assets/css/main/app.css" />
	<link rel="stylesheet" href="assets/css/main/app-dark.css" />
	<link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png" />

	<link rel="stylesheet" href="assets/css/shared/iconly.css" />
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

						<li class="sidebar-item active">
							<a href="index.php" class="sidebar-link">
								<i class="bi bi-grid-fill"></i>
								<span>Dashboard</span>
							</a>
						</li>

						<li class="sidebar-item has-sub">
							<a href="#" class="sidebar-link">
								<i class="bi bi-house-add-fill"></i>
								<span>Clinics</span>
							</a>
							<ul class="submenu">
								<li class="submenu-item">
									<a href="clinic-list.php">Clinic List</a>
								</li>
								<li class="submenu-item">
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
				<h3>Profile Statistics</h3>
			</div>
			<div class="page-content">
				<section class="row">

					<div class="col-12 col-lg-9">
						<div class="row">
							<div class="col-6 col-lg-3 col-md-6">
								<div class="card">
									<div class="card-body px-4 py-4-5">
										<div class="row">
											<div
												class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
												<div class="stats-icon purple mb-2">
													<i class="iconly-boldCategory"></i>
												</div>
											</div>
											<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
												<h6 class="text-muted font-semibold">
													Total Clinics
												</h6>
												<h6 class="font-extrabold mb-0">
													<?= $total_clinics ?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-3 col-md-6">
								<div class="card">
									<div class="card-body px-4 py-4-5">
										<div class="row">
											<div
												class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
												<div class="stats-icon blue mb-2">
													<i class="iconly-boldProfile"></i>
												</div>
											</div>
											<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
												<h6 class="text-muted font-semibold">Total Doctors</h6>
												<h6 class="font-extrabold mb-0">
													<?= $total_doctors ?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-3 col-md-6">
								<div class="card">
									<div class="card-body px-4 py-4-5">
										<div class="row">
											<div
												class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
												<div class="stats-icon green mb-2">
													<i class="iconly-boldUser1"></i>
												</div>
											</div>
											<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
												<h6 class="text-muted font-semibold">Total Patients</h6>
												<h6 class="font-extrabold mb-0">
													<?= $total_patients ?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6 col-lg-3 col-md-6">
								<div class="card">
									<div class="card-body px-4 py-4-5">
										<div class="row">
											<div
												class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
												<div class="stats-icon red mb-2">
													<i class="iconly-boldDocument"></i>
												</div>
											</div>
											<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
												<h6 class="text-muted font-semibold">Total Appointments</h6>
												<h6 class="font-extrabold mb-0">
													<?= $total_appointments ?>
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>New Users</h4>
									</div>
									<div class="card-body">
										<div id="chart-profile-visit"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-3">
						<div class="card">
							<div class="card-body py-4 px-4">
								<div class="d-flex align-items-center">
									<div class="avatar avatar-xl">
										<img src="assets/images/faces/1.jpg" alt="Face 1" />
									</div>
									<div class="ms-3 name">
										<h5 class="font-bold">
											<?= $admin_name; ?>
										</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<h4>Patients Profile</h4>
							</div>
							<div class="card-body">
								<div id="chart-visitors-profile"></div>
							</div>
						</div>
					</div>

				</section>
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

	<!-- Need: Apexcharts -->
	<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
	<script src="assets/js/pages/dashboard.js"></script>
	<script>

		let optionsVisitorsProfile = {
			series: [<?= $total_male ?>, <?= $total_female ?>, <?= $total_other ?>],
			labels: ["Male", "Female", "Other"],
			colors: ["#435ebe", "#55c6e8", "#9694FF"],
			chart: {
				type: "donut",
				width: "100%",
				height: "350px",
			},
			legend: {
				position: "bottom",
			},
			plotOptions: {
				pie: {
					donut: {
						size: "30%",
					},
				},
			},
		}

		var chartVisitorsProfile = new ApexCharts(
			document.getElementById("chart-visitors-profile"),
			optionsVisitorsProfile
		)

		chartVisitorsProfile.render()

	</script>
</body>

</html>