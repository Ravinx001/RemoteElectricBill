<?php

require_once("processes/db.php");

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="img/electronics-icon-2.jpg">
    <title>Utilities</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="text-white" style="background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);">

    <?php require 'includes/header.php' ?>

    <main class="container-fluid">

        <div class="content mt-5">

            <div class="container-fluid">

                <div class="row mt-3 mb-2">
                    <div class="col p-1 rounded-4 text-center bg-dark bg-opacity-75">
                        <h2 class="pf text-info" style="text-shadow: 5px 5px 5px rgba(82, 75, 75, 0.651);">
                            Meter Readings </h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col bg-dark bg-opacity-75 rounded-3 p-2">
                        <div class="table-responsive" style="overflow-y: scroll; max-height: 350px;">

                            <table class="table table-dark table-striped">

                                <thead>
                                    <tr>
                                        <th scope="col">Reading Id</th>
                                        <th scope="col">User Id</th>
                                        <th scope="col">Date Time</th>
                                        <th scope="col">Usage</th>

                                    </tr>
                                </thead>

                                <tbody id="readings">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="content mt-5">

            <div class="container-fluid">

                <div class="row mt-3 mb-2">
                    <div class="col p-1 rounded-4 text-center bg-dark bg-opacity-75">
                        <h2 class="pf text-info" style="text-shadow: 5px 5px 5px rgba(82, 75, 75, 0.651);">
                            Wfi Details </h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col bg-dark bg-opacity-75 rounded-3 p-2">
                        <div class="table-responsive" style="overflow-y: scroll; max-height: 350px;">

                            <table class="table table-dark table-striped">

                                <thead>
                                    <tr>
                                        <th scope="col">User Id</th>
                                        <th scope="col">Wi-Fi Name</th>
                                        <th scope="col">Wi-Fi Password</th>

                                    </tr>
                                </thead>

                                <tbody id="wifi">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php

        if ($_SESSION["user"]["email"] == "rav.normal@gmail.com") {

        ?>

            <div class="content mt-5">

                <div class="container-fluid">

                    <div class="row mt-3 mb-2">
                        <div class="col p-1 rounded-4 text-center bg-dark bg-opacity-75">
                            <h2 class="pf text-info" style="text-shadow: 5px 5px 5px rgba(82, 75, 75, 0.651);">
                                Visitors </h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col bg-dark bg-opacity-75 rounded-3 p-2">
                            <div class="table-responsive" style="overflow-y: scroll; max-height: 350px;">

                                <table class="table table-dark table-striped">

                                    <thead>
                                        <tr>
                                            <th scope="col">Visitor Id</th>
                                            <th scope="col">IP Address</th>
                                            <th scope="col">Device</th>
                                            <th scope="col">OS</th>
                                            <th scope="col">Browser</th>
                                            <th scope="col">First Visited Date & Time</th>
                                            <th scope="col">Last Visited Date & Time</th>
                                            <th scope="col">Total Visits</th>
                                        </tr>
                                    </thead>

                                    <tbody id="visitors">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        <?php
        }

        ?>

    </main>

    <script src="js/utilities.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <?php
    if ($_SESSION["user"]["email"] == "rav.normal@gmail.com") {
    ?>
        <script>
            visitors();
            setInterval(visitors, 5000);
        </script>

    <?php
    }
    ?>

</body>

</html>