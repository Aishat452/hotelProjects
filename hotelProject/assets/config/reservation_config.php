<?php
    require "db_con.php";
    require "../includes/sessions.php";

    date_default_timezone_set("Africa/Lagos");
    /*
        The isset function checks if a variable exist and it is not equal to null
    */ 

    //Checking if the user did not click on our submit button
   if (isset($_POST['makeReserve'])) {
     $id = $_SESSION['user'];
     $room = $_POST['room'];
     $numroom = $_POST['numroom'];
     $checkin = $_POST['checkin'];
     $checkout = $_POST['checkout'];


      if (trim($room) === "" || trim($numroom) === "" || trim($checkin) === "" || trim($checkout) === "" ) {
        $_SESSION['error_msg'] = "Fields cannot be empty!";
        header("Location: ../../services/reservations");
      }
      
      else{
        
        // Save the Data
        $sql = "SELECT room_price,room_stock FROM room_details WHERE id = '$room' ";
        $query = mysqli_query($connectDB,$sql);

        $row = mysqli_fetch_assoc($query); 

        // var_dump($row);
        if (intval($row['room_stock'] < $numroom)) {
          $_SESSION['error_msg'] = "Available rooms: $row[room_stock] !";
          header("Location: ../../services/reservations");
        }
        else{
          
          $total = intval($row['room_price']) * intval($numroom);
          $remainingRooms = intval($row['room_stock']) - intval($numroom);


          // Create a SQL command Statement: INSERT STATEMENT
          $sql = "INSERT INTO reservation(userid,roomid,num_rooms,total_amount,checkin,checkout) VALUES(?,?,?,?,?,?)";
  
          // Initialize Connection to database
          $stmt = mysqli_stmt_init($connectDB);
  
          // Prepare Connection with Statement
          mysqli_stmt_prepare($stmt,$sql);
  
          // Bind the parameters to the placeholders
          mysqli_stmt_bind_param($stmt,"iiiiss", $id,$room,$numroom,$total,$checkin,$checkout);
  
          // Execute the Statement
          $execute = mysqli_stmt_execute($stmt);
  
          if ($execute) {
              $sql = "UPDATE room_details SET room_stock = '$remainingRooms' WHERE id = '$room' ";
              $query = mysqli_query($connectDB,$sql);

              if ($query) {
                $_SESSION['success_msg'] = "Reserved successfully!";
                header("Location: ../../services/reservations");
              } else {
                $_SESSION['error_msg'] = "Oops, something went wrong";
                header("Location: ../../services/reservations");
              }
              
          }else{
            $_SESSION['error_msg'] = "Oops, something went wrong!";
            header("Location: ../../services/reservations");
          }
          // var_dump($stmt);
        }


      }

   }

   
   else{
    header('Location: logout');
   }