<?php

session_start();
require './php/init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: login.php");
    exit;
}

$ui = $_SESSION["ui"];

$isian = mysqli_query($conn,"SELECT * FROM anggota WHERE user = '$ui'");
$an = mysqli_fetch_assoc($isian);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="editacc.css">
    <title>Tornado.com | Login</title>
</head>
<body>
    <div class="sc">
        <div class="inside-sc">
            <i class="fa fa-check"></i>
            <p>ACCOUNT HAS BEEN CREATED</p>
        </div>
    </div>

    <form class="con" action="" method="post">
        <div class="left-side">
            <div class="desc">
                <h1>HELLO THERE!!</h1>
                <p>WE CONNECT GAMER FROM ALL OVER THE WORLD TO MAKE A BETTER GAMEPLAY AND EASY ACCESS TO GET GAME THINGS</p>
            </div>
        </div>
        <div class="right-side">
            <div class="inner">
                <div class="lala">
                    <input type="text" name="userup" class="un" placeholder="Username" value="<?= $an["user"]; ?>" required>
                    <span class="user">USERNAME ISN'T VALID</span>
                </div>
                <div class="lala">
                    <input type="email" name="emailup" class="em" placeholder="E-mail" value="<?= $an["email"]; ?>" required>
                    <span class="user">EMAIL USED</span>
                </div>
                <div class="lala">
                    <input type="phone" name="phoneup" class="pn" placeholder="Phone Number" required value="<?= $an["phone"]; ?>">
                    <span class="user">PHONE NUMBER USED</span>
                </div>
                <textarea name="deskripup" placeholder="Description"><?= $an["deskripsi"]; ?></textarea>
                <button name="ubah" class="btn">CHANGE</button>
            </div>
        </div>
    </form>
</body>
</html>
<script src="./js/edacc.js"></script>
<?php
$uid = $an["id"];
$userbe = $an["user"];
$emailbe = $an["email"];
$phonebe = $an["phone"];
$desbe = $an["deskripsi"];

if(isset($_POST["ubah"])){
    $userup = htmlentities(htmlspecialchars($_POST["userup"]));
    $emailup = htmlentities(htmlspecialchars($_POST["emailup"]));
    $phoneup = htmlentities(htmlspecialchars($_POST["phoneup"]));
    $deskripup = htmlentities(htmlspecialchars($_POST["deskripup"]));

    $hasil_user = mysqli_query($conn,"SELECT user FROM anggota WHERE user = '$userup'");
    $hasil_hp = mysqli_query($conn,"SELECT phone FROM anggota WHERE user = '$phoneup'");
    $hasil_email = mysqli_query($conn,"SELECT email FROM anggota WHERE user = '$emailup'");

    if(strlen($userup) > 50) echo '<script>invUser();</script>';
    if(strlen($emailup) > 50) echo '<script>invEmail();</script>';
    if(strlen($phoneup) > 13 || strlen($phoneup) < 9) echo '<script>phoneNum();</script>';
    if(mysqli_num_rows($hasil_hp) === 1 && $an["phone"] !== $phoneup) echo '<script>invPhone();</script>';
    if(mysqli_num_rows($hasil_user) === 1 && $an["user"] !== $userup) echo '<script>sameUser();</script>';
    if(mysqli_num_rows($hasil_email) === 1 && $an["email"] !== $emailup) echo '<script>sameEmail();</script>';
    
    if(strlen($userup) < 50 && strlen($emailup) < 50 && strlen($phoneup) < 13 && strlen($phoneup) > 9){
        if(mysqli_num_rows($hasil_hp) === 0 || $an["phone"] === $phoneup){
            if(mysqli_num_rows($hasil_user) === 0 || $an["user"] === $userup){
                if(mysqli_num_rows($hasil_email) === 0 || $an["email"] === $emailup){
                    mysqli_query($conn,"UPDATE anggota SET user = '$userup', email = '$emailup', phone = '$phoneup', deskripsi = '$deskripup' WHERE id = '$uid'");
                    header("Location: profile.php");
                }
            }
        }
    }
}
?>