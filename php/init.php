<?php

$conn = mysqli_connect("localhost","root","","tornado");
$res_item = mysqli_query($conn,"SELECT * FROM product");
$res_log = mysqli_query($conn,"SELECT * FROM anggota");

function masuk(){
    global $conn;
    $usernameLog = $_POST["username"];
    $passwordLog = $_POST["password"];  

    $res_user_log = mysqli_query($conn,"SELECT user FROM anggota WHERE user = '$usernameLog'");
    $res_pass_log = mysqli_query($conn,"SELECT password FROM anggota WHERE user = '$usernameLog'");

    if(mysqli_num_rows($res_user_log) === 1){
        $r = mysqli_fetch_assoc($res_pass_log);
        if(password_verify($passwordLog,$r["password"])){
            $_SESSION["log-pro"] = true;
            $_SESSION["ui"] = $usernameLog;
            header("Location: profile.php");
        }   
        else{
            echo '<script>invalidPass()</script>';
        }
    }else{
        echo '<script>invalidUser()</script>';
    }
}

function ahsiap(){
    global $conn;
    $username = strtolower(htmlspecialchars(stripslashes($_POST["username"])));
    $email = strtolower(htmlspecialchars(stripslashes($_POST["email"])));
    $phone = htmlspecialchars($_POST["phone"]);
    $password = htmlentities(mysqli_real_escape_string($conn,$_POST["password"]));
    $passwordkon = htmlentities(mysqli_real_escape_string($conn,$_POST["passwordkon"]));

    $res_reg_user = mysqli_query($conn,"SELECT user FROM anggota WHERE user = '$username'");
    $res_reg_email = mysqli_query($conn,"SELECT email FROM anggota WHERE email = '$email'");
    $res_reg_phone = mysqli_query($conn,"SELECT phone FROM anggota WHERE phone = '$phone'");

    if(mysqli_num_rows($res_reg_user) === 1) echo '<script>invUser();</script>';
    if(mysqli_num_rows($res_reg_email) === 1) echo '<script>invEmail();</script>';
    if(mysqli_num_rows($res_reg_phone) === 1) echo '<script>invPhone();</script>';
    if(strlen($phone) > 13 || strlen($phone) < 9){
        echo '<script>phoneNum();</script>';
    }
    if(strlen($password) < 8 && strlen($passwordkon) < 8){
        echo '<script>less();</script>';
    }else if($password !== $passwordkon){
        echo '<script>same();</script>';
    }

    if($password === $passwordkon && mysqli_num_rows($res_reg_user) === 0 && mysqli_num_rows($res_reg_email) === 0 && mysqli_num_rows($res_reg_phone) === 0 && strlen($phone) < 13 && strlen($phone) > 9 && strlen($password) >= 8){
        $pass = password_hash($password,PASSWORD_DEFAULT);
        $date = date("d-M-Y");
        $jam = date("G") + 5;
        $waktu = date("$jam:i");
        echo '<script>succedd();</script>';
        mysqli_query($conn,"INSERT INTO anggota (user,password,email,phone,tanggal,waktu) VALUES ('$username','$pass','$email','$phone','$date','$waktu')");
        header("Location: login.php");
    }
}

function addproduct(){
    global $conn;
    global $ui;
    $title = htmlentities(htmlspecialchars(strtoupper($_POST["title"])));
    $deskripsi = htmlentities(htmlspecialchars(strtoupper($_POST["deskc"])));
    $cost = htmlentities(htmlspecialchars($_POST["cost"]));
    $pro_type = htmlentities(htmlspecialchars(strtoupper($_POST["pro-type"])));
    $game = htmlentities(htmlspecialchars(strtoupper($_POST["typ"])));

    $addnamegmb = htmlspecialchars($_FILES["pileh"]["name"]);
    $addsizegmb = htmlspecialchars($_FILES["pileh"]["size"]);
    $addtmpgmb = htmlspecialchars($_FILES["pileh"]["tmp_name"]);
    $adderrgmb = htmlspecialchars($_FILES["pileh"]["error"]);
    
    $dataname = htmlspecialchars($_FILES["data"]["name"]);
    $datasize = htmlspecialchars($_FILES["data"]["size"]);
    $dataerr = htmlspecialchars($_FILES["data"]["error"]);
    $datatmp = htmlspecialchars($_FILES["data"]["tmp_name"]);
    
    if($title === ""){
        echo "<script>errtit();</script>";
        echo "<script>allerr();</script>";
        exit;
    }
    
    if($cost === ""){
        echo "<script>errtit();</script>";
        echo "<script>allerr();</script>";
        exit;
    }
    
    if($adderrgmb === "4"){
        echo '<script>noimg();</script>';
        echo '<script>allerr();</script>';
        exit;
    }
    
    if($datasize === "4"){
        echo '<script>noimg();</script>';
        echo '<script>allerr();</script>';
    }
    
    if($addsizegmb > 2000000){
        echo '<script>errsize();</script>';
        echo '<script>allerr();</script>';
        exit;
    }
    
    $exvalid = ["jpg","png","jpeg"];
    $exgmb = explode('.',$addnamegmb);
    $exgmb = strtolower(end($exgmb));
    if(!in_array($exgmb,$exvalid)){
        echo '<script>exerr();</script>';
        echo '<script>allerr();</script>';
        exit;
    }

    $parah = false;

    $validatename = explode('.',$dataname);
    $validatename = strtolower(end($validatename));
    
    if($pro_type === "COURSE"){
        if($validatename !== "mp4"){
            echo '<script>dataerr();</script>';
            echo '<script>allerr();</script>';
            exit;
        }else{
            $parah = true;
        }
    }else if($pro_type === "PRODUCT"){
        if($validatename !== "txt"){
            echo '<script>dataerr();</script>';
            echo '<script>allerr();</script>';
            exit;
        }else{
            $parah = true;
        }
    }
    
    if($addsizegmb < 2000000 && $adderrgmb !== "4" && in_array($exgmb,$exvalid) && $title !== "" && $cost !== "" && $parah === true){
        $otaku = htmlspecialchars("./items/".$addnamegmb);
        $wibu = htmlspecialchars("./data/".$dataname);
        move_uploaded_file($addtmpgmb,$otaku);
        move_uploaded_file($datatmp,$wibu);
        $tgl = date("j F o");
        $jam = date("G") + 5;
        $wak = date("$jam:i");

        mysqli_query($conn,"INSERT INTO product VALUES('','$ui','$pro_type','$game','$title','$deskripsi','$cost','','$otaku','$tgl','$wak','$wibu')");
        header("Location: profile.php");
    }else{
        exit;
    }
}
?>