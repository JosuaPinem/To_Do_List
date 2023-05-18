<?php
    $conf = mysqli_connect("localhost","root","","to_do_list");

    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
?>