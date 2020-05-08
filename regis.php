<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="regis.css">
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
                    <input type="text" name="username" class="un" placeholder="Username" required>
                    <span class="user">USERNAME ISN'T VALID</span>
                </div>
                <div class="lala">
                    <input type="email" name="email" class="em" placeholder="E-mail" required>
                    <span class="user">EMAIL USED</span>
                </div>
                <div class="lala">
                    <input type="phone" name="phone" class="pn" placeholder="Phone Number" required>
                    <span class="user">PHONE NUMBER USED</span>
                </div>
                <div class="lala2">
                    <input type="password" name="password" class="pw" placeholder="Password" autocomplete required>
                    <span class="pass"></span>
                    <p class="hide">H</p>
                </div>
                <div class="lala2">
                    <input type="password" name="passwordkon" class="pw pwk" placeholder="Confirm Password" autocomplete required>
                    <span class="pass"></span>
                    <p class="hide">H</p>
                </div>
                <a href="login.php">ALREADY HAVE AN ACCOUNT?</a>
                <button name="daftar" class="btn">SIGN UP</button>
            </div>
        </div>
    </form>
</body>
</html>
<script src="./js/reg.js"></script>
<?php
session_start();
require './php/init.php';
if(isset($_POST["daftar"])){
    ahsiap();
}
?>