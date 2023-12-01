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
    <title>Bills</title>

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
                            Calculating Bill </h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col bg-dark bg-opacity-75 rounded-3 p-2">
                        <div class="table-responsive" style="overflow-y: scroll; max-height: 350px;">

                            <table class="table table-dark table-striped">

                                <thead>
                                    <tr>
                                        <th scope="col">User Id</th>
                                        <th scope="col">Corresponding Date Time</th>
                                        <th scope="col">Corresponding Meter Reading</th>
                                        <th scope="col">Corresponding Tax</th>
                                        <th scope="col">Corresponding Total Cost</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr scope="row">
                                        <td><?php echo $_SESSION["user"]["userId"]; ?></td>
                                        <td id="dateTime"></td>
                                        <td><span id="reading"></span> kWh</td>
                                        <td>Rs. <span id="tax"></span></td>
                                        <td style="font-weight: bold;" >Rs. <span id="total"></span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <script src="js/bill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>


</body>

</html>