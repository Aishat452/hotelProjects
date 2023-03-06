<?php
require "db_con.php";
require '../includes/sessions.php';

//Checking if the user did not click on our submit button
if (!isset($_POST['login'])) {
    $_SESSION['error_msg'] = "Kindly login to your account";
    header("Location: ../../login");
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (trim($email) === "" || trim($password) === "") {
        $_SESSION['error_msg'] = "Fields cannot be empty!";
        header("Location: ../../login");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_msg'] = "Invalid Email!";
        header("Location: ../../login");
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";

        // Initialize Connection to database
        $stmt = mysqli_stmt_init($connectDB);

        // Prepare Connection with Statement
        mysqli_stmt_prepare($stmt, $sql);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Execute the Statement
        $execute = mysqli_stmt_execute($stmt);

        //Retreives the data from the executed statement
        $result = mysqli_stmt_get_result($stmt);

        //Retreives the number of corresponding rows (integer)
        $numrows = mysqli_num_rows($result);

        // Check if there is no user or more than one user with the email
        if ($numrows != 1) {
            $_SESSION['error_msg'] = "This email does not exist.";
            header("Location: ../../login");
        } else {
            // Convert the result to associative array
            $row = mysqli_fetch_assoc($result);
            $returnPasswords = $row['passwords'];

            // Verify if the password entered matches the encrypted password on our database
            if (!password_verify($password, $returnPasswords)) {
                $_SESSION['error_msg'] = "Incorrect Password.";
                header("Location: ../../login");
            } else {
                // Create a new session to store the current user
                $_SESSION['user'] = $row['id'];
                $_SESSION['role'] = $row['user_role'];
                
                //   Redirect the user to the dashboard page
                if ($row['user_role'] ===  'admin') {
                    header("Location: ../../admin/dashboard");
                }else{
                    header("Location: ../../services/dashboard");
                }
            }
        }
    }
}
