<!DOCTYPE html>
<html lang="en">
    <!-- PHP CODE -->
    <?php 
        // include the file connection of the database
        include 'konek.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-Do-List</title>
</head>
<body>
    <table>
        <!-- PHP CODE -->
        <?php
            $data = mysqli_query($conf, "SELECT waktu,jam FROM list");
            $base = array();
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                    $base[] = $row;
                }
            }
            $bigdata = array();
            foreach($base as $data){
                $bigdata[] = date("Y-m-d", strtotime($data['waktu'])) . " " . date("H:i:s", strtotime($data['jam']));
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
            echo "<tr>";
            echo "<td>".$data."</td>";
            echo "</tr>";
        }
        // foreach($result as $data){
        //     echo "<tr>";
        //     echo "<td>".date("d M Y", strtotime($data))."</td>";
        //     $tampil = mysqli_query($conf, "SELECT * FROM list WHERE waktu LIKE '%$data%'");
        //     while ($row = mysqli_fetch_array($tampil)) {
        //         echo "<td>".$row['keterangan']."</td>";
        //     }
        //     echo "</tr>";
        // }
        ?>
    </table>
</body>
</html>