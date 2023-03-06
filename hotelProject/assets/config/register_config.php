<?php
    require "db_con.php";
    require "../includes/sessions.php";

    date_default_timezone_set("Africa/Lagos");
    /*
        The isset function checks if a variable exist and it is not equal to null
    */ 

    //Checking if the user did not click on our submit button
   if (!isset($_POST['register'])) {
       $_SESSION['error_msg'] = "Please create an account to continue!";
       header("Location: ../../register");
   }else{
      $fullName = $_POST['full_name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $gender = $_POST['gender'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];
      $date = date("Y-m-d");


      if (trim($fullName) === "" || trim($email) === "" || trim($phone) === "" || trim($gender) === "" || trim($password) === "" || trim($confirmPassword) === "") {
        $_SESSION['error_msg'] = "Fields cannot be empty!";
        header("Location: ../../register");
      }
      elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error_msg'] = "Invalid Email!";
        header("Location: ../../register");
      }
      elseif(strlen($password) < 8){
        $_SESSION['error_msg'] = "Password must be at least 8 characters!";
        header("Location: ../../register");
      }
      elseif($password !== $confirmPassword){
        $_SESSION['error_msg'] = "Passwords do not match!";
        header("Location: ../../register");
      }
      else{
        // Encrypt the Password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Save the Data

        // Create a SQL command Statement: INSERT STATEMENT
        $sql = "INSERT INTO users(full_name,email,phone,gender,passwords,date_created) VALUES(?,?,?,?,?,?)";

        // Initialize Connection to database
        $stmt = mysqli_stmt_init($connectDB);

        // Prepare Connection with Statement
        mysqli_stmt_prepare($stmt,$sql);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt,"ssissi", $fullName,$email,$phone,$gender,$hash,$date);

        // Execute the Statement
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $_SESSION['success_msg'] = "Account created successfully!";
            header("Location: ../../register");
        }else{
          $_SESSION['error_msg'] = "Oops, something went wrong!";
          header("Location: ../../register");
        }
        // var_dump($stmt);


      }

   }

   