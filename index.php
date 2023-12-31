<?php

require "processes/db.php";
require('UserInfo.php');

$ip = "";
$device = "";
$os = "";
$browser = "";

$ip = UserInfo::get_ip();
$device = UserInfo::get_device();
$os = UserInfo::get_os();
$browser = UserInfo::get_browser();

// set the time zone to Sri Lanka
date_default_timezone_set('Asia/Colombo');

// get the current time in Sri Lanka
$dateTime = date('Y-m-d H:i:s');

$q1 = "SELECT * FROM `visitors` WHERE `ip`='" . $ip . "' AND `browser`='" . $browser . "'";
$rs1 = $conn->query($q1);
$n1 = $rs1->num_rows;

if ($n1 >= 1) {

    $d1 = $rs1->fetch_assoc();

    $q2 = "UPDATE `visitors` SET `lastVisited_dateTime`='" . $dateTime . "',`visitedCount`='" . $d1["visitedCount"] + 1 . "' 
	WHERE `visitorId`='" . $d1["visitorId"] . "'";
    $rs2 = $conn->query($q2);
} else {

    $q3 = "INSERT INTO `visitors` (`ip`,`device`,`os`,`browser`,`firstVisited_dateTime`,`visitedCount`) 
	VALUES ('" . $ip . "','" . $device . "','" . $os . "','" . $browser . "','" . $dateTime . "','1')";
    $rs3 = $conn->query($q3);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="img/electronics-icon-2.jpg">
    <title>Remote Electric Bill</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
</head>

<body class="container-fluid align-middle" style="background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);">

    <header>
        <!-- head Logo -->
        <div class="row my-5 py-2">
            <div href="#" class="col-12 text-center">
                <img src="img/reb_logo.png" alt="" class="img-fluid" style="border-radius: 20px; opacity: 90%; width: 200px; ">
            </div>
        </div>
        <!-- head Logo -->
    </header>

    <main class="containe mb-5 pb-5">
        <div class="row">

            <div class="col-12 col-sm-12 offset-md-1 col-md-10 offset-lg-2 col-lg-8 offset-xl-3 col-xl-6 bg-light p-sm-4 p-ms-5 p-lg-5 p-xl-5 p-xxl-5 p-3" style="border-radius: 20px; opacity: 0.8;">

                <!-- Pills content -->
                <div class="tab-content pt-4">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <?php
                        if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {
                        ?>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" value="<?php echo ($_COOKIE["email"]); ?>" class="form-control" required />
                                <label class="form-label" for="loginName">Email or username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="pwd" value="<?php echo ($_COOKIE["password"]); ?>" class="form-control" required />
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control" required />
                                <label class="form-label" for="loginName">Email or username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="pwd" class="form-control" required />
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- 2 column grid layout -->
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-3 mb-md-0">
                                    <input class="form-check-input" type="checkbox" value="" id="chbox" checked />
                                    <label class="form-check-label" for="loginCheck"> Remember me </label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Simple link -->
                                <a href="#!">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="col mx-5">
                            <button onclick="login();" class="btn btn-primary btn-block mb-4">Log in</button>
                        </div>

                    </div>

                </div>
                <!-- Pills content -->

            </div>

        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script src="js/login.js"></script>
</body>

</html>