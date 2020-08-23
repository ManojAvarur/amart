<?php
    require "connection.php";

    global $con;

    if( isset( $_POST['submit'] ) ) {

        
        $pd_name = mysqli_escape_string( $con, $_POST['pname']  );

        $pd_cat = mysqli_escape_string( $con, $_POST['category'] );

        $pd_price = mysqli_escape_string( $con, $_POST['price'] );

        $pd_desc = mysqli_escape_string( $con, $_POST['description'] );

        $pd_offers = mysqli_escape_string( $con, $_POST['offers'] );

        $sql  = "INSERT INTO PRODUCT (  PRD_CAT_ID, PRD_NAME, PRD_DETAILS, PRD_PRICE, PRD_OFFERS )  ";
        $sql .= "VALUES ( $pd_cat, '$pd_name', '$pd_desc', $pd_price, '$pd_offers' ); ";



// ----------------------------------------Uploading image into image table -----------------------------------------

        if( mysqli_query( $con, $sql ) ){            
            
                $files = $_FILES['image'];

            // Check image type

                for( $i = 0 ; $i < count( $files['name'] ) ; $i++ ){

                    // echo $_FILES['image']['name'][$i]."<br>";
                    if( ( $files['error'][$i] > 0 ) || ( ! in_array( $files['type'][$i] , ["image/jpeg", "image/png", "image/jfif"] ) ) ) {
                        echo "<script>
                                        alert('An error ocurred when uploading or File type not supported');
                                        //window.location.href='" . $_SERVER['HTTP_REFERER'] . "';
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
        
                    $loc = "../Products/Images/". $_POST['pname'] .  "-" . hexdec( time() ) . "." . $ext;
            
                // Renaming the image if it exists 

                    $count = 0;
                    while( file_exists( $loc ) ){
        
                        $loc = "../Products/Images/". $_POST['pname'] .  "-" . hexdec( time() ) . "-". $count . "." . $ext;
                        $count++;
        
                    }

                // Moving the image
                    if( move_uploaded_file( $files['tmp_name'][$i], $loc ) ) {
                
                        $loc = substr($loc, 3);

                        $sql  = "SELECT PRD_ID FROM PRODUCT WHERE PRD_NAME = '$pd_name' AND PRD_CAT_ID = $pd_cat ";
                        $sql .= "AND PRD_DETAILS = '$pd_desc' AND PRD_PRICE = $pd_price AND PRD_OFFERS = '$pd_offers'; ";

                        if( $rows = mysqli_fetch_assoc( mysqli_query( $con, $sql ) ) ) {       // Obtaining PRD_ID

                            $sql  = "INSERT INTO PRD_IMAGE (PRD_ID, IMG_PATH) VALUES ";
                            $sql .= "(" . ($rows['PRD_ID']) . ", '" . mysqli_escape_string($con, $loc) . "'); ";

                            $query = mysqli_query( $con, $sql );

                            // die( $sql ); 

                            if( !$query ) {

                                // echo "<script> alert(\"Some error occured during execution of the query! \nCheck with the database for unknown entries\")</script>";
                                die(mysqli_error($con));

                            }
                    }

            } else {

                // echo "<script>
                //                 alert('An error ocurred while uploading image : ". $files['name'] ."');
                //     </script>";

                die( mysqli_error( $con ) );

            }
        }
    }
}







































    
        // // die($_SERVER['HTTP_REFERER']);
        // $files = $_FILES['image'];

        // for($i = 0 ; $i < count( $files['name'] ) ; $i++ ){

        //     // echo $_FILES['image']['name'][$i]."<br>";
        //     if( ( $files['error'][$i] > 0 ) || ( ! in_array( $_FILES['type'], ["image/jpeg", "image/png", "image/jfif"] ) ) ){
        //         echo "<script>
        //                         alert('An error ocurred when uploading or File type not supported');
        //                         window.location.href='" . $_SERVER['HTTP_REFERER'] . "';
        //             </script>";
        //     }

        // }

        // for($i = 0 ; $i < count( $_FILES['image'] ) ; $i++ ){

        //     if( $files['type'] === "image/jpeg" || $files['type'] === "image/jfif" )
        //         $ext = "jpg";   
        //     else 
        //         $ext = "png";

        //     $loc = "../Products/Images/". $_POST['pname'] .  "-" . hexdec( time() ) . "." . $ext;

        //     $count = 0;
        //     while( file_exists( $loc ) ){

        //         $loc = "../Products/Images/". $_POST['pname'] .  "-" . hexdec( time() ) . "-". $count . "." . $ext;
        //         $count++;

        //     }

        //     // Upload file
        //     if( move_uploaded_file( $files['tmp_name'], $loc ) ) {
                
        //         $loc = substr($loc, 3);

        //         $sql  = "INSERT INTO PRD_IMAGE (PRD_ID, IMG_PATH) VALUES ";
        //         $sql .= "('" . mysqli_escape_string($con, $loc) . "') ";  

        //         if( mysqli_query($con, $sql) ){

        //             $sql = "SELECT IMG_ID FROM PRD_IMAGE WHERE IMG_PATH = '$loc' ";

        //             $query = mysqli_query($con, $sql);

        //             if ($rows = mysqli_fetch_assoc($query)) {

        //                 $sql  = "INSERT INTO PRODUCT (PRD_CAT_ID, PRD_NAME, PRD_OFFERS, PRD_DETAILS, PRD_PRICE, PRD_IMG_ID) VALUES ";
        //                 $sql .= "($pd_cat, '$pd_name', '$pd_offers', '$pd_desc', $pd_price, " . $rows['IMG_ID'] . " );";

        //                 if(!mysqli_query($con, $sql)){
        //                     // echo "<script> alert(\"Some error occured during execution of the query! Check with the database for unknown entries\")</script>";
        //                     die(mysqli_error($con));
        //                 }

        //             }

        //         }

        //     } else {

        //         echo "<script>
        //                         alert('An error ocurred while uploading image : ". $files['name'] ."');
        //             </script>";

        //     }
        // }









// ------------------------------------------------------------------------------------





        // $pd_name = mysqli_escape_string($con, $_POST['pname']);

        // $pd_cat = mysqli_escape_string($con, $_POST['category']);

        // $pd_price = mysqli_escape_string($con, $_POST['price']);

        // $pd_desc = mysqli_escape_string($con, $_POST['description']);

        // $pd_offers = mysqli_escape_string($con, $_POST['offers']);

        // $files = $_FILES['image'];

        // if( ! in_array( $files['type'], ["image/jpeg", "image/png", "image/jfif"] ) ) {

        //     echo "<script> alert('File type not accepted') </script>";

        // } else {

        //     if( $files['type'] === "image/jpeg" || $files['type'] === "image/jfif" )
        //         $ext = "jpg";   
        //     else 
        //         $ext = "png";

        //     $loc = "../Products/Images/". $_POST['pname'] .  "-" . hexdec( time() ) . "." . $ext;
        //     move_uploaded_file( $files['tmp_name'], $loc );
        
        //     $loc = substr($loc, 3);

        //     $sql  = "INSERT INTO PRD_IMAGE (IMG_PATH) VALUES ";
        //     $sql .= "('" . mysqli_escape_string($con, $loc) . "'); ";

        //     if( mysqli_query($con, $sql) ){

        //         $sql = "SELECT IMG_ID FROM PRD_IMAGE WHERE IMG_PATH = '$loc' ";

        //         $query = mysqli_query($con, $sql);

        //         if ($rows = mysqli_fetch_assoc($query)) {

        //             $sql  = "INSERT INTO PRODUCT (PRD_CAT_ID, PRD_NAME, PRD_DETAILS, PRD_PRICE, PRD_IMG_ID) VALUES ";
        //             $sql .= "($pd_cat, '$pd_name', '$pd_desc', $pd_price, " . $rows['IMG_ID'] . " );";

        //             if(!mysqli_query($con, $sql)){
        //                 echo "<script> alert(\"Some error occured during execution of the query! Check with the database for unknown entries\")</script>";
        //             }

        //         }

        //     }

        // }
    


    // Array ( [name] => IMG-20170407-WA0046.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php6559.tmp [error] => 0 [size] => 77383 )