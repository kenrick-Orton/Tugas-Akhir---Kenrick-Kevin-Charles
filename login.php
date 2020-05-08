<?php

session_start();
if(isset($_SESSION["log-pro"])){
    header("Location: home.php");
    exit;
}
require './php/init.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
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
                <div class="lala">
                    <input type="text" name="username" class="un" placeholder="Username" required>
                    <span class="user">USERNAME ISN'T VALID</span>
                </div>
                <br>
                <div class="lala2">
                    <input type="password" name="password" class="pw" placeholder="Password" autocomplete required>
                    <span class="pass"></span>
                    <p class="hide">H</p>
                </div>
                <a href="#">FORGET PASSWORD</a>
                <button class="btn" name="login">LOGIN</button>
            </div>
        </div>
    </form>
</body>
</html>
<script src="./js/login.js"></script>
<?php
if(isset($_POST["login"])){
    masuk();
}
?>