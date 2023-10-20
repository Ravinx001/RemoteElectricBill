<?php

session_start();

require_once("db.php");

$email = $_POST["email"];
$pwd = $_POST["pwd"];
$chbox = $_POST["chbox"];

$stmt = $conn->prepare("SELECT * FROM `admin` WHERE email=? AND `password`=?");
$stmt->bind_param("sss", $email, $pwd);
$stmt->execute();
$stmt->store_result();
$n = $stmt->num_rows;
$d = $stmt->fetch_assoc();
$stmt->close();
$conn->close();

if (empty($email) || empty($pwd)) {

    if ($n >= 1) {

        if ($checkbox == "true") {
            setcookie("uname", $uname, time() + (60 * 60 * 24 * 30));
            setcookie("password", $password, time() + (60 * 60 * 24 * 30));

            $q01 = "SELECT * FROM `admin` WHERE `username`='" . $uname . "' AND `password`='" . $password . "'";
            $rs01 = $conn->query($q01);
            $n01 = $rs01->num_rows;
            $d01 = $rs01->fetch_assoc();

            if (isset($_SESSION["admin"])) {
                echo "login-suc-admin";
            } else {
                $_SESSION["admin"] = $d01;
                echo "login-suc-admin";
            }
        } else {
            $q01 = "SELECT * FROM `admin` WHERE `username`='" . $uname . "' AND `password`='" . $password . "'";
            $rs01 = $conn->query($q01);
            $n01 = $rs01->num_rows;
            $d01 = $rs01->fetch_assoc();

            if (isset($_SESSION["admin"])) {
                echo "login-suc-admin";
            } else {
                $_SESSION["admin"] = $d01;
                echo "login-suc-admin";
            }
        }
    } else {
        echo "IP";
    }
} else {
    echo "Fill All Data !";
}
