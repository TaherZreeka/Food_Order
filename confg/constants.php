<?php declare(strict_types=1); 

// start session

session_start();

define("SITEURL","http://localhost/Taherphp/Food-Order/");

$conn = mysqli_connect("localhost", "root", "taherzreek") ; // Database connection
$db_select = mysqli_select_db($conn, "food_order") or die(mysqli_error($conn)); // Select the database


