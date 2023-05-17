<?php
    $conf = mysqli_connect("localhost","root","","coba");

    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
?>