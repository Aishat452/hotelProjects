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
        <form action="assets/config/register_config.php" method="post" class="card mx-auto p-1" style="max-width: 600px;">
            <?php echo errorMsg(); echo successMsg(); ?>
            <h3 class="card-header text-center">Create An Account</h3>
            <div class="card-body">
                <input placeholder="Full Name" name="full_name" type="text" class="form-control mb-3 shadow">

                <input placeholder="Email" name="email" type="email" class="form-control mb-3 shadow">

                <input placeholder="Phone Number" name="phone" type="tel" class="form-control mb-3 shadow">

                <select name="gender" class="form-select shadow mb-3">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option selected disabled>Gender</option>
                </select>

                <input placeholder="Password" name="password" type="password" class="form-control mb-3 shadow">

                <input placeholder="Confirm Password" name="confirm_password" type="password" class="form-control mb-3 shadow">


                <button name="register" type="submit" class="btn btn-primary my-2">Submit</button>
            </div>
        </form>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>