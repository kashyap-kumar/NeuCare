<?php
session_start();

// check if the patient is already logged in or not, if not, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../patient/login.php");
	exit;
}

require_once "../config/connection.php";

$doctorid = $_GET['id']; // doctor id

# fetch doctor details
$sql = "SELECT `Name`, `Experience`, `Specialization` FROM `Doctor` WHERE `ID`=$doctorid";
$doctor = $conn->query($sql)->fetch_assoc();

# fetch number of patients
$sql = "SELECT COUNT(ID) PatientCount FROM `Appointment` WHERE DoctorID=$doctorid";
$patient_count = $conn->query($sql)->fetch_assoc()['PatientCount'];

# fetch clinic name and fees for appointments
$sql = "SELECT c.ID, c.Name, dc.Fees FROM `Doctor_Clinic`dc INNER JOIN Clinic c ON dc.ClinicID = c.ID WHERE dc.DoctorID = $doctorid";
$clinics = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

	<!-- Bootstrap CSS & Font awesome icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
		integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Calendar plugin -->
	<script src="https://jsuites.net/v4/jsuites.js"></script>
	<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />

	<!-- moment js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

	<!-- <link rel="stylesheet" href="style.css"> -->
	<title><?= $doctor['Name'] ?></title>
	<style>
		*,
		*::before,
		*::after {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		:root {
			--primary-color: #2c76e4;
			/* brand color */
			--secondary-color: #212c3e;
			/* bold text */
			--tertiary-color: #30425e;
			/* body text */
		}

		body {
			background-color: #d1e9ff;
		}

		img {
			object-fit: cover;
		}
	</style>
</head>

<body>
	<div class="container py-5">
		<div class="row g-2">
			<div class="col-md-6 col-lg-3">
				<div class="p-3 bg-white h-100 rounded-4">
					<h4 class="text-center">Doctor</h4>
					<div class="d-flex align-items-center gap-2">
						<img src="../assets/images/demo-doctor-4.jpeg" alt="profile pic" width="80px" height="80px"
							class="bg-light rounded-4">
						<div>
							<h5 class="mb-0"><?= $doctor['Name'] ?></h5>
							<p class="text-muted"><?= $doctor['Specialization'] ?></p>
						</div>
					</div>
					<div
						class="d-flex justify-content-around align-items-center bg-primary rounded-4 mt-3 p-3 bg-light">
						<div class="text-center">
							<p class="mb-0">Patients</p>
							<p class="mb-0"><?= $patient_count ?></p>
						</div>
						<div class="text-center">
							<p class="mb-0">Experience</p>
							<p class="mb-0"><?= $doctor['Experience'] ?>+</p>
						</div>
						<div class="text-center">
							<p class="mb-0">Rating</p>
							<p class="mb-0">4.7</p>
						</div>
					</div>
					<div class="mt-3">
						<h6>About</h6>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo libero et deserunt dignissimos
							reiciendis consectetur velit deleniti laboriosam quod nulla eum repellat cupiditate beatae
							at
							voluptate molestiae, explicabo assumenda quae!</p>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-lg-6 order-md-last order-lg-1">
				<div class="p-3 bg-white h-100 rounded-4">
					<h4 class="text-center">Appointment</h4>
					<div>
						<select name="clinics" id="clinics" class="form-select">
							<option value="0" selected disabled>Select clinic for this doctor</option>
							<?php while ($clinic = $clinics->fetch_assoc()): ?>
							<option value="<?= $clinic['ID'] ?>"><?= $clinic['Name'] ?> (Rs. <?= $clinic['Fees'] ?>)
							</option>
							<?php endwhile; ?>
						</select>
						<div id="calendar">
							<!-- this is done by JavaScript -->
						</div>
						<h6>Available Time Slots</h6>
						<div class="time-slots" id="timeSlots">
							<p class="alert alert-warning" role="alert">Select clinic and date to see time slots</p>
						</div>
						<div class="d-grid my-3">
							<button class="btn btn-primary" type="button" id="bookAppointment">Book Appointment</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3 order-lg-2">
				<div class="p-3 bg-white h-100 rounded-4">
					<h4 class="text-center">Reviews</h4>
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-start align-items-center">
								<img class="rounded-circle shadow-1-strong me-3"
									src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar"
									width="60" height="60" />
								<div>
									<h6 class="fw-bold text-primary mb-1">Arnab Gogoi</h6>
									<p class="text-muted small mb-0">
										Jan 12, 2022
									</p>
								</div>
							</div>

							<p class="mt-3 mb-4 pb-2">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
							</p>

							<div class="small d-flex justify-content-start">
								<a href="#!" class="d-flex align-items-center me-3">
									<i class="far fa-thumbs-up me-2"></i>
									<p class="mb-0">Like</p>
								</a>
								<a href="#!" class="d-flex align-items-center me-3">
									<i class="far fa-thumbs-down me-2"></i>
									<p class="mb-0">Dislike</p>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap bundle with popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- sweetalert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.all.min.js"></script>
	<script>
		let appointmentDate;
		let clinicid = document.getElementById("clinics").value;
		let tslot = null;

		bookAppointment.disabled = true;

		// Create a new calendar
		jSuites.calendar(document.getElementById('calendar'), {
			format: 'YYYY-MM-DD',
			onupdate: function (a, b) {
				// document.getElementById('calendar-value').innerText = b;
				appointmentDate = b.split(" ")[0]; // b = YYYY-MM-DD 00:00:00
				fetchAvailability();
			}
		});


		clinics.addEventListener("change", fetchAvailability);

		function fetchAvailability() {
			if(tslot != null){
				bookAppointment.disabled = false;
				tslot = tslot.value;
			}

			clinicid = document.getElementById("clinics").value;
			if (clinicid == 0) {
				timeSlots.innerHTML = "";
				return;
			}
			timeSlots.innerHTML = "";
			if(clinicid != 0){
				fetch("get-availability.php?clinicid=" + clinicid + "&doctorid=<?= $doctorid ?>" + "&appointmentdate=" + appointmentDate)
					.then(r => r.json())
					.then(slots => {
						if (slots.length == 0) timeSlots.innerHTML = `<p class="alert alert-warning" role="alert">No slots available on ${new Date(appointmentDate).toLocaleString('en-us', { month: 'short', day: 'numeric' })}</p>`;
						slots.forEach((slot, index) => {
	
							// Parse the times as moment objects
							const startTime = moment(slot[0], "HH:mm:ss");
							const endTime = moment(slot[1], "HH:mm:ss");
	
							// Subtract timeA from timeB and get the difference in hours
							const differenceInHours = endTime.diff(startTime, 'hours');
	
							startTime.subtract(1, 'hours');
							for (let i = 0; i < differenceInHours; i++) {
								let time = startTime.add(1, 'hours').format("HH:mm:ss"); // startTime += 1
								timeSlots.innerHTML +=
									`<span>
										<input type="radio" class="btn-check" name="time-slot" id="timeslot${index}${i}" value="${time}"
											autocomplete="off" onclick="enableSubmitBtn(this)">
										<label class="btn btn-outline-primary" for="timeslot${index}${i}">${time}</label>
									</span>`;
							}
						});
					});
			}
		}

		function enableSubmitBtn(elm){
			tslot = elm.value;
			bookAppointment.disabled = false;
		}
	</script>
	<script>
		// script for booking appoinment

		bookAppointment.onclick = () => {
			fetch("book-appointment.php?clinicid=" + clinicid + "&doctorid=" + <?= $doctorid ?> + "&appointmentdate=" + appointmentDate + "&timeslot=" + tslot)
			.then(res => {
				if(res.status == 204){
					// no more patient can be added to the slot
					Swal.fire(
						'Oh No! Either you missed the slot or you are trying the same slot',
						'No problem! Check other slots if available',
						'warning'
					)
				} else if(res.status == 201){
					// appointment has been created
					Swal.fire(
						'Booked!',
						'The appointment has been booked',
						'success'
					)
				} else {
					// something went wrong
					Swal.fire(
						'Oh No!',
						'Something went wrong in our side',
						'warning'
					)
				}
			})
		}
	</script>
</body>

</html>