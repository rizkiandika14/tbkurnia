<?php
$host = "localhost";
$username = "boobmyid_ceking";
$password = "Beholder.co1";
$dbname = "boobmyid_tbkurnia";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}

date_default_timezone_set('Asia/Jakarta');
error_reporting(0);