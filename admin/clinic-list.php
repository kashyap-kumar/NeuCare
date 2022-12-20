<?php require_once "includes/session.php"; ?>

<?php

require_once "../config/connection.php";

$sql = "SELECT `ID`, `Name`, `Email`, `Contact`, `City` FROM `Clinic`";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Clinic List - NeuCare Admin Dashboard</title>

	<link rel="stylesheet" href="assets/css/main/app.css" />
	<link rel="stylesheet" href="assets/css/main/app-dark.css" />
	<link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css" />
	<link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />

	<link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png" />

	<link rel="stylesheet" href="assets/extensions/simple-datatables/style.css" />
	<link rel="stylesheet" href="assets/css/pages/simple-datatables.css" />
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
								<li class="submenu-item active">
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
				<section class="section">
					<div class="card">
						<div class="card-header">Clinic List</div>
						<div class="card-body">
							<table class="table table-striped" id="table1">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>City</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php while ($clinic = $result->fetch_assoc()): ?>
									<tr>
										<td>
											<?= strval($clinic["Name"]) ?>
										</td>
										<td>
											<?= strval($clinic["Email"]) ?>
										</td>
										<td>
											<?= strval($clinic["Contact"]) ?>
										</td>
										<td>
											<?= strval($clinic["City"]) ?>
										</td>
										<td style="cursor: pointer;">
											<span class="badge bg-primary" data-bs-toggle="modal"
												data-bs-target="#editClinicModal"
												onclick="getDataToEdit(<?= intval($clinic['ID']) ?>, this)">Edit</span>
											<span class="badge bg-danger"
												onclick="deleteClinic(<?= intval($clinic['ID']) ?>, this)">Remove</span>
										</td>
									</tr>
									<?php endwhile; ?>

								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>

			<!--Edit Clinic Form Modal -->
			<div class="modal fade text-left" id="editClinicModal" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel33" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel33">
								Edit Clinic
							</h4>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<i data-feather="x"></i>
							</button>
						</div>

						<form class="form" data-parsley-validate id="editClinicForm">
							<div class="modal-body">
								<div class="row">
									<input type="hidden" name="clinicid" id="clinicid">
									<div class="col-md-6 col-12">
										<div class="form-group mandatory">
											<label for="clinicName" class="form-label">Clinic Name</label>
											<input type="text" id="clinicName" class="form-control" value=""
												placeholder="Clinic Name" name="name" data-parsley-required="true" />
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group mandatory">
											<label for="contact" class="form-label">Contact</label>
											<input type="text" id="contact" class="form-control" value=""
												placeholder="Contact Number" name="contact"
												data-parsley-required="true" />
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group mandatory">
											<label for="city" class="form-label">City</label>
											<input type="text" id="city" class="form-control" value=""
												placeholder="City" name="city" data-parsley-required="true" />
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group mandatory">
											<label for="address" class="form-label">Address</label>
											<input type="text" id="address" class="form-control" value="" name="address"
												placeholder="Address" data-parsley-required="true" />
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-12 d-flex justify-content-end">
										<button type="submit" class="btn btn-primary me-1 mb-1" name="submit"
											data-bs-dismiss="modal">
											Update
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
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

	<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
	<script src="assets/js/pages/simple-datatables.js"></script>

	<script src="assets/extensions/toastify-js/src/toastify.js"></script>
	<script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>

	<!-- edit clinic - get data from db -->
	<script>
		function getDataToEdit(id, el) {
			fetch("handle-edit-delete.php?edit-clinic=" + id)
				.then(res => res.json())
				.then(data => {
					clinicid.value = id;
					clinicName.value = data['Name'];
					contact.value = data['Contact'];
					city.value = data['City'];
					address.value = data['Address'];
				})
		}

		editClinicForm.onsubmit = e => {
			e.preventDefault();

			fetch("handle-edit-delete.php", {
				method: "POST",
				body: new FormData(editClinicForm)
			})
				.then(res => {
					if (res.status == 204) {
						Toastify({
							text: "Clinic Updated",
							duration: 3000,
							gravity: "bottom",
							position: "left",
							backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
						}).showToast();

						// to take effect the changes
						location.reload(); // TODO: do this without the need of refreshing
					} else {
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "Something went wrong!",
						})
					}
				})
		}

		function deleteClinic(id, el) {
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					fetch("handle-edit-delete.php?delete-clinic=" + id)
						.then(res => {
							if (res.status == 204) {
								Toastify({
									text: "Clinic Removed",
									duration: 3000,
									gravity: "bottom",
									position: "left",
									backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
								}).showToast();

								el.parentElement.parentElement.remove();
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: "Something went wrong!",
								})
							}
						})
				}
			})
		}
	</script>
</body>

</html>