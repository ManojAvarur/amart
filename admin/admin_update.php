<?php 
session_start(); 

if (isset( $_SESSION['ADID']) && isset( $_SESSION['prd'] ) )  {

    if(!isset($_SESSION['ADBASICINFO'])) {

        setBasicInfo($_SESSION['ADID'], false);

    }

    require "../_headers/connection.php";
    require "../_headers/functions.php";
    global $con;

    if( isset( $_POST['submit'] ) ){
        $pname = mysqli_escape_string($con, $_POST['pname']);
        $cat = mysqli_escape_string($con, $_POST['category']);
        $price = mysqli_escape_string($con, $_POST['price']);
        $offers = mysqli_escape_string($con, $_POST['offers']);
        $des = mysqli_escape_string($con, $_POST['des']);
        $pid =  mysqli_escape_string($con, $_POST['pid']);

        $sql = "UPDATE product SET ";
        $sql .= "PRD_CAT_ID = " . $cat . ", ";
        $sql .= "PRD_NAME = '" . $pname . "', ";
        $sql .= "PRD_DETAILS = '" . $des . "', ";
        $sql .= "PRD_OFFERS = '" . $offers . "', ";
        $sql .= "PRD_PRICE = " . $price . " ";
        $sql .= "WHERE PRD_ID = '" . $pid . "'; ";

        // die($sql."");
        if( ! mysqli_query( $con, $sql ) ){
            echo "<script> 
                    alert('Updation failed. \\n Please try again!');
                    window.history.go(-1);
                </script>";
        } else {

            // print_r( $_FILES['file'] );
            // die();
            if( $_FILES['file']['size'] > 0 ){

                $files = $_FILES['file'];

                // for( $i = 0 ; $i < count( $files['name'] ) ; $i++ ){

                    if( ( $files['error'] > 0 ) || ( ! in_array( $files['type'] , ["image/jpeg", "image/png", "image/jfif"] ) ) ) {
                        
                        echo "<script>
                                        alert('An error ocurred when uploading or File type not supported');
                                        window.history.go(-1);
                            </script>";

                        // die( mysqli_error( $con ) );   
                    }
        
                // }

                // for( $i = 0 ; $i < count( $files['name'] ) ; $i++ ){

                    // die("../".$_SESSION['prd'][0][6] );
                    if( file_exists( "../".$_SESSION['prd'][0][6] ) ){
                        unlink( "../".$_SESSION['prd'][0][6] );
                    }

                    if( ! move_uploaded_file( $files['tmp_name'], "../".$_SESSION['prd'][0][6] ) ) {

                        echo "<script>
                                        alert('An error ocurred while moving the file please try uploading again!   ');
                                        window.history.go(-1);
                            </script>";

                    }

                    

                    // header('location:admin_index.php');

                    
                    
                // }

            }

            unset( $_SESSION['prd'] );


            echo "<script> 
                    alert('Updation successfull!');
                    if( window.history.replaceState ){
                        window.history.replaceState( null, null, location.href='admin_index.php' );
                    }
                </script>";

        }
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amart Admin Electronics</title>
    <meta content="Amart, amart sales, amart india" name="description">
    <meta content="Amart, India, Sales, Refrigerator Sales, TV Sales, Hardware Sales" name="keywords">
    <link href="../assets/img/a.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="../index.php">Amart<span style="font-size: medium;">ADMIN</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li><a href="admin_add.php">Add Product</a></li>
                    <li><a href="product_id_enter.php?location=delete">Delete Product</a></li>
                    <li><a href="product_id_enter.php?location=update">Update Product</a></li>
                    <li><a href="admin_check.php">Check Products</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                        <li><a href="admin_add.php">Add Product</a></li>
                        <li><a href="product_id_enter.php?location=delete">Delete Product</a></li>
                        <li><a href="product_id_enter.php?location=update">Update Product</a></li>
                        <li><a href="admin_check.php">Check Products</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="dropdown login-btn">
                <p style="margin-bottom: 0px;"> <?php echo $_SESSION['ADBASICINFO']['AD_FIRSTNAME'] ?> </p>
                <div class="dropdown-content">
                    <a href="admin_index.php">Home</a>
                    <a href="admin_details.php">My Account</a>
                    <a href="../_headers/logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </header>


    <section id="ad_home1" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div>
                    <h1>Update Products<span>.</span></h1>
                </div>
            </div>
        </div>
    </section>


    <section class="products">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $_SESSION['prd'][0][7] ?></h2>
                <p>Update products</p>
            </div>
            <form style="margin-top: -2%; margin-bottom: 4%;" action="admin_update.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label><b>Product Name</b></label>
                    <input type="text" name="pname" value="<?php echo $_SESSION['prd'][0][2] ?>" style="width: 40%;" class="form-control" id="productName" placeholder="Enter Product Name" required>
                </div>

                <div class="form-group">
                    <label><b>Product Type</b></label>
                    <select id="productType" name="category" style="width: 40%;" class="form-control" required>
                      <option selected value="<?php echo $_SESSION['prd'][0][0] ?>"><?php echo $_SESSION['prd'][0][7] ?></option>
                        <?php
                                echoCategories(1, $_SESSION['prd'][0][0])
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><b>Product ID</b></label>
                    <input type="text" name="pid" value="<?php echo $_SESSION['prd'][0][1] ?>" style="width: 40%;" class="form-control" id="productID" placeholder="Enter Product ID" readonly required>
                </div>
                <div class="form-group">
                    <label><b>Product Price</b></label>
                    <input type="number" name="price" value="<?php echo $_SESSION['prd'][0][5] ?>" style="width: 40%;" class="form-control" id="productPrice" placeholder="Enter Product Price" required>
                </div>
                <div class="form-group">
                    <label><b>Product Offers</b></label>
                    <input type="text" name="offers" value="<?php echo $_SESSION['prd'][0][4] ?>" style="width: 40%;" class="form-control" id="productOffers" placeholder="Enter Product Offers" required>
                </div>
                <div class="form-group">
                    <label><b>Product Description</b></label>
                    <textarea class="form-control" name="des" style="width: 80%;" id="productDescription" placeholder="Enter Product Description" rows="3" required> <?php echo $_SESSION['prd'][0][3] ?> </textarea>
                </div>
                <div class="form-group">
                    <label><b>Upload Product Image</b></label>
                    <input type="file" name="file" style="width: 40%;" class="form-control-file" id="productImage" width="50" height="50">
                </div>
                <button type="submit" name="submit" class="btn btn-primary admin_but">Update Product</button>
            </form>
        </div>
    </section>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Services</h4>
                        <ul>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Return Policy</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Security</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Term of Use</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>About</h4>
                        <ul>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Company</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Team</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Contact Us</h4>
                        <ul>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Email: amart@example.com</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Phone Number: +91 9800102010</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
    <div id="preloader"></div>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/venobox/venobox.min.js"></script>
    <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="../assets/vendor/counterup/counterup.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>

<?php

} else {

    header('location:admin_login.php');

}

?>