<?php

session_start();

if (isset($_SESSION['ADID'])) {

    if(!isset($_SESSION['ADBASICINFO'])) {

        setBasicInfo($_SESSION['ADID'], false);

    }
    
    require "../_headers/connection.php";
    require "../_headers/functions.php";

    global $con;

    if( isset( $_POST['submit'] ) ) {

        
        $pd_name = mysqli_escape_string( $con, $_POST['pname']  );

        $pd_id = mysqli_escape_string( $con, $_POST['pid']  );

        $pd_cat = mysqli_escape_string( $con, $_POST['category'] );

        $pd_price = mysqli_escape_string( $con, $_POST['price'] );

        $pd_desc = mysqli_escape_string( $con, $_POST['description'] );

        $pd_offers = mysqli_escape_string( $con, $_POST['offers'] );

        $sql  = "INSERT INTO PRODUCT ( PRD_ID, PRD_CAT_ID, PRD_NAME, PRD_DETAILS, PRD_PRICE, PRD_OFFERS )  ";
        $sql .= "VALUES ( '$pd_id', $pd_cat, '$pd_name', '$pd_desc', $pd_price, '$pd_offers' ); ";

        $DbIds = array($pd_id);
        $upLoc = array();

        // die($sql)  

        // ----------------------------------------Uploading image into image table -----------------------------------------

        if( mysqli_query( $con, $sql ) ) {            
            
                $files = $_FILES['image'];
                // die(isset($_FILES['image'])."");
            // die(mysqli_error($con)."    d");
            // Check image type

                for( $i = 0 ; $i < count( $files['name'] ) ; $i++ ){

                    // echo $_FILES['image']['name'][$i]."<br>";
                    if( ( $files['error'][$i] > 0 ) || ( ! in_array( $files['type'][$i] , ["image/jpeg", "image/png", "image/jfif"] ) ) ) {
                        
                        dataDelete($DbIds, $upLoc);
                        echo "<script>
                                        alert('An error ocurred when uploading or File type not supported');
                                        window.history.go(-1);
                            </script>";

                        // die( mysqli_error( $con ) );   
                    }
        
                }

            // Adding extension to the image

                for( $i = 0 ; $i < count( $files['name'] ) ; $i++ ){

                    if( $files['type'] === "image/jpeg" || $files['type'] === "image/jfif" )
                        $ext = "jpg";   
                    else 
                        $ext = "png";
        
                    $time = hexdec( time() );
                    $loc = "../Products/Images/". $_POST['pname'] .  "-" . $time  . "." . $ext;
            
                // Renaming the image if it exists 

                    $count = 0;
                    while( file_exists( $loc ) ){
        
                        $loc = "../Products/Images/". $_POST['pname'] .  "-" . $time  . "-". $count . "." . $ext;
                        $count++;
        
                    }

                // Moving the image
                    if( move_uploaded_file( $files['tmp_name'][$i], $loc ) ) {

                        array_push($upLoc, $loc);
                
                        $loc = substr($loc, 3);

                        $check = true;
                        // $sql  = "SELECT PRD_ID FROM PRODUCT WHERE PRD_NAME = '$pd_name' AND PRD_CAT_ID = $pd_cat ";
                        // $sql .= "AND PRD_DETAILS = '$pd_desc' AND PRD_PRICE = $pd_price AND PRD_OFFERS = '$pd_offers'; ";

                        // if( $rows = mysqli_fetch_assoc( mysqli_query( $con, $sql ) ) ) {       Obtaining PRD_ID

                            $sql  = "INSERT INTO PRD_IMAGE (IMG_PRD_ID, IMG_PATH) VALUES ";
                            $sql .= "('" . $pd_id . "', '" . mysqli_escape_string($con, $loc) . "'); ";

                            $query = mysqli_query( $con, $sql );

                            // echo( $sql ); 

                            // die(mysqli_error($con)."");

                            if( !$query ) {

                                $check = false;

                                // echo "<script> 
                                // alert(\"Some error occured during execution of the query! \\n Check with the database (AMART.PRD_IMAGE) for unknown entries\")
                                // </script>";
                                // die(mysqli_error($con));
                                dataDelete($DbIds, $upLoc);

                                 
                                die( "<script>
                                                alert('An error ocurred while uploading \\n Try again asdasdadasdasdasd');
                                                window.history.go(-1);
                                    </script>");


                            } else 

                            array_push($DbIds, $loc);
                            
                    } else {

                            // echo "<script>
                            //                 alert('An error ocurred while uploading image : ". $files['name'] ."');
                            //     </script>";
                            dataDelete($DbIds, $upLoc);

                            die( "<script>
                                            alert('An error ocurred while uploading \\n Try again ');
                                            window.history.go(-1);
                                </script>");


                    }
                }

                
                echo "<script>
                            alert( 'Product inserted successfully!!' );
                            if( window.history.replaceState ){
                                window.history.replaceState( null, null, window.reload );
                            }
                    </script>";

        } else {

            if("Duplicate entry '".$pd_id."' for key 'PRIMARY'" === mysqli_error( $con )){
                echo "<script> alert('Product Id : \'$pd_id\' already exists! \\n Try again by inserting new product id');
                        window.history.go(-1);
                </script>";
            } else {
                echo" <script> alert('".mysqli_error( $con )."'); </script>";
            }
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
            <h1 class="logo"><a href="admin_after_login.html">Amart<span style="font-size: medium;">ADMIN</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li><a href="admin_add.php">Add Product</a></li>
                    <li><a href="admin_delete.html">Delete Product</a></li>
                    <li><a href="admin_update.html">Update Product</a></li>
                    <li><a href="admin_all.html">Check Products</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                            <li class="active"><a href="index.html">Home</a></li>
                            <li class="drop-down"><a>Shop by Category</a>
                                <ul>
                                    <li><a href="admin_add.php">Add Product</a></li>
                                    <li><a href="admin_delete.html">Delete Product</a></li>
                                    <li><a href="admin_update.html">Update Product</a></li>
                                    <li><a href="admin_all.html">Check Products</a></li>
                                </ul>
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

    <section id="ad_home" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div>
                    <h1>Add Products<span>.</span></h1>
                </div>
            </div>
        </div>
    </section>


    <section class="products">
        <div class="container">
            <div class="section-title">
                <p>Add products</p>
            </div>

            <form method="post" enctype="multipart/form-data" style="margin-top: -2%; margin-bottom: 4%;" onsubmit="return checkCategory(this)">

                <div class="form-group">
                    <label><b>Product Name</b></label>
                    <input type="text" name="pname" style="width: 40%;" class="form-control" id="productName" placeholder="Enter Product Name" required>
                </div>

                <div class="form-group">
                    <label><b>Product Type</b></label>
                    <select id="productType" name="category" style="width: 40%;" class="form-control" required>
                      <option selected value="0">Please Select</option>
                <?php
                        echoCategories()
                ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><b>Product ID</b></label>
                    <input type="text" name="pid" style="width: 40%;" class="form-control" id="productID" placeholder="Enter Product ID" required>
                </div>

                <div class="form-group">
                    <label><b>Product Price</b></label>
                    <input type="number" name="price" style="width: 40%;" class="form-control" id="productPrice" placeholder="Enter Product Price" required>
                </div>

                <div class="form-group">
                    <label><b>Product Offers</b></label>
                    <input type="text" name="offers" style="width: 40%;" class="form-control" id="productOffers" placeholder="Enter Product Offers" required>
                </div>

                <div class="form-group">
                    <label><b>Product Description</b></label>
                    <textarea class="form-control" name="description" style="width: 80%;" id="productDescription" placeholder="Enter Product Description" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label><b>Upload Product Image</b></label>
                    <input type="file" name="image[]" style="width: 40%;" class="form-control-file" id="productImage" width="50" height="50" multiple required>
                </div>

                <button type="submit" name = "submit" class="btn btn-primary admin_but">Add Product</button>
                
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
    <script type="text/javascript">
        $(function () { document.getElementById("productID").value = ""; } );

        function checkCategory(form){
            var cat = form.category.value;
            if(cat == "0"){
                alert("Please select a category");
                return false;
            }
        }
    </script>
</body>

</html>

<?php

} else {

    header('location:admin_login.php');

}


?>