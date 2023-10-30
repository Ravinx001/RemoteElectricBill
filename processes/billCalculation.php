<?php

require "db.php";

// set the time zone to Sri Lanka
date_default_timezone_set('Asia/Colombo');

// get the current time in Sri Lanka
$dateTime = date('Y-m-d H:i:s');

$firstDay = date("Y-m-01");
$lastDay = date("Y-m-t");


$q1 = "SELECT MIN(`USAGE`) AS minUsage FROM `meterreading` WHERE dateTime>='" . $firstDay . "' AND dateTime<='" . $lastDay . "'";
$rs1 = $conn->query($q1);
$d1 = $rs1->fetch_assoc();

$q2 = "SELECT MAX(`USAGE`) AS maxUsage FROM `meterreading` WHERE dateTime>='" . $firstDay . "' AND dateTime<='" . $lastDay . "'";
$rs2 = $conn->query($q2);
$d2 = $rs2->fetch_assoc();

$q3 = "SELECT * FROM `meterreading` ORDER BY readingId DESC LIMIT 1";
$rs3 = $conn->query($q3);
$n3 = $rs3->num_rows;
$d3 = $rs3->fetch_assoc();
$conn->close();

// echo $firstDay;
// echo "----";
// echo $lastDay;
// echo "----";
// echo $d1["minUsage"];
// echo "----";
// echo $d2["maxUsage"];
// echo "----";

$cost = 0;
$tax = 0;
$totalCost = 0;

if ($d2["maxUsage"] == $d1["minUsage"]) {
    $usage = $d2["maxUsage"];
} else {
    $usage = $d2["maxUsage"] - $d1["minUsage"];
}


if ($usage <= 30) {

    $cost = ($usage * 10) + 150;
} else if ($usage >= 31 && $usage <= 60) {

    $cost = (30 * 10) + ($usage - 30) * 25 + 300;
} else if ($usage >= 61 && $usage <= 90) {

    $cost = (32 * 60) + ($usage - 60) * 35 + 400;
} else if ($usage >= 91 && $usage <= 120) {

    $cost = (32 * 60) + (35 * 30) + ($usage - 90) * 50 + 1000;
} else if ($usage >= 121 && $usage <= 180) {

    $cost = (32 * 60) + (35 * 30) + ($usage - 90) * 50 + 1500;
} else if ($usage > 180 && $usage <= 990) {

    $cost = (32 * 60) + (35 * 30) + ($usage - 90) * 50 + 2500;
} else if ($usage > 990) {

    $cost = (32 * 60) + (35 * 30) + (900 * 50) + ($usage - 990) * 75 + 2500;
}

$tax = round(($cost * 2.565) / 100, 3);
$totalCost = round($cost  + $tax, 3);

echo $totalCost . "," . $tax . "," . $d3["usage"]."," . $d3["dateTime"];
