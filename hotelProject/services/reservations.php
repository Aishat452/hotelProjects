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
        <div class="container pt-4" style="height: 100%;">
            <div class="card p-2">
                <?php echo successMsg();
                echo errorMsg(); ?>
                <div class="text-end my-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Make Reservation
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="../assets/config/reservation_config.php" method="POST" class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Make Reservation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <label>Select Room</label>
                                    <select name="room" class="form-select mb-3">
                                        <?php
                                        $sql = "SELECT * FROM room_details";
                                        $query = mysqli_query($connectDB, $sql);
                                        while ($row1 = mysqli_fetch_assoc($query)) { ?>

                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row1['room_name'] ?>
                                            <?php echo "₦" . number_format($row1['room_price'], 2, '.', ','); ?>

                                        </option>

                                        <?php } ?>

                                    </select>
                                    <label class="room">No of Rooms</label>
                                    <input type="number" name="numroom" class="form-control" value="1" min="1">
                                    <label>Check In Date</label>
                                    <input type="datetime-local" name="checkin" class="form-control">
                                    <label>Check Out Date</label>
                                    <input type="datetime-local" name="checkout" class="form-control">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="makeReserve" class="btn btn-primary">Reserve</button>

                                    <!--============================================================ PAYMENT CODE START =============================================================== -->

                                    <small>Pay online with your debit card</small> <br>
                                    <input type="button" class="btn-success btn" style="cursor:pointer;" value="Pay Now"
                                        id="submit" />

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
                                    </script>
                                    <script type="text/javascript"
                                        src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                                    <script type="text/javascript">
                                    document.addEventListener("DOMContentLoaded", function(event) {
                                        document.getElementById('submit').addEventListener('click', function() {

                                            var flw_ref = "",
                                                chargeResponse = "",
                                                trxref = "FDKHGK" + Math.random(),
                                                API_publicKey = "FLWPUBK_TEST-83af4504f6370dc6576a13be3875e79b-X";
                                            //Always change flutterwave public key to your own key

                                            //   ENTER ALL ESSENTIAL VARIABLES
                                            // var amount_ea = "50000";
                                            var amount_ea = <?php echo 10000; ?>;
                                            var email_ea = <?php echo (json_encode($row['email'])); ?>;
                                            var phone_ea = <?php echo (json_encode($row['phone'])); ?>;
                                            var ref_ea = <?php echo (json_encode($ref = "HPP".rand(100000,999999))); ?>;

                                            getpaidSetup({
                                                PBFPubKey: API_publicKey,
                                                customer_email: email_ea,
                                                amount: amount_ea,
                                                customer_phone: phone_ea,
                                                currency: "NGN",
                                                txref: ref_ea,
                                                meta: [{
                                                    metaname: "EA-NG",
                                                    metavalue: "NG"
                                                }],
                                                onclose: function(response) {},
                                                callback: function(response) {
                                                    txref = response.data.txRef,
                                                        chargeResponse = response.data
                                                        .chargeResponseCode;
                                                    if (chargeResponse == "00" ||
                                                        chargeResponse == "0") {
                                                        //   if payment failed
                                                        window.location = "payment-failed";
                                                    } else {
                                                        //when successful
                                                        window.location =
                                                            "payment-success?id=2&amount=2000&ref=sijoxaskxmaoncpo";
                                                    }
                                                }
                                            });
                                        });
                                    });
                                    </script>
                                    <!-- END OF PAYMENT SCRIPT -->

                                    <!--=============================================================== PAYMENT CODE END ============================================================-->

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="table-responsive my-3">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="row">Room Name</th>
                                <th scope="row">No Of Rooms</th>
                                <th scope="row">Check In </th>
                                <th scope="row">Check Out </th>
                                <th scope="row">Total</th>

                                <th scope="row">Date</th>
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
                            $sql = "SELECT *, reservation.date_created AS date_c 
                                    FROM reservation 
                                    INNER JOIN room_details ON reservation.roomid = room_details.id
                                    WHERE userid = '$id' 
                                    ORDER BY reservation.id DESC  
                                    LIMIT 0,20";
                            $query = mysqli_query($connectDB, $sql);

                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['room_name'] ?></td>
                                <td class="text-center"><?php echo $row['num_rooms'] ?></td>
                                <td>
                                    <?php
                                            $date = date_create($row['checkin']);
                                            echo date_format($date, "F, jS. Y h:i a");
                                        ?>
                                </td>
                                <td>
                                    <?php
                                            $date = date_create($row['checkout']);
                                            echo date_format($date, "F, jS. Y h:i a");
                                        ?>
                                </td>
                                <td class="text-nowrap">
                                    <?php
                                            echo "₦ ". number_format($row['total_amount'],2,'.',',');
                                        ?>
                                </td>
                                <td>
                                    <?php
                                            $date = date_create($row['date_c']);
                                            echo date_format($date, "F, jS. Y h:i a");
                                        ?>
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