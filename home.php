<?php
session_start();
require './php/init.php';
$_SESSION["success"] = false;

if(isset($_SESSION["ui"])){
    $ui = $_SESSION["ui"];
    $nakal = mysqli_query($conn,"SELECT * FROM anggota WHERE user = '$ui'");
    $wer = mysqli_fetch_assoc($nakal);
}else{
    $_SESSION["ui"] = false;
}
$itot = mysqli_query($conn,"SELECT * FROM product");


if(isset($_POST["filter"])){
    $jnis = $_POST["jenis"];
    $ml = null;
    $ff = null;
    $pu = null;
    $cd = null;
    $al = null;

    if(isset($_POST["ml"]) > 0) $ml = $_POST["ml"];
    if(isset($_POST["ff"]) > 0) $ff = $_POST["ff"];
    if(isset($_POST["pubg"]) > 0) $pu = $_POST["pubg"];
    if(isset($_POST["codm"]) > 0) $cd = $_POST["codm"];
    if(isset($_POST["all"]) > 0) $al = $_POST["all"];

    if($ml == null && $ff == null && $pu == null && $cd == null && $al == null){
        $al = "all";
    }

    if($jnis === "all" && $al !== "all"){
        $str_query = "SELECT * FROM product WHERE game = '$ml' OR game = '$ff' OR game = '$pu' OR game = '$cd'";
        $itot = mysqli_query($conn,$str_query);
    }else if($jnis === "all" && $al === "all"){
        $str_query = "SELECT * FROM product";
        $itot = mysqli_query($conn,$str_query);
    }else if($jnis !== "all" && $al === "all"){
        $str_query = "SELECT * FROM product WHERE jenis = '$jnis'";
        $itot = mysqli_query($conn,$str_query);
    }else{
        $str_query = "SELECT * FROM product WHERE jenis = '$jnis' AND (game = '$ml' OR game = '$ff' OR game = '$pu' OR game = '$cd')";
        $itot = mysqli_query($conn,$str_query);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Tornado.com</title>
</head>
<body>
    <div class="nav-section">
        <p>INDEX</p>
        <span></span>
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="#">CONTACT</a></li>
        </ul>
    </div>
    <div class="nav">
        <div class="d1"></div>
        <div class="d2"></div>
        <div class="d3"></div>
    </div>
    
    <section class="header">
        <?php if(!isset($_SESSION["log-pro"])): ?>
        <div class="inside-header">
            <h1>2020</h1>
            <div class="hr"></div>
            <p>CONNECT GAMER FROM ALL OVER THE <br> WORLD AND MAKE YOUR BETTER GAMEPLAY</p>
            <div class="">
                <a href="login.php">LOGIN</a>
                <a href="regis.php">SIGN UP</a>
            </div>
        </div>
        <?php elseif(isset($_SESSION["log-pro"])):?>
            <div class="kimochi">
                <div class="img-home">
                    <img src="<?= $wer["profile_img"]; ?>">
                </div>
                <div class="data-home">
                    <p><?= ucwords($wer["user"]); ?></p>
                    <a href="profile.php">PROFILE</a>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <form method="post" action="" class="shop">
        <div class="type">
            <select name="jenis">
                <option value="all">ALL</option>
                <option value="product">PRODUCT</option>
                <option value="course">COURSE</option>
            </select>
        </div>

        <div class="product-nav">
            <ul>
                <li><input type="checkbox" class="chk" value="mobile legends" name="ml">MOBILE LEGENDS</li>
                <li><input type="checkbox" class="chk" value="free fire" name="ff">FREE FIRE</li>
                <li><input type="checkbox" class="chk" value="pubg" name="pubg">PUBG</li>
                <li><input type="checkbox" class="chk" value="codm" name="codm">CODM</li>
                <li><input type="checkbox" class="chk" value="all" name="all">ALL</li>
            </ul>
            <div class="sort">
                <button name="filter">FILTER</button>
            </div>
        </div>
    </form>

    <?php if(isset($_POST["filter"])): ?>
        <p class="hasil-filter">result for : <br> <?php 
            $has = "";
            if(isset($_POST["ml"]) > 0) $has .= $_POST["ml"] . ", ";
            if(isset($_POST["ff"]) > 0) $has .= $_POST["ff"] . ", ";
            if(isset($_POST["pubg"]) > 0) $has .= $_POST["pubg"] . ", ";
            if(isset($_POST["codm"]) > 0) $has .= $_POST["codm"] . ", ";
            
            $mantap = strlen($has) - 2;
            echo substr($has,0,$mantap);
        ?></p>
    <?php endif; ?>

    <form method="GET" action="prodetail.php" class="place">
        <?php while($product = mysqli_fetch_assoc($itot)) : ?>
        <div class="items">
            <img src="<?= $product["image"] ?>">
            <div class="inner-desc">
                <span><?= strtoupper($product["title"]) ?></span>
                <hr>
                <p><?= substr_replace(strtoupper($product["deskripsi"]),"...",35); ?></p>
                <div class="lala">
                    <a href="prodetail.php?<?=$product["id_item"];?>">CHECK OUT</a>
                    <span><?= "Rp. ". $product["harga"]; ?></span>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        </form>
</body>
</html>
<script src="./js/main.js"></script>
<?php
if(isset($_POST["buy"])){
    $_SESSION["buying"] = true;
}
?>