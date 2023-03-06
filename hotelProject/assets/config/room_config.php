<?php
    require "db_con.php";
    require "../includes/sessions.php";

    date_default_timezone_set("Africa/Lagos");
    /*
        The isset function checks if a variable exist and it is not equal to null
    */ 

    //Checking if the user did not click on our submit button
   if (!isset($_POST['addRoom'])) {
       $_SESSION['error_msg'] = "Please create an account to continue!";
       header("Location: logout");
   }else{
     $name = $_POST['name'];
     $price = $_POST['price'];
     $stock = $_POST['stock'];


      if (trim($name) === "" || trim($price) === "" || trim($stock) === "" ) {
        $_SESSION['error_msg'] = "Fields cannot be empty!";
        header("Location: ../../admin/room");
      }
      
      else{
        
        // Save the Data

        // Create a SQL command Statement: INSERT STATEMENT
        $sql = "INSERT INTO room_details(room_name,room_price,room_stock) VALUES(?,?,?)";

        // Initialize Connection to database
        $stmt = mysqli_stmt_init($connectDB);

        // Prepare Connection with Statement
        mysqli_stmt_prepare($stmt,$sql);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt,"sii", $name,$price,$stock);

        // Execute the Statement
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            $_SESSION['success_msg'] = "Room created successfully!";
            header("Location: ../../admin/room");
        }else{
          $_SESSION['error_msg'] = "Oops, something went wrong!";
          header("Location: ../../admin/room");
        }
        // var_dump($stmt);


      }

   }

   