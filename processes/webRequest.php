<?php

require "db.php";

if (isset($_GET["data"])) {

    $data = $_GET["data"];

    // set the time zone to Sri Lanka
    date_default_timezone_set('Asia/Colombo');

    // get the current time in Sri Lanka
    $dateTime = date('Y-m-d H:i:s');

    // Using explode() to split the string into an array based on spaces
    $parts = explode(",", $data);

    $i = 0;
    // Output each part of the string
    foreach ($parts as $info[$i]) {

        if (!is_numeric($info[$i]) || empty($info[$i])) {
            echo "Invalid values sent !";
            exit();
        }

        $i++;
    }

    // $info[0] - current
    // $info[1] - voltage
    // $info[2] - power in kW
    // $info[3] - power usage in kWh

    if (strlen($info[0]) < 4) {
        echo "Invalid current value sent !";
        exit();
    } elseif (strlen($info[1]) < 4) {
        echo "Invalid voltage value sent !";
        exit();
    } elseif (strlen($info[2]) < 5) {
        echo "Invalid power value sent !";
        exit();
    } elseif (strlen($info[3]) < 5) {
        echo "Invalid power usage value sent !";
        exit();
    } else {

        $q1 = "SELECT * FROM `meterreading` ORDER BY readingId DESC LIMIT 1";
        $rs1 = $conn->query($q1);
        $n1 = $rs1->num_rows;
        $d1 = $rs1->fetch_assoc();

        $status = 0;
        if ($n1 > 0) {
            if ($d1["usage"] >= $info["3"]) {
                echo "Invalid power usage value sent !\n";
                $status = 1;
            }
        }

        if ($status == 0) {
            $q2 = "INSERT INTO `meterreading` (`userId`,`dateTime`,`usage`) VALUES ('1',
            '" . $dateTime . "','" . $info[3] . "')";
            $rs2 = $conn->query($q2);
        }

        $q3 = "SELECT * FROM `current`";
        $rs3 = $conn->query($q3);
        $n3 = $rs3->num_rows;

        $q4 = "SELECT * FROM `power`";
        $rs4 = $conn->query($q4);
        $n4 = $rs4->num_rows;

        $q5 = "SELECT * FROM `voltage`";
        $rs5 = $conn->query($q5);
        $n5 = $rs5->num_rows;

        if ($n3 > 100) {
            $q6 = "TRUNCATE TABLE `current`";
            $rs6 = $conn->query($q6);

            $q6x = "INSERT INTO `current` (`current`) VALUES ('" . $info[0] . "')";
            $rs6x = $conn->query($q6x);
        } else {
            $q6x = "INSERT INTO `current` (`current`) VALUES ('" . $info[0] . "')";
            $rs6x = $conn->query($q6x);
        }

        if ($n4 > 100) {
            $q7 = "TRUNCATE TABLE `power`";
            $rs7 = $conn->query($q7);

            $q7x = "INSERT INTO `power` (`powerUsage`) VALUES ('" . $info[2] . "')";
            $rs7x = $conn->query($q7x);
        } else {
            $q7x = "INSERT INTO `power` (`powerUsage`) VALUES ('" . $info[2] . "')";
            $rs7x = $conn->query($q7x);
        }

        if ($n5 > 100) {
            $q8 = "TRUNCATE TABLE `voltage`";
            $rs8 = $conn->query($q8);

            $q8x = "INSERT INTO `voltage` (`voltage`) VALUES ('" . $info[1] . "')";
            $rs8x = $conn->query($q8x);
        } else {
            $q8x = "INSERT INTO `voltage` (`voltage`) VALUES ('" . $info[1] . "')";
            $rs8x = $conn->query($q8x);
        }

        $conn->close();

        echo "Request Successfully Done";
    }
} else {
    echo "No data sent";
}
