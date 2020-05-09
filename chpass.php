<?php

session_start();
require './php/init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: home.php");
    exit;
}

$ui = $_SESSION["ui"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chpass.css">
    <title>Tornado.com | Login</title>
</head>
<body>
    <form class="con" action="" method="post">
        <div class="left-side">
            <div class="desc">
                <h1>HELLO THERE!!</h1>
                <p>WE CONNECT GAMER FROM ALL OVER THE WORLD TO MAKE A BETTER GAMEPLAY AND EASY ACCESS TO GET GAME THINGS</p>
            </div>
        </div>
        <div class="right-side">
            <div class="inner">
                <div class="lala2">
                    <input type="password" name="newpass" class="pw" placeholder="Password" autocomplete required>
                    <span class="pass"></span>
                    <p class="hide">H</p>
                </div>
                <button class="btn" name="upass">CHANGE PASSWORD</button>
            </div>
        </div>
    </form>
</body>
</html>
<script src="./js/chpass.js"></script>
<?php
if(isset($_POST["upass"])){
    $newpass = htmlentities(mysqli_real_escape_string($conn,stripslashes($_POST["newpass"])));
    if(strlen($newpass) < 8){
        echo '<script>less();</script>';
    }

    if(strlen($newpass) >= 8){
        $npas = password_hash($newpass,PASSWORD_DEFAULT);
        mysqli_query($conn,"UPDATE anggota SET password = '$npas' WHERE user = '$ui'");
        header("Location: ./php/logout.php");
    }
}
?>