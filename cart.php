<?php

require "_headers/connection.php";
require "_headers/functions.php";

    session_start();



    if( isset( $_SESSION['ID'] ) ){

        if (! isset( $_SESSION['BASICINFO'] ) ){
            setBasicInfo( $_SESSION['ID'] );
        }

        global $con;

        $sql = "SELECT P.PRD_NAME, P.PRD_ID, P.PRD_PRICE, P.PRD_OFFERS, C.CRT_QUANTITY, PI.IMG_PATH  ";
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


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Smart Electronics</title>
    <meta content="smart, smart sales, smart electronics india" name="description">
    <meta content="Smart, India, Sales, Refrigerator Sales, TV Sales, Hardware Sales" name="keywords">
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
            <h1 class="logo"><a href="index.php">Smart<span class="he">Electronics</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li class="drop-down"><a>Shop by Category</a>
                        <ul>

                <?php displayCategory() ?>

                        </ul>
                    </li>
                    <li><a href="admin/admin_index.php">Admin</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <li class="drop-down"><a>Shop by Category</a>
                                <ul>

                <?php displayCategory() ?>

                                </ul>
                                <li><a href="admin/admin_index.php">Admin</a></li>
                        </ul>
                        </li>
                </ul>
            </nav>

        <?php
            if( isset( $_SESSION['BASICINFO'] ) && isset( $_SESSION['ID'] ) ){
                echo "<div class='dropdown login-btn'>
                        <p style='margin-top: 0px; margin-bottom:0px;'>" . $_SESSION['BASICINFO']['USER_FNAME'] . "</p>
                        <div class='dropdown-content'>
                            <a href='#'>Home</a>
                            <a href='cart.php'>My Cart</a>
                            <a href='_headers/logout.php'>Log Out</a>
                        </div>
                    </div>";
            } else {
                echo "<a href=\"login.php\" class=\"login-btn\">Log In</a>";
            }
        ?>
            
        </div>
    </header>

    <section id="ad_home1" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div>
                    <h2>Your Cart<span>.</span></h2>
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
                                <?php echo "<p>Product Offer - " . $row['PRD_OFFERS'] . "</p> " ?><!-- Product Code -->
                            </div>
                        </div>
                        <div class="price"><?php echo $row['PRD_PRICE'] ?></div>
                        <?php echo "<input type='hidden' id='" . $row['PRD_ID'] . "-product-price' value='" . $row['PRD_PRICE'] . "' > "  ?>

                        <div class="quantity">
                            <?php echo "<input type='number' value='" . $row['CRT_QUANTITY'] . "' min='1'  max='4' id='" . $row['PRD_ID'] . "-quantity' onkeyup='modify(\"" . $row['PRD_ID'] . "\")' onclick='modify(\"" . $row['PRD_ID'] . "\")' class='quantity-field'>" ?>
                        <br>
                        </div>

                        <?php  
                            //echo"<br><br><br><br><br><br><br>    ". gettype((float)$row['PRD_PRICE']);
                            //die(); 
                            $price = (float)$row['PRD_PRICE'] ;
                            $qunt = (int)$row['CRT_QUANTITY'] ;
                            $prdTotal = $price * $qunt ;
                            echo "<p class='subtotal' id='" . $row['PRD_ID'] . "-product-subtotal'>" . $prdTotal . "</p>";
                            //echo "<input type='hidden' id='" . $row['PRD_ID'] . "-product-subtotal' value='" . $prdTotal  . "'>";
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
                    <p class="subtotal-title">Subtotal</p>
                    <p class="subtotal-value final-value" id="basket-subtotal"><?php echo $subTotal ?></p>
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
                    <p class="total-title">Total</p>
                    <p class="total-value final-value" id="basket-total"><?php echo $subTotal ?></p>
                </div>
                <div class="summary-checkout">
                    <!-- <button class="checkout-cta" target="_blank" href="_headers/sendMail.php">Go to Secure Checkout</button> -->
                    <button class="checkout-cta" target="_blank" href="_headers/sendMail.php" >Secure Checkout</button>
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
<li><i class="bx bx-wifi-1"></i> <a href="#">Email: no.replay.amart@gmail.com</a></li>
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

        
        function reCalculate( val ){
            var prdPrice = parseFloat( document.getElementById( val + "-product-price" ).value );
            var quant = parseInt( document.getElementById( val + "-quantity" ).value );
            var prdSubTotal = parseFloat( document.getElementById( val + "-product-subtotal" ).innerHTML );
            var total = parseFloat( document.getElementById( "basket-total" ).innerHTML );
            var tempTotal = ( total - prdSubTotal ) + ( prdPrice * quant );
            // var tempPrdSubTotal = 
            // alert( " Pprice : " +prdPrice + " Quanti: " + quant + " prdsubtotal: " + prdSubTotal + " Total: " + tempTotal );
            document.getElementById( "basket-total" ).innerHTML = tempTotal;
            document.getElementById( "basket-subtotal" ).innerHTML = tempTotal;
            document.getElementById( val + "-product-subtotal" ).innerHTML = ( prdPrice * quant );


        }        

        function deleteThis( val ) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "_headers/alterCartData.php" , true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("delete="+val); //fname=Henry&lname=Ford
            location.reload();
        }

        function modify( val ){
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "_headers/alterCartData.php" , true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var quantity = parseInt( document.getElementById( val + "-quantity" ).value );
            if( quantity < 5 && quantity >= 1 ){
                xhttp.send("token="+val+"&updateQuantity="+quantity);
                xhttp.onreadystatechange = function() {
                    if ( this.readyState == 4 && this.status == 200 && this.responseText != " " ) {
                        alert( this.responseText );
                    }
                };
            document.getElementById( val + "-quantity" ).value = quantity;
            reCalculate( val );
            // alert( parseInt( document.getElementById("ENT-123-321-product-price").value ) );
            // document.getElementById("basket-total").innerHTML = "Hello";
            } else {
                // alert("Quantity cannot be 0 or greater than 5");
                if( quantity > 4 ){
                    document.getElementById( val + "-quantity" ).value = 4;
                    alert("Quantity cannot be greater than 4");
                    reCalculate( val );
                }else if( quantity < 1 ){
                    document.getElementById( val + "-quantity" ).value = 1;
                    alert("Quantity cannot be less than 1");
                    reCalculate( val );
                }
            }
        }
    </script>

</body>



<?php
    } else {
        cookieCheck('cart.php');
        header('location:login.php');
    }

?>