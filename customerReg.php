<?php

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $title = $_POST["username"];
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $contactNumber = $_POST["contact_no"];
    $district = $_POST["district"];

    // Validate and sanitize the data 
    $title = htmlspecialchars($title);
    $firstName = htmlspecialchars($firstName);
    $middleName = htmlspecialchars($middleName);
    $lastName = htmlspecialchars($lastName);
    $contactNumber = htmlspecialchars($contactNumber);
    $district = htmlspecialchars($district);


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

    // SQL query to insert data 
    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district)
            VALUES ('$title', '$firstName', '$middleName', '$lastName', '$contactNumber', '$district')";

if ($conn->query($sql) === TRUE) {
    $response = "Customer data inserted successfully.";
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
    <title>E-Mart</title>
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
    var title = document.formcustomer.username.value;
    var firstName = document.formcustomer.first_name.value;
    var middleName = document.formcustomer.middle_name.value;
    var lastName = document.formcustomer.last_name.value;
    var contactNumber = document.formcustomer.contact_no.value;
    var district = document.formcustomer.district.value;
  
    // Check if required fields are not empty
    if (title =='' || firstName =='' || lastName == '' || contactNumber == '' || district =='') {
      alert('Please fill in all the required fields.');
    return false;
    }
  
    // Additional validation for contact number (you can modify this as needed)
    var contactRegex = /^\d{10}$/;
    if (!contactRegex.test(contactNumber)) {
      alert('Please enter a valid 10-digit contact number.');
      return false;

    }
  
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
                    <li class="nav-item"><a class="nav-link active" href="customerReg.php"><i class="fas fa-user"></i><span>Customer Registration</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="itemRegistration.php"><i class="fas fa-table"></i><span>Item Registration</span></a></li>
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
                    <h3 class="text-dark mb-4">Customer Registration</h3>
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
                                            <p class="text-primary m-0 fw-bold">Customer Details</p>
                                        </div>
                                        <div class="card-body">
                                            <form name="formcustomer"   method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="Title"><strong>Title</strong></label><select  class="form-control" type="text" required id="username" placeholder="Title" name="username" required>
                                                            <option value="0">Select title:</option>
                                                            <option value="Mr">Mr</option>
                                                            <option value="Mrs">Mrs</option>
                                                            <option value="Miss">Miss</option>
                                                            <option value="Dr">Dr</option>
                                                        </select></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="First Name"><strong>First Nmae</strong></label><input  class="form-control" type="text" id="email" placeholder="First Name" name="first_name" required></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="Middle Name"><strong>Middle Name</strong></label><input class="form-control" type="text" id="middle_name" placeholder="Middle Name" name="middle_name" required></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name" placeholder="last Name" name="last_name" required></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="contact number"><strong>Contact Number</strong></label><input class="form-control" type="text" id="username" placeholder="contact number" name="contact_no" required></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="district"><strong>District</sttrong></label><select class="form-control" type="text" required id="email" placeholder="district" name="district" required>
                                                            <option value="0">Select District:</option>
                                                            <option value="1">Ampara</option>
                                                            <option value="2">Anuradhapura</option>
                                                            <option value="3">Badulla</option>
                                                            <option value="4">Batticoloa</option>
                                                            <option value="5">Colombo</option>
                                                            <option value="6">Galle</option>
                                                            <option value="7">Gampaha</option>
                                                            <option value="8">Hambanthota</option>
                                                            <option value="9">Jaffna</option>
                                                            <option value="10">Kalutara</option>
                                                            <option value="11">Kalutara</option>
                                                            <option value="12">Kandy</option>
                                                            <option value="13">Kagalle</option>
                                                            <option value="14">Kilinochchi</option>
                                                            <option value="15">Kurunagala</option>
                                                            <option value="16">Mannar</option>
                                                            <option value="17">Matale</option>
                                                            <option value="18">Matara</option>
                                                            <option value="19">Monaragala</option>
                                                            <option value="20">Mullative</option>
                                                            <option value="21">Nuware Eliya</option>
                                                            <option value="22">Polonnaruwa</option>
                                                            <option value="23">Puttalam</option>
                                                            <option value="24">Rathnapura</option>
                                                            <option value="25">Vavniya</option>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button  class="btn btn-primary btn-sm" type="submit" onclick="validateForm()" >Submit</button></div>
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