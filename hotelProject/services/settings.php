<?php
    require "../assets/config/db_con.php";
    require "../assets/includes/sessions.php";
    authGuard();

    $id =  $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE id = '$id' ";
    $query  = mysqli_query($connectDB,$sql);
    $row = mysqli_fetch_assoc($query);

    // var_dump($row);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <section>
        <?php include_once "../assets/includes/dash-nav.php"; ?>
    </section>
   

    <section>
        <div class="container pt-4">
            <div class="card mx-auto" style="max-width: 500px;">
                <?php echo successMsg(); echo errorMsg(); ?>
                <form method="post" action="../assets/config/reset_password.php" class="card-body">
                    <input type="text" class="form-control mb-3" name="old" placeholder="Old Password">
                    <input type="text" class="form-control mb-3" name="new" placeholder="New Password">
                    <input type="text" class="form-control mb-3" name="confirm" placeholder="Confirm Password">

                    <button type="submit" name="changepassword" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php include "../assets/includes/footer.php" ?>
</body>
</html>