<?php
session_start();

if ($_GET["sess"] == "des" && isset($_GET["sess"])) {

    session_destroy();

    header("location: ../index.php");
    exit();
    
} else {
    header("location: ../home.php");
    exit();
}
