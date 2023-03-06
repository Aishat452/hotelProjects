<?php
require "../assets/config/db_con.php";
require "../assets/includes/sessions.php";
authGuard();

$id =  $_SESSION['user'];

if (!isset($_GET['q'])) {
    header("Location: dashboard");
}


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


                $sql = "SELECT *, reservation.date_created AS date_c, reservation.id AS r_id
                FROM reservation 
                INNER JOIN users ON reservation.userid = users.id
                INNER JOIN room_details ON reservation.roomid = room_details.id

                WHERE reservation.id = '$_GET[q]'
                ORDER BY reservation.id DESC  
                LIMIT 0,20";
                $query = mysqli_query($connectDB, $sql);
                $row = mysqli_fetch_assoc($query);
                ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Status:
                        </p>
                        <p class="fs-6 border p-2 rounded
                            <?php
                            if ($row['r_status'] == 'pending') {
                                echo "bg-warning";
                                $status = "Pending";
                            } elseif ($row['r_status'] == 'checkedin') {
                                echo "bg-success text-light";
                                $status = "Checked In";
                            } elseif ($row['r_status'] == 'checkedout') {
                                echo "bg-secondary text-light";
                                $status = "Checked Out";
                            } elseif ($row['r_status'] == 'canceled') {
                                echo "bg-danger text-light";
                                $status = "Canceled";
                            }

                            ?>
                        ">
                            <?php echo $status; ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Client Name:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php echo $row['full_name'] ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Room Name:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php echo $row['room_name'] ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Number of Rooms Booked:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php echo $row['num_rooms'] ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Check In:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php
                            $date = date_create($row['checkin']);
                            echo date_format($date, "F, jS. Y h:i a");
                            ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Check Out:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php
                            $date = date_create($row['checkout']);
                            echo date_format($date, "F, jS. Y h:i a");
                            ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Amount:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php
                            echo "₦ " . number_format($row['total_amount'], 2, '.', ',');
                            ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="fs-5 fw-bold">
                            Date of Booking:
                        </p>
                        <p class="fs-6 border p-2 rounded">
                            <?php
                            $date = date_create($row['date_c']);
                            echo date_format($date, "F, jS. Y h:i a");
                            ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <a href="../assets/config/reservation_status?cancel=<?php echo $_GET['q']; ?>" class="btn btn-warning">Cancel</a>
                        <a href="../assets/config/reservation_status?checkin=<?php echo $_GET['q']; ?>" class="btn btn-success">Checked In</a>
                        <a href="../assets/config/reservation_status?checkout=<?php echo $_GET['q']; ?>" class="btn btn-primary">Checked Out</a>

                        <!-- Delete modal Trigger -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Reservation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h1 class="text-danger text-center">Are You Sure?</h1>
                                        <p class="fs-5">
                                            Once Records are deleted, they <sapn class="text-danger fw-bold">Can not</sapn> be gotten back
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="../assets/config/reservation_status?delete=<?php echo $_GET['q']; ?>" class="btn btn-danger">Understood</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php include "../assets/includes/footer.php" ?>
</body>

</html>