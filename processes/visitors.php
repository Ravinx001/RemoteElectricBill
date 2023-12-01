<?php

require "db.php";

$q1 = "SELECT * FROM `visitors`";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;

if ($n1 > 0) {

    for ($i = 0; $i < $n1; $i++) {
        $d1 = $rs1->fetch_assoc();
?>

        <tr scope="row">
            <td><?php echo $d1["visitorId"]; ?></td>
            <td><?php echo $d1["ip"]; ?></td>
            <td><?php echo $d1["device"]; ?></td>
            <td><?php echo $d1["os"]; ?></td>
            <td><?php echo $d1["browser"]; ?></td>
            <td><?php echo $d1["firstVisited_dateTime"]; ?></td>
            <td><?php echo $d1["lastVisited_dateTime"]; ?></td>
            <td><?php echo $d1["visitedCount"]; ?></td>
        </tr>

<?php
    }
} else {
    echo $d1["No data"];
}
