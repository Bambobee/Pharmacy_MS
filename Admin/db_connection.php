<?php
//Start session
session_start();
//create a constant to store non repeating values
define('SITEURL', 'http://localhost/resturant/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

//Execute quary and save in the database
$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting  database

?>