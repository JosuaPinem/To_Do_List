<?php
    $conf = mysqli_connect("localhost", "root", "", "to_do_list");

    if(!$conf){
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        exit;
    }
