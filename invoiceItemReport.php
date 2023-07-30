<?php

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace these values with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "customer";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and retrieve form data
    $start_date = sanitize_input($_POST["start_date"]);
    $end_date = sanitize_input($_POST["end_date"]);


    $sql = "SELECT `invoice`.`invoice_no`, `invoice`.`date`, `customer`.`first_name`, `invoice_master`.`item_id`, `item`.`item_name`, `item`.`item_code`, `item`.`item_category`, `item`.`unit_price`
    FROM `invoice` 
        LEFT JOIN `customer` ON `invoice`.`customer` = `customer`.`id` 
        LEFT JOIN `invoice_master` ON `invoice_master`.`invoice_no` = `invoice`.`invoice_no` 
        LEFT JOIN `item` ON `invoice_master`.`item_id` = `item`.`id` WHERE `invoice`.`date` BETWEEN '$start_date' AND '$end_date' ";

     $result = $conn->query($sql);

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>E-MART</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>E-MART</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="customerReg.php"><i class="fas fa-user"></i><span>Customer Registration</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="itemRegistration.php"><i class="fas fa-table"></i><span>Item Registration</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="invoiceReport.php"><i class="fas fa-table"></i><span>Invoice Report</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="invoiceItemReport.php"><i class="fas fa-table"></i><span>Invoice Item Report</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="itemReport.php"><i class="fas fa-table"></i><span>Item Report</span></a></li>
    
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            
                            <li class="nav-item dropdown no-arrow mx-1">
                           
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">John Doe</span></a>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

    
                <div class="container-fluid">
                <?php
    // Display the response message if available
    if (isset($response)) {
        echo "<p style='color:green;'>$response</p>";
    }
    ?>
                    <h3 class="text-dark mb-4">Invoice Item Report</h3>
                    <div class="row mb-3">
                        
                        <div class="col-lg-8" style="width:100%">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card textwhite bg-primary text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card textwhite bg-success text-white shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">Search by date range</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="Start Date"><strong>Start Date</strong></label><input class="form-control" type="date" id="sdate" placeholder="Start Date" name="start_date"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="End Date"><strong>End Data</strong></label><input class="form-control" type="date" id="edate" placeholder="End Date" name="end_date"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Search</button></div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php
    // Display the search results if available
    if (isset($result) && $result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<table class='table'>";
        echo "<tr><th scope='col'>Invoice Number</th><th scope='col'>Date</th><th scope='col'>Customer Name</th><th scope='col'>Item Name/Code</th><th scope='col'>Item Category</th><th scope='col'>Item Unit Price</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["invoice_no"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["item_name"] . " " . $row["item_code"] . "</td>";
            echo "<td>" . $row["item_category"] . "</td>";
            echo "<td>" . $row["unit_price"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No results found yet.";
    }
    ?>


                        </div>
                    </div>
                
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/Lightbox-Gallery.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>