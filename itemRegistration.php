<?php
// Function to safely handle user input (prevent SQL injection)
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
    $item_code = sanitize_input($_POST["item_code"]);
    $item_name = sanitize_input($_POST["item_name"]);
    $item_category = sanitize_input($_POST["item_category"]);
    $item_subcategory = sanitize_input($_POST["item_subcategory"]);
    $quantity = sanitize_input($_POST["quantity"]);
    $unit_price = sanitize_input($_POST["unit_price"]);


    // Prepare and execute the SQL query for data insertion
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";

    if ($conn->query($sql) === TRUE) {
        $response = "Item data inserted successfully.";
    } else {
        $response = "Error: " . $sql . "<br>" . $conn->error;
    }

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


    <script type="text/javascript">

function validateForm() {
    // Get form elements
    var title = document.formcustomer.item_code.value;
    var firstName = document.formcustomer.item_name.value;
    var middleName = document.formcustomer.item_category.value;
    var lastName = document.formcustomer.item_subcategory.value;
    var contactNumber = document.formcustomer.quantity.value;
    var district = document.formcustomer.unitprice.value;
  
    // Check if required fields are not empty
    if (title =='' || firstName =='' || lastName == '' || contactNumber == '' || district =='') {
      alert('Please fill in all the required fields.');
    return false;
    }
  
    // Additional validation for contact number (you can modify this as needed)
  
  }
    </script>
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
                    <li class="nav-item"><a class="nav-link active" href="itemRegistration.php"><i class="fas fa-table"></i><span>Item Registration</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="invoiceReport.php"><i class="fas fa-table"></i><span>Invoice Report</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="invoiceItemReport.php"><i class="fas fa-table"></i><span>Invoice Item Report</span></a></li>
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
                    <h3 class="text-dark mb-4">Item Registration</h3>
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
                                            <p class="text-primary m-0 fw-bold">Item Details</p>
                                        </div>
                                        <div class="card-body">
                                            <form name="formcustomer" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="Item Code"><strong>Item Code</strong></label><input class="form-control" type="text" id="code" placeholder="Item code" name="item_code" required></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="Item Name"><strong>Item Nmae</strong></label><input class="form-control" type="text" id="name" placeholder="Item Name" name="item_name" required></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                         <div class="mb-3"><label class="form-label" for="Title"><strong>Item Category</strong></label><select class="form-control" type="text" id="category" placeholder="Item category" name="item_category" required>
                                                            <option value="0">Select category:</option>
                                                            <option value="1">Printers</option>
                                                            <option value="2">Laptops</option>
                                                            <option value="3">Gadgets</option>
                                                            <option value="4">Ink bottels</option>
                                                            <option value="5">Cartridges</option>
                                                        </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="Title"><strong>Item Sub Category</strong></label><select class="form-control" type="text" id="subcategory" placeholder="Item sub category" name="item_subcategory" required>
                                                            <option value="0">select sub category:</option>
                                                            <option value="1">HP</option>
                                                            <option value="2">Dell</option>
                                                            <option value="3">Lenovo</option>
                                                            <option value="4">Acer</option>
                                                            <option value="5">Samsung</option>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="quantity"><strong>Quantity</strong></label><input class="form-control" type="text" id="quantity" placeholder="quantity" name="quantity"  required></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="price"><strong>Unit Price</strong></label><input class="form-control" type="text" id="price" placeholder="Unit Price" name="unit_price" required></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Submit</button></div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
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