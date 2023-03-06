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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <section>
        <?php include_once "../assets/includes/dash-nav.php"; ?>
    </section>
   

    <section>
        <div class="container pt-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4">
                    <img src="../assets/img/uploads/<?php echo $row['avatar'].'?'.mt_rand() ?>" alt="avatar" width="100"  class="img-thumbnail shadow d-block mx-auto my-2">
                    </div>

                    <p class="border p-2 mb-3 fw-bold">
                        Full Name: <span class="text-capitalize fw-lighter">
                            <?php echo $row['full_name']; ?>
                        </span>
                    </p>
                    <p class="border p-2 mb-3 fw-bold">
                        email: <span class="fw-lighter">
                            <?php echo $row['email']; ?>
                        </span>
                    </p>
                    <p class="border p-2 mb-3 fw-bold">
                        Phone: <span class="text-capitalize fw-lighter">
                            <?php echo $row['phone']; ?>
                        </span>
                    </p>
                    <p class="border p-2 mb-3 fw-bold">
                        Gender: <span class="text-capitalize fw-lighter">
                            <?php echo $row['gender']; ?>
                        </span>
                    </p>
                    <p class="border p-2 mb-3 fw-bold">
                        Date Registerd: <span class="text-capitalize fw-lighter">
                            <?php 
                                $date = date_create($row['date_created']);
                               echo date_format($date, "F, jS. Y");
                            ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php include "../assets/includes/footer.php" ?>
</body>
</html>