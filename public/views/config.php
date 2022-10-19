<?php

$host ="localhost";
$user ="tes";
$pass ="T35enef2021!!";
$data ="tes_smp_8";


// Koneksi ke database

$con = mysqli_connect($host,$user,$pass,$data);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

?>