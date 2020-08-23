<?php
require "functions.php";
session_start();
mailing( $_SESSION['postdata']['email'], $_SESSION['postdata']['verification'] );
echo "<script> window.location.href='../registration_confirmation.php' </script>";
?>
