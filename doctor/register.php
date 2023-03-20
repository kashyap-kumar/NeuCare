<?php 

// connect to database
require_once "../config/connection.php";

// define and initialize variables with empty values
$email = $password = $name = $specialization = $experience = $contact = $gender = "";
$email_err = $password_err = $name_err = $photo_err = "";

// this block will be executed only when request method is post (after clicking submit button)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// initialize variables with form data
	$email 		    = $_POST["email"];
	$password 		= $_POST["password"];
	$name 		    = $_POST["name"];
	$contact 	    = $_POST["contact"];
	$specialization = $_POST["specialization"];
	$experience 	= $_POST["experience"];
    $gender         = $_POST['gender'];

	// sql query to check email existence
	$sql = "SELECT `ID` FROM `Doctor` WHERE `Email`='$email'";

	// attempt to execute the query
	$result = $conn->query($sql);

	// check email if already taken
	if ($result->num_rows == 1) {
		$email_err = "Email already registered";
	}

	// check email if empty
	if (empty($email)) {
		$email_err = "Please enter an email";
	}

	// check password if empty
	if (empty($password)) {
		$password_err = "Please enter a password";
	}
    
    // check name if empty
	if (empty($name)) {
		$name_err = "Please enter your name";
	}

    // HANDLE FILE UPLOAD
    $target_dir = "../assets/uploads/doctors/";
    $file_ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)); // Get file extension
    $new_file_name = explode(" ", $name)[0] . '_' . uniqid() . '.' . $file_ext; // Generate new file name: firstname_uniqueString
    $target_file = $target_dir . $new_file_name; // Set target file path with new file name
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check == false) {
        $photo_err = "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $photo_err = "Sorry, file already exists.";
    }

    // Check file size, max 5mb
    if ($_FILES["photo"]["size"] > 5000000) {
        $photo_err = "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $photo_err = "Sorry, only JPG, JPEG, PNG files are allowed.";
    }

	// check input errors before creating new user
	if (empty($email_err) && empty($password_err) && empty($name_err) && empty($photo_err)) {
		// to encrypt the password before inserting
		$password = password_hash($password, PASSWORD_DEFAULT); // creates a password hash

        // modify doctor name
	    $name = "Dr. " . $_POST["name"];

        // try to upload photo
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // sql query to add new user
            $sql = "INSERT INTO `Doctor` (`Name`, `Email`, `Password`, `Specialization`, `Experience`, `Contact`, `Gender`, `Photo`) VALUES ('$name', '$email', '$password', '$specialization', $experience, '$contact', '$gender', '$new_file_name')";
    
            // execute the query
            if ($conn->query($sql)) {
                // start a new session
                session_start();
        
                // store data in session variables
                $_SESSION["is_doctor_loggedin"] = true;
                $_SESSION["name"]               = $name;
    
                // redirect to doctor's home page
                header("Location: index.php");
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
        } 
        else {
            $photo_err = "Sorry, there was an error uploading your file.";
        }

		// clear variables so that it doesn't show up in the form fields after submitting the form
        $email = $password = $name = $specialization = $experience = $contact = $gender = "";
	}
}

// close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sign up - Doctor</title>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background: #2c76e4;
        }
    </style>
</head>

<body>
    <div class="container min-vh-100 d-flex flex-column justify-content-around align-items-center">

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-3">
                            <h4 class="card-title text-center text-uppercase">NeuCare Doctor Sign Up</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body px-md-5">
    
                                <form id="newDoctorForm" class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                                    <p class="text-danger">
                                        <?php echo $email_err; ?>
                                        <?php echo $password_err; ?>
                                        <?php echo $name_err; ?>
                                        <?php echo $photo_err; ?>
                                    </p>

                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="name" class="form-label">Doctor
                                                    Name</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter your name without Dr."
                                                    name="name" value="<?php echo $name; ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="contact" class="form-label">Contact</label>
                                                <input type="text" id="contact" class="form-control"
                                                    placeholder="Contact Number" name="contact" value="<?php echo $contact; ?>"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="Specialization" class="form-label">Specialization</label>
                                                <input type="text" id="Specialization" class="form-control"
                                                    placeholder="Specialization" name="specialization"
                                                    value="<?php echo $specialization; ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="experience" class="form-label">Experience</label>
                                                <input type="text" id="experience" class="form-control"
                                                    placeholder="Experience" name="experience" value="<?php echo $experience; ?>"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email" value="<?php echo $email; ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" id="password" class="form-control" name="password"
                                                    placeholder="Password" value="<?php echo $password; ?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <fieldset>
                                                    <label class="form-label">
                                                        Gender
                                                    </label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender1" value="male" <?php echo ($gender == "male" ? "checked" : ""); ?> required />
                                                        <label class="form-check-label form-label" for="gender1">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender2" value="female" <?php echo ($gender == "female" ? "checked" : ""); ?> />
                                                        <label class="form-check-label form-label" for="gender2">
                                                            Female
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender3" value="other" <?php echo ($gender == "other" ? "checked" : ""); ?> />
                                                        <label class="form-check-label form-label" for="gender3">
                                                            Other
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-2">
                                                <label for="name" class="form-label">Photo</label>
                                                <input type="file" id="photo" class="form-control" 
                                                        name="photo" accept=".png,.jpeg,.jpg,image/png,image/jpeg" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
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

        <footer class="text-center py-3" style="color: #FFFFFF; font-size: 14px;">
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> NeuCare. All rights reserved.
        </footer>
    </div>

    <!-- Bootstrap bundle with popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>