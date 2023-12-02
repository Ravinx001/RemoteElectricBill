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

        <div class="content mt-4">

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
                                        <td style="font-weight: bold;">Rs. <span id="total"></span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content mt-3 mb-5">

                <div class="container text-dark">

                    <div class="row">
                        <div class="col p-1 rounded-top mt-2 text-center bg-light border-bottom border-5">

                            <div class="row p-0">
                                <div class="col text-center">
                                    <h1 style="text-shadow: 5px 5px 5px rgba(82, 75, 75, 0.651);">
                                        ELECTRICITY BILL
                                    </h1>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col bg-light rounded-bottom p-3">

                            <div class="row mx-1">

                                <div class="col-sm-12 col-md-6 border-bottom border-3">

                                    <h2>Address :</h2>
                                    <h6>No: <br>
                                        354,Colombo Road, <br>
                                        Gampaha, <br>
                                        11000, <br>
                                        Sri Lanka.</h6>
                                    <h5>VAT No : <small>XXXXXXXXXXXX</small></h5>
                                </div>

                            </div>

                            <div class="row mx-1 border-bottom border-3 my-1">

                                <div class="col-sm-12 col-md-6">
                                    <h4>Payment Method : <span class="fs-5 text-secondary">Credit Card</span></h4>
                                    <h4>Order Number : <span class="fs-5 text-secondary">#165327</span></h4>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <h4>Invoice Number : <span class="fs-5 text-secondary">#23726</span></h4>
                                    <h4>Issued Date : <span class="fs-5 text-secondary" id="bill_dateTime" ></span></h4>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <div class="table-responsive">

                                        <table class="table table-striped">

                                            <thead>
                                                <tr>

                                                    <th scope="col" class="bg-primary bg-opacity-50 rounded border border-3">ID</th>
                                                    <th scope="col" class="bg-primary bg-opacity-50 rounded border border-3">Details</th>
                                                    <th scope="col" class="bg-primary bg-opacity-50 rounded border border-3">Units for the month</th>
                                                    <th scope="col" class="bg-primary bg-opacity-50 rounded border border-3">Tax Percentage</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr scope="row">
                                                    <td>002</td>

                                                    <td>
                                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae
                                                        <small class="d-block text-muted">
                                                            <details>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat unde non
                                                                voluptate magnam repudiandae necessitatibus tenetur mollitia adipisci ut
                                                                fugiat possimus recusandae eos quos totam ipsa, alias commodi rem illum./details>
                                                        </small>
                                                    </td>

                                                    <td>
                                                        <span id="bill_reading"></span> kWh
                                                    </td>

                                                    <td><span id="bill_taxPercentage" ></span> %</td>


                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-end">
                                <div class="col-sm-12 col-md-4 col-lg-7 text-start">
                                    <h4>Notes :-</h4>

                                    <h6 class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Quaerat voluptate eius ipsum consectetur cumque incidunt at quasi culpa.</h6>

                                </div>

                                <div class="col-sm-12 col-md-8 col-lg-5 text-end d-flex justify-content-end">

                                    <div class="table-responsive">
                                        <table class="table">

                                            <tbody class="table">
                                                <tr>
                                                    <th scope="row">Corresponding Tax :</th>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td>Rs. <span id="bill_tax"></span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Discount :</th>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td>0%</td>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="row text-end mx-1 mt-1">

                                <div class="bg-success bg-opacity-50 offset-sm-5 col-sm-7 offset-md-7 col-md-5 offset-lg-8 col-lg-4 offset-xl-9 col-xl-3 offset-xxl-9 col-xxl-3 text-end" style="border: double;">

                                    <h5><strong class="pe-5">Total : </strong> <strong>Rs. <span id="bill_total"></span></strong></h5>

                                </div>

                            </div>

                            <div class="row text-center pt-4 pb-2 mx-1 mt-3 border-top border-3 border-secondary border-opacity-75">
                                <div class="col-12 text-center">
                                    <h5><i class="bi bi-telephone-fill"></i> Hotline - +94 782 883 947 / +94 332 220 919
                                    </h5>
                                </div>
                            </div>

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