<?php
    // connect to database
    require_once "../config/connection.php";

    // define and initialize variables with empty values
    $email = $password = $name = $gender = $dob = $contact = "";
    $email_err = $password_err = "";

    // this block will be executed only when request method is post (after clicking submit button)
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // initialize variables with form data
        $email    = $_POST["email"];
        $password = $_POST["password"];
        $name     = $_POST["name"];
        $gender   = $_POST["gender"];
        $dob      = $_POST["dob"];
        $contact  = $_POST["contact"];

        // convert date of birth to mysql format
        $dob = str_replace('/', '-', $dob);
        $dob = date("Y-m-d", strtotime($dob));

        // sql query to check email existence
        $sql = "SELECT `ID` FROM `Patient` WHERE `Email`='$email'";

        // attempt to execute the query
        $result = $conn->query($sql);
        
        // check email if already taken
        if($result->num_rows == 1){
            $email_err = "Email already registered";
        }

        // check email if empty
        if(empty($email)){
            $email_err = "Please eneter an email";
        }

        // check password if empty
        if(empty($password)){
            $password_err = "Please enter a password";
        }

        // check input errors before creating new user
        if (empty($email_err) && empty($password_err)) {
            // to encrypt the password before inserting
            $password = password_hash($password, PASSWORD_DEFAULT); // creates a password hash

            // sql query to add new user
            $sql = "INSERT INTO `Patient` (`Name`, `Email`, `Password`, `Gender`, `DOB`, `Contact`) VALUES ('$name', '$email', '$password', '$gender', '$dob', '$contact')";

            // execute the query
            if ($conn->query($sql)) {
                // redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong";
            }
        }
    }
    
    // close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Kashyap Kumar, kashyapkumar@linkedin" />
        <meta name="description" content="Search for doctors online and book appointment for any health concern" />
    
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Sign up</title>

        <style>
            body{ background-color: #2c76e4; }
        </style>
    </head>

    <body>
        <div class="container py-3">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="card col-10 col-md-8 col-lg-6">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Create NeuCare Account</h2>
        
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" value="<?php echo $name; ?>" required>
                                <label for="name">Name</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Enter your email address" name="email" value="<?php echo $email; ?>" required>
                                <label for="email">Email</label>
                                <p class="text-danger"><?php echo $email_err; ?></p>
                            </div>
                            
                            <select class="form-select mb-3 py-3" aria-label=".form-select-lg" name="gender" required>
                                <option value="" selected disabled>Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="dob" placeholder="Enter your date of birth" name="dob" value="<?php echo $dob; ?>" required>
                                <label for="dob">DOB</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="contact" placeholder="Enter your phone number" name="contact" value="<?php echo $contact; ?>" required>
                                <label for="contact">Contact</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Enter a strong password" name="password" value="<?php echo $password; ?>" required>
                                <label for="password">Password</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                            </div>
        
                        </form>

                        <p class="text-center text-muted mb-0 mt-3">
                            Already have an account? 
                            <a href="login.php">login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center py-3" style="color: #e2eeff;">
            Copyright &copy; NeuCare. All rights reserved.
        </footer>
        
	    <!-- Bootstrap bundle with popper -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>