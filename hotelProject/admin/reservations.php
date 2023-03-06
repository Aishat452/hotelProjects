<?php
require "../assets/config/db_con.php";
require "../assets/includes/sessions.php";
authGuard();

$id =  $_SESSION['user'];

$sql = "SELECT * FROM users WHERE id = '$id' ";
$query  = mysqli_query($connectDB, $sql);
$row = mysqli_fetch_assoc($query);

// var_dump($row);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Room</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <section>
        <?php include_once "../assets/includes/dash-nav.php"; ?>
    </section>


    <section>
        <div class="container pt-4">
            <div class="card p-2">
                <?php
                echo successMsg();
                echo errorMsg();
                ?>
                <div class="table-responsive my-3">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="row">Client Name</th>
                                <th scope="row">Room Name</th>
                                <th scope="row">No Of Rooms</th>
                                <th scope="row">Status</th>

                                <th scope="row">Date</th>
                                <th scope="row">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['user'];
                            // $sql = "SELECT * FROM reservation WHERE userid = '$id' ORDER BY id ASC";
                            // $sql = "SELECT * FROM reservation WHERE userid = '$id' ORDER BY id DESC  LIMIT 4,2";

                            // $sql = "SELECT *, room_details.room_name AS r_name FROM reservation 
                            // INNER JOIN room_details ON reservation.roomid = room_details.id
                            // WHERE reservation.userid = '$id' 
                            // ORDER BY reservation.id DESC  
                            // LIMIT 10";
                            $sql = "SELECT *, reservation.date_created AS date_c, reservation.id AS r_id
                                    FROM reservation 
                                    INNER JOIN users ON reservation.userid = users.id
                                    INNER JOIN room_details ON reservation.roomid = room_details.id
                                    ORDER BY reservation.id DESC  
                                    LIMIT 0,20";
                            $query = mysqli_query($connectDB, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td class="text-nowrap"><?php echo $row['full_name'] ?></td>
                                    <td class="text-nowrap"><?php echo $row['room_name'] ?></td>
                                    <td class="text-center"><?php echo $row['num_rooms'] ?></td>
                                    <td class="text-nowrap"><?php echo $row['r_status']; ?></td>
                                    <td class="text-nowrap">
                                        <?php
                                        $date = date_create($row['date_c']);
                                        echo date_format($date, "F, jS. Y h:i a");
                                        ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                ..
                                            </button>
                                            <ul class="dropdown-menu">
                                                <!-- <li><?php echo $row['r_id'] ?></li> -->
                                                <li><a class="dropdown-item" href="view-reservation?q=<?php echo $row['r_id']; ?>">View</a></li>
                                                <li><a class="dropdown-item" href="../assets/config/reservation_status?delete=<?php echo $row['r_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php include "../assets/includes/footer.php" ?>
</body>

</html>