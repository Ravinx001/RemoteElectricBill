<?php

require "db.php";

$q1 = "SELECT * FROM `power` ORDER BY powerId DESC LIMIT 1";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;
$conn->close();

if ($n1 > 0) {
    $d1 = $rs1->fetch_assoc();
    echo $d1["powerUsage"];
} else {
    echo $d1["No data"];
}
