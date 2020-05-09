<?php

session_start();
require 'init.php';
$hid = $_GET["toor"];
if(!isset($_SESSION["success"])){
    header("Location: ../home.php");
    exit;
}else if(isset($_SESSION["success"]) && $hid !== ""){
    $_SESSION["success"] = false;

    $d1 = random_int(1,9);
    $d2 = random_int(1,9);
    $d3 = random_int(1,9);
    $d4 = random_int(1,9);
    $d5 = random_int(1,9);
    $d6 = random_int(1,9);
    $d7 = random_int(1,9);
    $d8 = random_int(1,9);

    $ok1 = mysqli_query($conn,"SELECT data,jenis FROM product WHERE id_item = '$hid'");
    $ok2 = mysqli_fetch_assoc($ok1);
    $filepath = ".".$ok2["data"];
    $filename = substr($filepath,8);

    if($filepath !== '.' && $filename !== ''){
        if($ok2["jenis"] === "PRODUCT"){
            mysqli_query($conn,"DELETE FROM product WHERE id_item = '$hid'");
            unlink($filepath);
            header("Location: ../home.php");
        }
        echo "<script>alert('YOUR TRANSACTION CODE: $d1$d2$d3$d4$d5$d6$d7$d8</script>";
    }else{
        echo "<script>alert('404 Not Found')</script>";
        header("Location: ../home.php");
    }
}

?>