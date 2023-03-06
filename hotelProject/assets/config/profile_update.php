<?php
    require "db_con.php";
    require '../includes/sessions.php';
    $id = $_SESSION['user'];


    //Checking if the user did not click on our submit button
    if (!isset($_POST['update'])) {
        $_SESSION['error_msg'] = "";
        header("Location: ../../login");
    }else{
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $sql = "UPDATE users SET full_name = ?, phone = ?, gender = ?  WHERE id = ?";

        // Initialize Connection to database
        $stmt = mysqli_stmt_init($connectDB);

        // Prepare Connection with Statement
        mysqli_stmt_prepare($stmt, $sql);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "ssss", $fname,$phone,$gender,$id);

        // Execute the Statement
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $_SESSION['success_msg'] = "Update Successful";
            header("Location: ../../services/profile");
        }else{
            $_SESSION['error_msg'] = "Failed to Update";
            header("Location: ../../services/profile");
        }
    }