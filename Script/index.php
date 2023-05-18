<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8199e1704e.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>To-Do List App</title>
</head>

<?php
include 'config.php';
if (isset($_POST['submit'])) {
    $key = $_POST['task'];
    $jam = strtotime($_POST['jam']);
    $jam2 = date("H:i:s", $jam);
    $date = strtotime($_POST['date']);
    $date2 = date("Y-m-d", $date) . " " . $jam2;
    $keterangan = $_POST['priority'];
    $push = mysqli_query($conf, "INSERT INTO list VALUES ('', '$key', '$date2', '$keterangan')");
    if ($push) {
        echo "<meta http-equiv='refresh' content='1 url=index.php'>";
    }
}


?>

<body>
    <div class="content">
        <div class="header">
            <a href="login.html">
                <i class="fas fa-arrow-left"></i>
            </a>
            <span>Hello, Guest!</span>
        </div>
        <div class="container">
            <div class="container-title">
                <p>To-Do List</p>
            </div>
            <form action="" method="post">
                <div class="input">
                    <input type="text" id="task" name="task" placeholder="Enter your task">
                    <input type="date" id="date" title="date" name="date">
                    <div style="position: relative">
                        <input type="text" id="timePicker" name="jam" placeholder="00:00">
                    </div>
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
                foreach ($base as $data) {
                    $bigdata[] = date("Y-m-d H:i:s", strtotime($data['waktu']));
                }
                $arrLen = count($bigdata);
                // Iterate over the entire array, except the last element (0...n-1).
                for ($i = 0; $i < $arrLen; $i++) {
                    $min = $i;
                    // Iterate the remaining array (i...n).
                    for ($j = $i + 1; $j < $arrLen; $j++) {
                        // If j is less than the min, update the min index.
                        if ($bigdata[$j] < $bigdata[$min]) {
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
                foreach ($bigdata as $data) {
                    $result[] = $data;
                }
                foreach ($result as $data) {

                ?>
                    <ul id="list">
                        <li class="item">
                        <?php
                            $cari = date("Y-m-d H:i:s", strtotime($data));
                            $tampil = mysqli_query($conf, "SELECT * FROM list WHERE waktu LIKE '%$cari%'");
                            while ($row = mysqli_fetch_array($tampil)) {
                        ?>
                            <div class="icon">
                                <i class="fa-regular fa-square"></i>
                            </div>
                            <div class="task">
                                <span>
                                    <?= $row['catatan']; ?>
                                </span>
                                <span><?php echo date("d M Y H:i:s", strtotime($data)); ?></span>
                                <span><?php echo "High"; ?></span>
                            </div>
                            <div class="d-flex gap-1">
                                    <a href="delete.php?id=<?=$row['id']?>"  class="btn btn-danger d-flex align-items-center p-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                            </div>
                            <?php } ?>
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
                foreach ($base as $data) {
                    $bigdata[] = date("Y-m-d H:i:s", strtotime($data['waktu']));
                }
                $arrLen = count($bigdata);
                // Iterate over the entire array, except the last element (0...n-1).
                for ($i = 0; $i < $arrLen; $i++) {
                    $min = $i;
                    // Iterate the remaining array (i...n).
                    for ($j = $i + 1; $j < $arrLen; $j++) {
                        // If j is less than the min, update the min index.
                        if ($bigdata[$j] < $bigdata[$min]) {
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
                foreach ($bigdata as $data) {
                    $result[] = $data;
                }
                foreach ($result as $data) {

                ?>
                    <ul id="list">
                        <li class="item">
                        <?php
                            $cari = date("Y-m-d H:i:s", strtotime($data));
                            $tampil = mysqli_query($conf, "SELECT * FROM list WHERE waktu LIKE '%$cari%'");
                            while ($row = mysqli_fetch_array($tampil)) {
                        ?>
                            <div class="icon">
                                <i class="fa-regular fa-square"></i>
                            </div>
                            <div class="task">
                                <span>
                                    <?= $row['catatan']; ?>
                                </span>
                                <span><?php echo date("d M Y H:i:s", strtotime($data)); ?></span>
                                <span><?php echo "Low"; ?></span>
                            </div>
                            <div class="d-flex gap-1">
                                    <a href="delete.php?id=<?=$row['id']?>"  class="btn btn-danger d-flex align-items-center p-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                            </div>
                            <?php } ?>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Include Moment.js CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <!-- Include Bootstrap DateTimePicker CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="script.js"></script>
</body>

</html>