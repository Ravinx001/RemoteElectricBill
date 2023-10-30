<header>

    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand Anton fs-4 text-info border border-4 border-info rounded p-1" href="#">
                <span class="mx-1"><img src="img/icons8-engineering-50.png" alt="" class="img-fluid rotating-element" style="height: 30px;"> Remote Electricity Bill</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ms-2 fs-5 tillium" id="navbarNavDropdown">
                <ul class="navbar-nav d-flex">
                    <li class="nav-item px-2 y">
                        <a class="nav-link active" aria-current="page" href="home.php"><i class="bi bi-window-fullscreen"></i> Dashborad</a>
                    </li>
                    <li class="nav-item px-2 y">
                        <a class="nav-link" href="utilities.php"><i class="bi bi-diagram-2-fill"></i> Utilities</a>
                    </li>
                    <li class="nav-item px-2 y">
                        <a class="nav-link" href="bills.php"><i class="bi bi-currency-dollar"></i> Bills</a>
                    </li>
                    <li class="nav-item px-2 dropdown y">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="letter-spacing: 1px;">
                            <i class="bi bi-person-badge"></i> <?php echo $_SESSION["user"]["name"]; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #585858;">
                            <li>
                                <a class="dropdown-item" href="processes/destroy.php?sess=des"><i class="bi bi-door-open-fill me-1"></i>Log out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>