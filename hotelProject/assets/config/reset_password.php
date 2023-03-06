<?php
    require "db_con.php";
    require "../includes/sessions.php";


    //Checking if the user did not click on our submit button
   if (!isset($_POST['changepassword'])) {
       header("Location: logout");
   }else{

        $userid = $_SESSION['user'];
        $old = $_POST['old'];
        $new = $_POST['new'];
        $confirm = $_POST['confirm'];

        $sql = "SELECT passwords FROM users WHERE id = '$userid' ";
        $query = mysqli_query($connectDB,$sql);

        $row = mysqli_fetch_assoc($query);

        // Check the old password
        if (!password_verify($old,$row['passwords'])) {
            $_SESSION['error_msg'] = "Old password is not correct!";
            header("Location: ../../services/settings");
        }
        elseif ($new != $confirm){
            $_SESSION['error_msg'] = "Password does not match!";
            header("Location: ../../services/settings");
        }
        elseif (strlen($new) < 8){
            $_SESSION['error_msg'] = "Passwordis too short min: 8 characters!";
            header("Location: ../../services/settings");
        }else{
            $new  = password_hash($new, PASSWORD_DEFAULT);
            
            $sql = "UPDATE users SET passwords = ?  WHERE id = ? ";
            $stmt = mysqli_stmt_init($connectDB);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt, 'si',$new,$userid);

            $execute = mysqli_stmt_execute($stmt);

            if ($execute) {
                $_SESSION['success_msg'] = "Password has been changed!";
                header("Location: ../../services/settings");
            } else {
                $_SESSION['error_msg'] = "Oops Something Went Wrong!";
                header("Location: ../../services/settings");
            }
            
        }
   }