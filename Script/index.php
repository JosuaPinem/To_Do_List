<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8199e1704e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/style.css">
    <title>To-Do List App</title>
</head>
// Php Code
<?php 
    include "config.php";
    if(isset($_POST['submit'])){
        $key = $_POST['task'];
        $date = $_POST['date'] . " " . date("H:i:s");
        $keterangan = $_POST['priority'];
        $push = mysqli_query($conf, "INSERT INTO list VALUES ('', '$key', '$date', '$keterangan')");
        if($push){
            echo "<meta http-equiv='refresh' content='1 url=index.php'>";
        }  
    }


?>

<body>
    <div class="content">
        <div class="header">
            <p>Hello, Guest!</p>
        </div>
        <div class="container">
            <h1>To-Do List</h1>
            <form action="" method="post">
                <div class="input">
                    <input type="text" id="task" name="task" placeholder="Enter your task">
                    <input type="date" id="date" title="date" name="date">
                    <select name="priority" id="priority" title="priority">
                        <option selected disabled value="none">Choose Priority</option>
                        <option value="1">Low</option>
                        <option value="0">High</option>
                    </select>
                    <button id="add" value="submit" name="submit">Add</button>
                </div>
            </form>
            <div class="list">
            <?php
                $data = mysqli_query($conf, "SELECT waktu FROM list where keterangan = 0");
                $base = array();
                if (mysqli_num_rows($data) > 0) {
                    while ($row = mysqli_fetch_assoc($data)) {
                        $base[] = $row;
                    }
                }
                $bigdata = array();
                foreach($base as $data){
                    $bigdata[] = date("Y-m-d H:i:s", strtotime($data['waktu']));
                }
                $arrLen = count($bigdata);
                // Iterate over the entire array, except the last element (0...n-1).
                for($i = 0; $i < $arrLen; $i++) {
                    $min = $i;
                    // Iterate the remaining array (i...n).
                    for($j = $i + 1; $j < $arrLen; $j++) {
                        // If j is less than the min, update the min index.
                        if($bigdata[$j] < $bigdata[$min]) {
                            $min = $j;
                        }
                    }
                    // Do an in place swap.
                    $tmp = $bigdata[$min];
                    $bigdata[$min] = $bigdata[$i];
                    $bigdata[$i] = $tmp;
                }
                // Show the data from sorting
                $result = array();
                foreach($bigdata as $data){
                    $result[] = $data;
                }
                foreach($result as $data){
                    
            ?>
                <ul id="list">
                    <li class="item">
                        <div class="icon">
                            <i class="fa-regular fa-square"></i>
                        </div>
                        <div class="task">
                            <span>
                                <?php 
                                $cari = date("Y-m-d H:i:s", strtotime($data));
                                $tampil = mysqli_query($conf, "SELECT * FROM list WHERE waktu LIKE '%$cari%'");
                                while ($row = mysqli_fetch_array($tampil)) {
                                    echo $row['catatan'];
                                } ?>
                            </span>
                            <span><?php  echo date("d M Y H:i:s", strtotime($data)); ?></span>
                            <span><?php echo "High"; ?></span>
                        </div>
                        <div class="delete">
                            <i class="fas fa-trash"></i>
                        </div>
                    </li>
                </ul>
            <?php } ?>

            <?php
                $data = mysqli_query($conf, "SELECT waktu FROM list where keterangan = 1");
                $base = array();
                if (mysqli_num_rows($data) > 0) {
                    while ($row = mysqli_fetch_assoc($data)) {
                        $base[] = $row;
                    }
                }
                $bigdata = array();
                foreach($base as $data){
                    $bigdata[] = date("Y-m-d H:i:s", strtotime($data['waktu']));
                }
                $arrLen = count($bigdata);
                // Iterate over the entire array, except the last element (0...n-1).
                for($i = 0; $i < $arrLen; $i++) {
                    $min = $i;
                    // Iterate the remaining array (i...n).
                    for($j = $i + 1; $j < $arrLen; $j++) {
                        // If j is less than the min, update the min index.
                        if($bigdata[$j] < $bigdata[$min]) {
                            $min = $j;
                        }
                    }
                    // Do an in place swap.
                    $tmp = $bigdata[$min];
                    $bigdata[$min] = $bigdata[$i];
                    $bigdata[$i] = $tmp;
                }
                // Show the data from sorting
                $result = array();
                foreach($bigdata as $data){
                    $result[] = $data;
                }
                foreach($result as $data){
                    
            ?>
                <ul id="list">
                    <li class="item">
                        <div class="icon">
                            <i class="fa-regular fa-square"></i>
                        </div>
                        <div class="task">
                            <span>
                                <?php 
                                $cari = date("Y-m-d H:i:s", strtotime($data));
                                $tampil = mysqli_query($conf, "SELECT * FROM list WHERE waktu LIKE '%$cari%'");
                                while ($row = mysqli_fetch_array($tampil)) {
                                    echo $row['catatan'];
                                } ?>
                            </span>
                            <span><?php  echo date("d M Y H:i:s", strtotime($data)); ?></span>
                            <span><?php echo "Low"; ?></span>
                        </div>
                        <div class="delete">
                            <i class="fas fa-trash"></i>
                        </div>
                    </li>
                </ul>
            <?php } ?>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>