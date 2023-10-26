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
    <title>Remote Electric Bill</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="text-white" style="background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);">

    <?php require 'includes/header.php' ?>

    <main class="container-fluid">

        <div class="row my-3 justify-content-center">

            <div class="col-md-12 ">
                <div class="row ">

                    <div class="col-xl-3 col-lg-6">

                        <div class="cardx l-bg-cherry">

                            <div class="cardx-statistic-3 p-4">

                                <div class="mb-4">
                                    <h5 class="cardx-title mb-0">Yesterday Power Usage <i class="bi bi-battery-charging ms-3 position-absolute opacity-25" style="font-size: 50px;"></i></h5>
                                </div>

                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <span class="me-5">150 kWh</span><span class="mt-3 fs-6">12.5% <i class="bi bi-arrow-up"></i></span>
                                        </h2>
                                    </div>
                                </div>

                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-6">

                        <div class="cardx l-bg-blue-dark">

                            <div class="cardx-statistic-3 p-4">

                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Cost for Yesterday<i class="bi bi-currency-dollar ms-2 position-absolute opacity-25" style="font-size: 50px;"></i></h5>
                                </div>

                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <span class="me-5">Rs 200.00</span><span class="mt-3 fs-6">9.23% <i class="bi bi-arrow-up"></i></span>
                                        </h2>
                                    </div>
                                </div>

                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-6">

                        <div class="cardx l-bg-green-dark">

                            <div class="cardx-statistic-3 p-4">

                                <div class="mb-4">
                                    <h5 class="cardx-title mb-0">Last Month Power Usage
                                        <i class="bi bi-view-list ms-3 position-absolute opacity-25" style="font-size: 50px;"></i>
                                    </h5>
                                </div>

                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <span class="me-5">180 kWh</span><span class="mt-3 fs-6">10.1% <i class="bi bi-arrow-up"></i></span>
                                        </h2>
                                    </div>
                                </div>

                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-lg-6">

                        <div class="cardx l-bg-orange-dark">

                            <div class="cardx-statistic-3 p-4">

                                <div class="mb-4">
                                    <h5 class="cardx-title mb-0">Last Month Cost<i class="bi bi-currency-dollar ms-2 position-absolute opacity-25" style="font-size: 50px;"></i></h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <span class="me-5">Rs. 4500.00</span><span class="mt-3 fs-6">3.11% <i class="bi bi-arrow-up"></i></span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row justify-content-center mx-md-5">

            <div class="col">

                <div class="row">

                    <div class="col-xl-6 col-md-12">

                        <div class="card text-white card-bg border border-info border-2 m-1">

                            <div class="card-body">

                                <div class="row text-start">

                                    <div class="col-1">

                                        <i class="fa-solid fa-plug text-info fs-1"></i>

                                    </div>

                                    <div class="col-5">
                                        <h4>Voltage</h4>
                                        <h6 class="ms-1" style="line-height: 10%;">Every 1min</h6>
                                    </div>

                                    <div class="col-6 text-end pf">
                                        <h1><span>230.0</span> V</h1>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-6 col-md-12">

                        <div class="card text-white card-bg border border-info border-2 m-1">

                            <div class="card-body">

                                <div class="row text-start">

                                    <div class="col-1">

                                        <i class="fa-solid fa-plug-circle-bolt text-info fs-1"></i>

                                    </div>

                                    <div class="col-5">
                                        <h4>Current</h4>
                                        <h6 class="ms-1" style="line-height: 10%;">Every 1min</h6>
                                    </div>

                                    <div class="col-6 text-end pf">
                                        <h1><span>0.91</span> A</h1>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-6 col-md-12">

                        <div class="card text-white card-bg border border-info border-2 m-1">

                            <div class="card-body">

                                <div class="row text-start">

                                    <div class="col-1">

                                        <i class="fa-solid fa-power-off text-info fs-1"></i>

                                    </div>

                                    <div class="col-6">
                                        <h4>Power Using</h4>
                                        <h6 class="ms-1" style="line-height: 10%;">Every 1min</h6>
                                    </div>

                                    <div class="col-5 text-end pf">
                                        <h1><span>0.002</span> kW</h1>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="col-xl-6 col-md-12">

                        <div class="card text-white card-bg border border-info border-2 m-1">

                            <div class="card-body">

                                <div class="row text-start">

                                    <div class="col-1 p-1">

                                        <i class="fa-brands fa-audible text-info fs-1"></i>

                                    </div>

                                    <div class="col-7">
                                        <h4>Meter Reading</h4>
                                        <h6 class="ms-1" style="line-height: 10%;">Every 1min</h6>
                                    </div>

                                    <div class="col-4 text-end pf">
                                        <h1><span>0.012</span> kWh</h1>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row my-5 justify-content-center">

            <div class="col-10 col-md-8 rounded-4 border border-info" style="background-color: rgba(23, 51, 54, 0.397);">
                <div>
                    <canvas id="myChart"></canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    const ctx = document.getElementById('myChart');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                            datasets: [{
                                label: 'Monthly Cost',
                                data: [15, 19, 20, 16, 30, 25],
                                borderWidth: 1,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],

                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/6ba34a4059.js" crossorigin="anonymous"></script>

    <script src="script.admin.js"></script>

</body>

</html>