<?php

session_start();

$conn = new mysqli(
    "localhost",
    "root",
    "Ravi400500lak@",
    "healthhub",
    "3306"
);

if ($conn->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
