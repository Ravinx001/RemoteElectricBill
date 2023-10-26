<?php

require "db.php";

$q1 = "SELECT * FROM `wifi` ORDER BY userId DESC LIMIT 1";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;
$conn->close();

if ($n1 > 0) {
    $d1 = $rs1->fetch_assoc();
    ?>
    <td><?php echo $d1["userId"]; ?></td>
    <td><?php echo $d1["wifiName"]; ?></td>
    <td><?php echo $d1["wifiPassword"]; ?></td>
    <?php
} else {
    echo $d1["No data"];
}
