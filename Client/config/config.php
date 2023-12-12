<?php
define('SITEURL', 'http://localhost/pharmacy/Client/');
 $conn = new mysqli("localhost","root","","pharmacy");
 if($conn->connect_error){
    die("connect failed!".$conn->connect_error);
 }
?>