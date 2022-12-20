<?php require_once "includes/session.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>New Doctor - NeuCare Admin Dashboard</title>

	<link rel="stylesheet" href="assets/css/main/app.css" />
	<link rel="stylesheet" href="assets/css/main/app-dark.css" />
	<link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png" />

	<link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
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

						<li class="sidebar-item active has-sub">
							<a href="#" class="sidebar-link">
								<i class="bi bi-person-square"></i>
								<span>Doctors</span>
							</a>
							<ul class="submenu active">
								<li class="submenu-item">
									<a href="doctor-list.php">Doctor List</a>
								</li>
								<li class="submenu-item active">
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
							<h3>Doctors</h3>
							<p class="text-subtitle text-muted">
								View and manage doctors here.
							</p>
						</div>
						<div class="col-12 col-md-6 order-md-2 order-first">
							<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Doctors
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
									<h4 class="card-title">Add New Doctor</h4>
								</div>
								<div class="card-content">
									<div class="card-body">

										<form id="formElem1" class="form" data-parsley-validate>
											<div class="row">
												<div class="col-md-8 col-12">
													<input type="email" id="email" class="form-control"
															name="email" placeholder="Enter doctor's email id"
															data-parsley-required="true" />
												</div>
												<div class="col-md-4 col-12 d-grid mt-3 mt-md-0 mb-md-auto">
													<button type="submit" class="btn btn-primary">
														Search
													</button>
												</div>
											</div>
										</form>

										<form id="formElem2">

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

	<script>
		// ref: https://javascript.info/formdata
		formElem1.onsubmit = (e) => {
			e.preventDefault();

			// email field should not be empty
			if(this.email.value == "") return;

			fetch("doctor-search.php", {
				method: "POST",
				body: new FormData(formElem1)
			})
			.then(response => {
				// no doctor found
				if(response.status == 204){
					Swal.fire(
						'Doctor Not Found',
						'Check the email address and try again',
						'warning'
					)

					// clear the input field
					formElem1.email.value = "";

					return;
				}

				// doctor found
				return response.json().then(data => {
					Swal.fire({
						title: `${data["Name"]}`,
						icon: 'success',
						input: 'select',
						inputOptions: {100: 100, 200: 200, 300: 300, 400: 400, 500: 500, 600: 600, 700: 700, 1000: 1000},
						inputPlaceholder: 'Select fees',
						inputAttributes: { style: "margin: 0 20px; border: 1px solid #353535;" },
						confirmButtonColor: '#3950A2',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Add To Clinic',
						inputValidator: (value) => {
							return new Promise((resolve) => {
							if (value >= 100) {
								resolve()
							} else {
								resolve('Select a fees')
							}
							})
						}
					}).then((result) => { // add doctor to database
						
						const formData = new FormData();
						formData.append("id", `${data["ID"]}`);
						formData.append("fees", result.value);
	
						if (result.isConfirmed) {
							fetch("doctor-add-async.php", {
								method: "POST",
								body: formData
							})
							.then(response => {
								if(response.status == 204){
									Swal.fire(
										'Added!',
										'The doctor has been added to your clinic.',
										'success'
									)
								} else if (response.status == 200){
									Swal.fire(
										'Doctor Already Added',
										'No problem! we often forget things.',
										'warning'
									)
								} else{
									Swal.fire(
										'Oh No!',
										'Something went wrong in our side',
										'warning'
									)
								}
							})
						}
					})
					// clear the input field
					formElem1.email.value = "";
				})
			})
		}
	</script>

	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/app.js"></script>

	<script src="assets/extensions/jquery/jquery.min.js"></script>
	<script src="assets/extensions/parsleyjs/parsley.min.js"></script>
	<script src="assets/js/pages/parsley.js"></script>

	<script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>