<?php

require_once("db.php");

$email = $_POST["email"];
$pwd = $_POST["pwd"];
$chbox = $_POST["chbox"];

if (!empty($email) || !empty($pwd)) {

    $q1 = "SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $pwd . "'";
    $rs1 = $conn->query($q1);
    $n1 = $rs1->num_rows;
    $d1 = $rs1->fetch_assoc();
    $conn->close();

    echo $n1;

    if ($n1 >= 1) {

        if ($chbox == "true") {
            setcookie("email", $email, time() + (60 * 60 * 24 * 30));
            setcookie("pwd", $pwd, time() + (60 * 60 * 24 * 30));

            if (isset($_SESSION["user"])) {
                echo "##01#88";
            } else {
                $_SESSION["user"] = $d1;
                echo "##01#88";
            }
        } else {

            if (isset($_SESSION["user"])) {
                echo "##01#88";
            } else {
                $_SESSION["user"] = $d1;
                echo "##01#88";
            }
        }
    } else {
        echo "Invalid Email or Password !";
    }
} else {
    echo "Fill All Data !";
}
