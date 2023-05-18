<?php
include "konek.php";
    $id = $_GET['id'];
    $delete = mysqli_query($conf, "DELETE FROM list WHERE id = '$id'");
    if($delete){
        header("location: index.php");
    }
?>