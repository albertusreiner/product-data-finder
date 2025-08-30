<?php
    //koneksi database
    $server = "localhost";
    $user = "xxxxx";            //change username
    $password = "xxxxx";        //change password
    $database = "product-data-scanner";

    //buat koneksi
    $conn = mysqli_connect($server, $user, $password, $database) or die (mysqli_error($conn));
?>
