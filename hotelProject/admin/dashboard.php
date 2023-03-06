<?php
    require "../assets/config/db_con.php";
    require "../assets/includes/sessions.php";
    adminGuard();

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
            <div class="card p-2">
            <div class="text-start">
                 <a href="room" class="btn btn-primary">Add a New Room</a>
            </div>
               
                   <div class="card p-3 text-center ms-auto" style="width: 150px;">
                        Total Users
                        <?php 
                            $sql = "SELECT * FROM users WHERE user_role != 'admin' ";
                            $query = mysqli_query($connectDB,$sql);
                        ?>
                        <span class="d-block">
                            <?php echo mysqli_num_rows($query); ?>
                        </span>
                   </div>

                   <div class="table-responsive my-3">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="row">Name</th>
                                    <th scope="row">email</th>
                                    <th scope="row">Phone</th>
                                    <th scope="row">Date created</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($query)){ ?>
                                    <tr>
                                        <td><?php echo $row['full_name'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['date_created'] ?></td>
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