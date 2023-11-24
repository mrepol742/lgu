<?php
include("../../include/session.php");

$page_publisher = "https://facebook.com/melvinjonesrepol";
$page_modified_time = "2023-10-08T13:37:36+00:00";
$page_title = "Digital Barangay - A LGU Management System";
$page_description = "";
$page_keywords = "digital barangay, lgu, lgu management system";
$page_image = "http://localhost/lgu-ms/images/ogimage.png";
$page_author = "Melvin Jones Repol";
$page_canonical = "http://localhost/lgu-ms/public-market-and-vendors-management-module/";
$page_url = $page_canonical;
$directory = "../";
$directory_img = "../";
$isForm = false;

include("../include/header.php");
echo '<link rel="stylesheet" href="../css/public-market-module.css">';

?>

<body class="d-flex flex-column min-vh-100 ">
    <?php include("../../include/nav.php"); ?>

    <header>
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h4 style="color: #4285f4;">Digital Barangay</h4>
                        <h1 class="fw-bold">Users</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="text-center">
        <div class="container">
            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Register for Market</h1>
                    <p class="col-lg-10 fs-5">A Public Market and Vendor Module streamlines market operations, enhances vendor-customer interactions, boosts sales, and provides valuable data for market administrators. It can be tailored to fit the specific needs of different markets, whether physical or online, promoting local businesses and fostering community engagement.</p>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 bg-body-auto" id="register1">
                        <h3>Vendor</h3>
                        <div class="input-group2">
                            <input id="fname" type="text" placeholder="First Name" name="fname" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-group2">
                            <input id="lname" type="text" placeholder="Last Name" name="lname" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-group2">
                            <input id="email" type="email" placeholder="Email" name="email" required>
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="input-group2">
                            <input id="contact" type="text" placeholder="Contact No." name="contact" required>
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="#form" class="btn btn-primary shadow px-4" id="reduced">Proceed</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- FORM -->
    <div class="col-md-10 mx-auto col-lg-10" id="form">
        <div class="row">
            <div class="center">
                <h4>Note: You can have multiple stalls and product.</h4>
            </div>
            <div class="col-md-6">
                <!-- Content for the first column goes here -->
                <form class="p-4 p-md-5 bg-body-auto" id="reg-stall">
                    <h3>Stall</h3>
                    <div class="input-group2">
                        <input id="stall-name" type="text" placeholder="Stall Name" name="stall-name" required>
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="input-group2">
                        <input id="location" type="text" placeholder="Location" name="location" required>
                        <i class="fa fa-location-dot"></i>
                    </div>
                    <div class="input-group2">
                        <input id="stall-desc" type="text" placeholder="Description" name="stall-desc" required>
                        <i class="fa fa-file-lines"></i>
                    </div>
                    <div class="input-group2">
                        <input id="stall-cat" type="text" placeholder="Category" name="stall-cat" required>
                        <i class="fa fa-store"></i>
                    </div>
                    <div class="center">
                        <button id="add-stall" class="btn btn-primary px-5 shadow">Add Stall</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <!-- Content for the second column goes here -->
                <form class="p-4 p-md-5 bg-body-auto" id="regProd">
                    <h3>Product</h3>
                    <div class="input-group2">
                        <input id="product-name" type="text" placeholder="Product Name" name="product-name" required>
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="input-group2">
                        <input id="product-desc" type="text" placeholder="Description" name="product-desc" required>
                        <i class="fa fa-file-lines"></i>
                    </div>
                    <div class="input-group2">
                        <input id="price" type="text" placeholder="Price" name="Price" required>
                        <i class="fa fa-dollar-sign"></i>
                    </div>
                    <div class="input-group2">
                        <input id="product-cat" type="text" placeholder="Category" name="product-cat" required>
                        <i class="fa fa-store"></i>
                    </div>
                    <div class="center">
                        <button id="add-product" class="btn btn-primary px-5 shadow">Add Product</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="center">
            <button id="register" class="btn btn-primary px-5 shadow mx-auto my-auto">Register</button>
        </div>

    </div>

    <!-- FORM -->
    <div class="center">
        <a href="index.php" class="active text-center">Return to main page.</a>
    </div>
    <?php include("../../include/footer.php"); ?>

</body>

</html>