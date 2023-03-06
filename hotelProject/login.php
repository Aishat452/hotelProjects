
<?php 
    require "assets/includes/sessions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Project</title>

    <link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php include_once "assets/includes/nav.php" ?>


    <div class="container mt-5">
        <form action="assets/config/login_config.php" method="post" class="card mx-auto p-1" style="max-width: 600px;">
            <?php echo errorMsg(); echo successMsg(); ?>
            <h3 class="card-header text-center">Login to Your Account</h3>
            <div class="card-body">
                <input placeholder="Email" name="email" type="email" class="form-control mb-3 shadow">


                <input placeholder="Password" name="password" type="password" class="form-control mb-3 shadow">


                <button name="login" type="submit" class="btn btn-primary my-2">Login</button>
            </div>
        </form>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>