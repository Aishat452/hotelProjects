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
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <section>
        <?php include_once "../assets/includes/dash-nav.php"; ?>
    </section>
   

    <section>
        <div class="container pt-4">
            <div class="card">
                <?php echo successMsg(); echo errorMsg(); ?>
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4">
                        <form action="../assets/config/file_upload.php" enctype="multipart/form-data" method="post">
                            <img src="../assets/img/uploads/<?php echo $row['avatar'].'?'.mt_rand() ?>" alt="avatar" width="100"  class="img-thumbnail shadow d-block mx-auto my-2">
                            <div class="input-group">
                                <input type="file" name="file" class="form-control">
                                <button class="btn btn-primary" name="upload">Upload</button>
                            </div>
                        </form>
                    </div>

                    <form action="../assets/config/profile_update.php" method="post">
                        <label>Full Name:</label>
                        <input type="text" name="fname" value="<?php echo $row['full_name'] ?>" class="form-control mb-3">

                        <label>Email:</label>
                        <input type="email" value="<?php echo $row['email'] ?>" readonly class="form-control mb-3">

                        <label>Phone:</label>
                        <input type="tel" name="phone" value="<?php echo $row['phone'] ?>" class="form-control mb-3">

                        <label>Gender:</label>
                        <select name="gender" class="form-select">
                            <option value="<?php echo $row['gender'] ?>" selected>
                                <?php echo ucwords($row['gender']) ?>
                            </option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>


                        <button type="submit" class="btn btn-primary my-3" name="update">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php include "../assets/includes/footer.php" ?>
</body>
</html>