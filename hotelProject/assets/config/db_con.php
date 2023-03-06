<?php
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "hotel_project";

   $connectDB = mysqli_connect(
        $dbHost,
        $dbUser,
        $dbPassword,
        $dbName
    );