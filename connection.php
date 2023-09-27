<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "management";

// create connection
session_start();
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection

if(!$conn){

    die("connection failed:". mysqli_connect_error());
}


 ?>