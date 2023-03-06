<?php
    require "db_con.php";
    require "../includes/sessions.php";

    if (isset($_GET['cancel'])) {
        $id = $_GET['cancel'];

        $sql = "UPDATE reservation SET r_status = 'canceled' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Reservation Canceled!";
            header("Location: ../../admin/reservations");
        } else {
            $_SESSION['error_msg'] = "Oops, something went wrong !";
            header("Location: ../../admin/reservations");
        }
    
    } 
    elseif (isset($_GET['checkin'])) {
        $id = $_GET['checkin'];

        $sql = "UPDATE reservation SET r_status = 'checkedin' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Customer Checked In!";
            header("Location: ../../admin/reservations");
        } else {
            $_SESSION['error_msg'] = "Oops, something went wrong !";
            header("Location: ../../admin/reservations");
        }
    
    } 
    elseif (isset($_GET['checkout'])) {
        $id = $_GET['checkout'];

        $sql = "UPDATE reservation SET r_status = 'checkedout' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Customer Checked Out!";
            header("Location: ../../admin/reservations");
        } else {
            $_SESSION['error_msg'] = "Oops, something went wrong !";
            header("Location: ../../admin/reservations");
        }
    
    } 
    elseif (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        /*
            Always add a where clause to the delete statement in order to prevent deleting all records \
        
            
            DELETE FROM <table> WHERE <column> = '$<identifier>';
        */

        $sql = "DELETE FROM reservation WHERE id = '$id' ";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Records Deleted Successfully!";
            header("Location: ../../admin/reservations");
        } else {
            $_SESSION['error_msg'] = "Oops, something went wrong !";
            header("Location: ../../admin/reservations");
        }
    
    } 
    
    else {
        header("Location: logout");
    }
    