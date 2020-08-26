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
                    <li><a href="admin_add.html">Add Product</a></li>
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
                                    <li><a href="admin_add.html">Add Product</a></li>
                                    <li><a href="admin_delete.html">Delete Product</a></li>
                                    <li><a href="admin_update.html">Update Product</a></li>
                                    <li><a href="admin_all.html">Check Products</a></li>
                                </ul>
                        </ul>
                        </li>
                </ul>
            </nav>
            <div class="dropdown login-btn">
                <p style="margin-bottom: 0px;">NAME</p>
                <div class="dropdown-content">
                    <a href="admin_after_login.html">Home</a>
                    <a href="admin_details.html">My Account</a>
                    <a href="admin_home.html">Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <section id="ad_home" class="d-flex align-items-center justify-content-center">
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
                <h2>Electronics</h2>
                <p>Update products</p>
            </div>
            <form style="margin-top: -2%; margin-bottom: 4%;">
                <div class="form-group">
                    <label><b>Product Name</b></label>
                    <input type="text" style="width: 40%;" class="form-control" id="productName" placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                    <label><b>Product Type</b></label>
                    <select id="productType" style="width: 40%;" class="form-control">
                      <option selected>Choose...</option>
                      <option>Electronics</option>
                      <option>Hardware</option>
                      <option>Living Room</option>
                      <option>Kitchen Appliances</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><b>Product ID</b></label>
                    <input type="text" style="width: 40%;" class="form-control" id="productID" placeholder="Enter Product ID">
                </div>
                <div class="form-group">
                    <label><b>Product Price</b></label>
                    <input type="number" style="width: 40%;" class="form-control" id="productPrice" placeholder="Enter Product Price">
                </div>
                <div class="form-group">
                    <label><b>Product Offers</b></label>
                    <input type="text" style="width: 40%;" class="form-control" id="productOffers" placeholder="Enter Product Offers">
                </div>
                <div class="form-group">
                    <label><b>Product Description</b></label>
                    <textarea class="form-control" style="width: 80%;" id="productDescription" placeholder="Enter Product Description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label><b>Upload Product Image</b></label>
                    <input type="file" style="width: 40%;" class="form-control-file" id="productImage" width="50" height="50">
                </div>
                <button type="submit" class="btn btn-primary admin_but">Update Product</button>
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