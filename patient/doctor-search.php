<?php
// initialize a session
session_start();

// check if the user is already logged in or not, if not, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Kashyap Kumar, kashyapkumar@linkedin" />
    <meta name="description" content="Search for doctors online and book appointment for any health concern" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS & Font awesome icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/css/home.css" />
    <title>Home | NeuCare</title>
</head>

<body>
    <!-- top bar -->
    <div class="navbar">
        <div class="col-12 col-md-8 px-2 mx-md-auto d-flex align-items-center justify-content-between">
            <a href="home.php" class="navbar-brand fs-2">NeuCare</a>
            <img src="../assets/images/demo-doctor-1.jpg" alt="profile picture" class="rounded-circle">
        </div>
    </div>

    <!-- search bar -->
    <div class="search-bar container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET"
                    class="py-3 py-md-5 input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Speciality" aria-label="Speciality"
                        name="speciality" value="<?php echo $speciality; ?>" required>
                    <input type="text" class="form-control" placeholder="Location" aria-label="Location" name="location"
                        value="<?php echo $location; ?>" required>
                    <button class="btn btn-primary" type="submit" name="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>

            </div>
        </div>
    </div>

    <!-- search results -->
    <div class="row d-flex justify-content-center align-items-start px-3 px-lg-0">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <h3 class="col-12 col-sm-10 col-md-8 col-lg-9 col-xl-8 mb-1 section-heading">Search Results</h3>
            <p class="mb-4 text-muted">for <em><?= $_GET['speciality'] ?></em> in <em><?= $_GET['location'] ?></em></p>
            <?php
                require "../config/connection.php";
    
                if (isset($_GET['submit'])) {
                    // get the search criteria
                    $speciality = $_GET['speciality'];
                    $location = $_GET['location'];
                    
                    $sql = "SELECT d.ID, d.Name, d.Experience, d.Specialization, d.Photo, GROUP_CONCAT(c.City SEPARATOR ', ') AS Cities FROM Doctor d JOIN Doctor_Clinic dc ON d.ID = dc.DoctorID JOIN Clinic c ON dc.ClinicID = c.ID WHERE d.Specialization LIKE '%$speciality%' AND c.City LIKE '%$location%' GROUP BY d.ID, d.Name, d.Experience, d.Specialization ORDER BY d.Experience DESC";
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        while($doctor = $result->fetch_assoc()):
            ?>
                <div class="doctor-card mb-3">
                    <div class="card-image">
                        <img src="../assets/uploads/doctors/<?= $doctor['Photo'] ?>" alt="doctor profile picture">
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0 doctor-name"><?= $doctor['Name'] ?></h4>
                        <p class="mb-0"><?= $doctor['Specialization'] ?></p>
                        <div class="experience">
                            <i class="fa-regular fa-clock"></i>
                            <span><?= $doctor['Experience'] ?>+ yrs of experience</span>
                        </div>
                        <div class="experience">
                            <i class="fa-solid fa-location-dot"></i>
                            <span><?= $doctor['Cities'] ?></span>
                        </div>
                        <div class="experience">
                            <i class="fa-regular fa-star"></i>
                            <span>4.5 (314)</s>
                        </div>
                        <a href="../doctor/profile.php?id=<?= $doctor['ID'] ?>" class="btn">View Profile</a>
                    </div>
                </div>
            <?php       endwhile; 
                    }
                    else {
                        echo "<p>No Results Found!</p>";
                    }
                }
                $conn->close();
            ?>
        </div>
    </div>

    <!-- footer -->
    <footer class="text-center py-3" style="color: #30425e; font-size: 14px;">
        Copyright &copy; <script>document.write(new Date().getFullYear());</script> NeuCare. All rights reserved.
    </footer>

    <!-- Bootstrap bundle with popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>
