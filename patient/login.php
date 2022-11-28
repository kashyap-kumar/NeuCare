<?php

    // initialize a session
    session_start();

    // check if the user is already logged in or not, if yes, redirect to home page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("location: home.php");
        exit;
    }



    // connect to database
    require_once "../config/connection.php";

    // define and initialize variables with empty values
    $username = $password = ""; // email will be the username
    $username_err = $password_err = $login_err = "";

    // this block will be executed only when request method is post (after clicking submit button)
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // check username if empty
        if(empty($username)){
            $username_err = "Please enter a username";
        }

        // check password if empty
        if(empty($password)){
            $password_err = "Please enter a password.";
        }

        // check input errors before creating new user
        if(empty($username_err) && empty($password_err)){

            // sql query to check username exist or not, if yes, pull id, username and password hash
            $sql = "SELECT `ID`, `Name`, `Password` FROM `Patient` WHERE `Email` = '$username'";

            // execute query
            $result = $conn->query($sql);
            
            // check if username exist
            if($result->num_rows == 1){
                // get id and password hash for the particular username
                $row              = $result->fetch_assoc();
                $id               = $row["ID"];
                $name             = $row["Name"];
                $db_password_hash = $row["Password"];

                // verify password
                if(password_verify($password, $db_password_hash)){
                    // login successful, so start a new session
                    session_start();
    
                    // store data in session variables
                    $_SESSION["loggedin"]     = true;
                    $_SESSION["id"]           = $id;
                    $_SESSION["name"] = $name;
    
                    // redirect to home page
                    header("location: home.php");
                }
                else{
                    $login_err = "Invalid password";
                }
            }
            else{
                $login_err = "No account with this username";
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
    
        <title>Sign in</title>
    
        <style>
            body {
                background-color: #2c76e4;
            }
        </style>
    </head>
    <body>

        <div class="container py-3">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="card col-10 col-md-8 col-lg-6">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">NeuCare Login</h2>
        
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                            <p class="text-danger"><?php echo $login_err; ?></p>
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="username" placeholder="Enter your email address" name="username" value="<?php echo $username; ?>" required>
                                <label for="username">Email or Username</label>
                                <p class="text-danger"><?php echo $username_err; ?></p>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" value="<?php echo $password; ?>" required>
                                <label for="password">Password</label>
                                <p class="text-danger"><?php echo $password_err; ?></p>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                            </div>
        
                        </form>
                        
                        <p class="text-center text-muted mb-0 mt-3">
                            Don't have an account? 
                            <a href="register.php">register here</a>
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