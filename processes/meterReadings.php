<?php

require "db.php";

$q1 = "SELECT * FROM `meterreading` ORDER BY readingId DESC";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;
$conn->close();

if ($n1 > 0) {

    for ($i = 0; $i < $n1; $i++) {
        $d1 = $rs1->fetch_assoc();
?>

        <tr scope="row">
            <td><?php echo $d1["readingId"]; ?></td>
            <td><?php echo $d1["userId"]; ?></td>
            <td><?php echo $d1["dateTime"]; ?></td>
            <td><?php echo $d1["usage"]; ?></td>
        </tr>

<?php
    }
} else {
    echo $d1["No data"];
}
