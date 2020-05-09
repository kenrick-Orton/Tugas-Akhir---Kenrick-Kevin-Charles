<?php
session_start();
require 'init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: ../login.php");
    exit;
}
$hid = $_GET["tot"];
if($hid !== ""){
    $filed  = mysqli_query($conn,"SELECT data FROM product WHERE id_item = '$hid'");
    $datafile = mysqli_fetch_assoc($filed);
    $filepath = ".".$datafile["data"];
    if(file_exists($filepath)){
        unlink($filepath);
        mysqli_query($conn,"DELETE FROM product WHERE id_item = '$hid'");
    }
}

header("Location: ../profile.php");

?>