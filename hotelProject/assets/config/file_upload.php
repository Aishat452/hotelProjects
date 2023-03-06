<?php
     require "db_con.php";
     require '../includes/sessions.php';
     $id = $_SESSION['user'];
 
 
     //Checking if the user did not click on our submit button
     if (!isset($_POST['upload'])) {
         $_SESSION['error_msg'] = "";
         header("Location: logout");
     }else{

        // Collect the file from the FILES supper global variable
        $file = $_FILES['file'];

        // print_r($file);

        // Get the Information from the returned file array
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        //1. File Type Constraint

        // Type of files allowed
        $allowedFiles = array("jpg", 'jpeg','png','gif');

        // Get the file extension
        $ext = explode('.',$fileName);
        $ext = end($ext);
        $ext = strtolower($ext);

        if (!in_array($ext, $allowedFiles)) {
            $_SESSION['error_msg'] = "file type not allowed. allowed: jpg,jpeg,png,gif";
            header("Location: ../../services/profile");
        }

        // 2. file Error
        elseif ($fileError != 0) {
            $_SESSION['error_msg'] = "file is corrupted";
            header("Location: ../../services/profile");
        }

        // 3. File Size

        elseif ($fileSize > 5000000) {
            $_SESSION['error_msg'] = "file is too large. max: 5mb";
            header("Location: ../../services/profile");
        }

        else{
            //   echo   $fileNewName = rand(1000000000,9999999999) . '.'.$ext;

            // 4. Generate a new name for our file
             $fileNewName = "avatar". $id . '.'.$ext;

            //  5. Get the storage location
            $location = "../img/uploads/";

            // 6. Move file

            $move = move_uploaded_file($fileTmpName,$location.$fileNewName);

            if(!$move){
                $_SESSION['error_msg'] = "Failed to Upload File";
                header("Location: ../../services/profile");
            }else{
                $sql = "UPDATE users SET avatar = '$fileNewName' WHERE id = '$id'";
                $query = mysqli_query($connectDB, $sql);

                if ($query) {
                    $_SESSION['success_msg'] = "Avatar Changed";
                    header("Location: ../../services/profile");
                } else {
                    $_SESSION['error_msg'] = "Oops! Something went wrong";
                    header("Location: ../../services/profile");
                }
                
            }
        }

     }