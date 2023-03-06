<?php
require "../assets/config/db_con.php";
require "../assets/includes/sessions.php";
adminGuard();

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
                <form action="../assets/config/room_config.php" method="post" class="card p-1">
                    <?php echo errorMsg(); echo successMsg(); ?>
                    <h3 class="card-header text-center">Add A New Room</h3>
                    <div class="card-body">
                        <input placeholder="Room Name" name="name" type="text" class="form-control mb-3 shadow">
                        <input placeholder="Room Price" name="price" type="number" class="form-control mb-3 shadow">
                        <input placeholder="Rooms Available" name="stock" type="number" class="form-control mb-3 shadow">




                        <button name="addRoom" type="submit" class="btn btn-primary my-2">Add Room</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php include "../assets/includes/footer.php" ?>
</body>

</html>