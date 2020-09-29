<?php

use function PHPSTORM_META\type;

require "_headers/connection.php";
    require "_headers/functions.php";

    session_start();



    if( isset( $_SESSION['ID'] ) ){

        if (! isset( $_SESSION['BASICINFO'] ) ){
            setBasicInfo( $_SESSION['ID'] );
        }

        global $con;

        $sql = "SELECT P.PRD_NAME, P.PRD_ID, P.PRD_PRICE, C.CRT_QUANTITY, PI.IMG_PATH  ";
        $sql .= "FROM product P, cart C, prd_image PI ";
        $sql .= " WHERE C.CRT_LOGIN_ID = '" . $_SESSION['ID'] . "' AND ";
        $sql .= "P.PRD_ID = C.CRT_PRD_ID AND ";
        $sql .= "PI.IMG_PRD_ID = P.PRD_ID; ";      

        // pNAME PID PRICE QUANTITY 
        // die($sql." ");
        $result = mysqli_query( $con, $sql );    
        
        $subTotal = 0;
        // die(mysqli_error($con)."");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amart Admin</title>
    <meta content="Amart, amart sales, amart india" name="description">
    <meta content="Amart, India, Sales, Refrigerator Sales, TV Sales, Hardware Sales" name="keywords">
    <link href="assets/img/a.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/cartStyle.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="index.html">Amart<span style="font-size: medium;">ADMIN</span></a></h1>
            <div class="dropdown login-btn">
                <p style="margin-top: 0px;"><?php echo $_SESSION['BASICINFO']['USER_FNAME'] ?></p>
                <div class="dropdown-content">
                    <a href="index.php">Home</a>
                    <a href="#">My Account</a>
                    <a href="_headers/logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <section id="ad_home" style="height: 10%; margin-top: -3%;" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div>
                    <h1>Your cart<span>.</span></h1>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="basket">
            <div class="basket-labels">
                <ul>
                    <li class="item item-heading">Item</li>
                    <li class="price">Price</li>
                    <li class="quantity">Quantity</li>
                    <li class="subtotal">Subtotal</li>
                </ul>
            </div>
            
            <?php
                while( $row = mysqli_fetch_assoc( $result ) ){
            ?>
                    <div class="basket-product">
                        <div class="item">
                            <div class="product-image">
                                <?php echo "<img src='" . $row['IMG_PATH']  . "' alt='" . $row['PRD_NAME'] . "' class='product-frame'>" ?>
                            </div>
                            <div class="product-details">
                                <!-- <h1><strong><span class="item-quantity">4</span> x abc</strong> test</h1> Price of the the product (multiply) by Quntity and total -->
                                <?php echo "<p><strong>" . $row['PRD_NAME'] . "</strong></p>" ?><!-- Product Name-->
                                <?php echo "<p>Product Code - " . $row['PRD_ID'] . "</p> " ?><!-- Product Code -->
                            </div>
                        </div>
                        <div class="price"><?php echo $row['PRD_PRICE'] ?></div>

                        <div class="quantity">
                            <?php echo "<input type='number' value='" . $row['CRT_QUANTITY'] . "' min='1'  max='40' id='" . $row['PRD_ID'] . "' onkeyup='modify(\"" . $row['PRD_ID'] . "\")' onclick='modify(\"" . $row['PRD_ID'] . "\")' class='quantity-field'>" ?>
                        </div>

                        <?php  
                            //echo"<br><br><br><br><br><br><br>    ". gettype((float)$row['PRD_PRICE']);
                            //die(); 
                            $price = (float)$row['PRD_PRICE'] ;
                            $qunt = (int)$row['CRT_QUANTITY'] ;
                            $prdTotal = $price * $qunt ;
                            echo "<div class='subtotal'>" . $prdTotal . "</div>";
                            $subTotal += $prdTotal;

                        ?>
                        
                        
                        
                        <div class="remove">
                            <button onclick="deleteThis('<?php echo $row['PRD_ID'] ?>')">Remove</button>
                        </div>
                    </div>
            <?php
                }
            ?>

        </div>
        <aside>
            <div class="summary">
                <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">Subtotal</div>
                    <div class="subtotal-value final-value" id="basket-subtotal"><?php echo $subTotal ?></div>
                    <div class="summary-promo hide">
                        <div class="promo-title">Promotion</div>
                        <div class="promo-value final-value" id="basket-promo"></div>
                    </div>
                </div>
                <div class="summary-delivery">
                    <select name="delivery-collection" class="summary-delivery-selection" disabled>
                        <option value="0">Select Pick Up Point</option>
                        <option value="collection">Collection</option>
                        <option value="first-class">Royal Mail 1st Class</option>
                        <option value="second-class">Royal Mail 2nd Class</option>
                        <option value="signed-for">Royal Mail Special Delivery</option>
                    </select>
                </div>
                <div class="summary-total">
                    <div class="total-title">Total</div>
                    <div class="total-value final-value" id="basket-total"><?php echo $subTotal ?></div>
                </div>
                <div class="summary-checkout">
                    <button class="checkout-cta">Go to Secure Checkout</button>
                </div>
            </div>
        </aside>
    </main>

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
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script>

        


        function deleteThis(val) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "_headers/alterCartData.php" , true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("delete="+val); //fname=Henry&lname=Ford
            location.reload();
        }

        function modify(val){
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "_headers/alterCartData.php" , true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var quantity = document.getElementById(val).value;
            if( quantity < 50 && quantity > 0 ){
                xhttp.send("token="+val+"&updateQuantity="+quantity);
                xhttp.onreadystatechange = function() {
                    if ( this.readyState == 4 && this.status == 200 && this.responseText != " " ) {
                        alert( this.responseText );
                    }
                };
            } else {
                alert("Quantity cannot be 0 or greater than 5");
            }
        }
    </script>

</body>


</html>

<?php
    } else {
        die("Hello World");
        cookieCheck('cart.php');
        header('location:login.php');
    }

?>