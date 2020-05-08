<?php

session_start();
require './php/init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: login.php");
    exit;
}

$ui = ucwords($_SESSION["ui"]);

$pro_img = mysqli_query($conn,"SELECT * FROM anggota WHERE user = '$ui'");
$sok = mysqli_fetch_assoc($pro_img);

$history = mysqli_query($conn,"SELECT * FROM product WHERE username = '$ui' AND jenis = 'product'");
$co = mysqli_query($conn,"SELECT * FROM product WHERE username = '$ui' AND jenis = 'course'");
$queue = mysqli_query($conn,"SELECT * FROM joki WHERE jokier = '$ui'");


if(isset($_POST["adding-b"])){
    header("Location: addproduct.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <title>Tornado.com | Profile <?php echo $ui; ?></title>
</head>
<body>
    <form class="foto" action="" method="post" enctype="multipart/form-data">
        <div class="kotak">
            <div class="exit-btn">+</div>
            <div class="pf">
                <div class="kotak-pilih">
                    <img class="preview">
                    <input type="file" name="pilih">
                </div>
                <ul>
                    <li>IMAGE MUST LESS THEN 2MB</li>
                    <li>IMAGE EXTENSION MUST JPG, PNG, JPEG</li>
                    <div class="errbox"></div>
                </ul>
            </div>
            <button name="choose" class="pf-btn">SUBMIT</button>
        </div>
    </form>

    <section class="container">
        <div class="profile">
            <div class="profile-img">
                <div class="trobos">
                    <img src="<?php echo $sok["profile_img"]; ?>">
                </div>
            </div>
            <div class="profile-text">
                <span><?php echo $ui; ?></span>
                <p><?php echo $sok["deskripsi"]; ?></p>
            </div>
            <div class="profile-medsos">
                <p><?php echo $sok["phone"]; ?></p>
                <p><?php echo $sok["email"]; ?></p>
                <a href="./php/logout.php"><button class="logout" name="logout">LOG OUT</button></a>
            </div>
        </div>

        <section class="action-box">
            <div class="custom-btn">
                <button name="product" class="cbtn">PRODUCT</button>
                <button name="course">COURSE</button>
                <button name="setting">SETTING</button>
            </div>
            <div class="box">
                <div class="sclll"></div>

                <form class="product tot act-tot" method="POST" action="">
                <?php while($his = mysqli_fetch_assoc($history)) :?>
                    <div class="h-box">
                        <a href="./php/hapos1.php?tot=<?= $his["id_item"]; ?>" class="aaa">+</a>
                        <div class="hleft">
                            <img src="<?= $his["image"]; ?>" class="wek1">
                            <div class="hdesc">
                                <span><?= substr_replace(strtoupper($his["title"]),"...",31); ?></span>
                                <p>PRODUCT</p>
                                <p>TYPE : <?= $his["game"]; ?></p>
                                <?php if($his["buyer"] !== ""): ?>
                                    <p>BUYER: <?= $his["buyer"]; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hright">
                            <div class="rtop">
                                <span>+</span>
                                <h3>Rp. <?= $his["harga"]; ?></h3>
                            </div>
                            <div class="rbot">
                                <div class="waktu"><?= $his["waktu"]; ?></div>
                                <div class="tanggal"><?= $his["tanggal"] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <div class="adding">
                        <button name="adding-b" class="adding-btn">ADD PRODUCT</button>
                    </div>
                </form>
                <form class="product tot" method="POST" action="">
                <?php while($con = mysqli_fetch_assoc($co)) :?>
                    <div class="h-box">
                        <a href="./php/hapos1.php?tot=<?= $con["id_item"]; ?>" class="aaa">+</a>
                        <div class="hleft">
                            <img src="<?= $con["image"]; ?>" class="wek1">
                            <div class="hdesc">
                                <span><?= substr_replace(strtoupper($con["title"]),"...",31); ?></span>
                                <p><?= $con["jenis"]; ?></p>
                                <p>TYPE : <?= $con["game"]; ?></p>
                                <?php if($con["buyer"] !== ""): ?>
                                    <p>BUYER: <?= $con["buyer"]; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hright">
                            <div class="rtop">
                                <span>+</span>
                                <h3>Rp. <?= $con["harga"]; ?></h3>
                            </div>
                            <div class="rbot">
                                <div class="waktu"><?= $con["waktu"]; ?></div>
                                <div class="tanggal"><?= $con["tanggal"] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <div class="adding">
                        <button name="adding-b" class="adding-btn">ADD COURSE</button>
                    </div>
                </form>

                <div class="setting tot">
                    <a href="editacc.php">EDIT ACCOUNT</a>
                    <a href="chpass.php">EDIT PASSWORD</a>
                    <a href="home.php">HOME</a>
                    <a href="./php/hapos2.php">DELETE ACCOUNT</a>
                    <a href="">ABOUT</a>
                    <a href="">CONTACT</a>
                </div>
            </div>
        </section>
    </section>
</body>
</html>
<script src="./js/profile.js"></script>
<?php
if(isset($_FILES["pilih"])){
    $namegmb = htmlspecialchars($_FILES["pilih"]["name"]);
    $sizegmb = htmlspecialchars($_FILES["pilih"]["size"]);
    $tmpgmb = htmlspecialchars($_FILES["pilih"]["tmp_name"]);
    $typegmb = htmlspecialchars($_FILES["pilih"]["type"]);
    $errgmb = htmlspecialchars($_FILES["pilih"]["error"]);

    if($sizegmb > 2000000){
        echo '<script>errsize();</script>';
        echo '<script>allerr();</script>';
        exit;
    }
    
    if($errgmb === "4"){
        echo '<script>noimg();</script>';
        echo '<script>allerr();</script>';
        exit;
    }
    
    $exvalid = ["jpg","png","jpeg"];
    $exgmb = explode('.',$namegmb);
    $exgmb = strtolower(end($exgmb));
    if(!in_array($exgmb,$exvalid)){
        echo '<script>exerr();</script>';
        echo '<script>allerr();</script>';
        exit;
    }

    if($sizegmb < 2000000 && $errgmb !== "4" && in_array($exgmb,$exvalid)){
        $desu = "./profileimg/".$namegmb;
        move_uploaded_file($tmpgmb,$desu);
        mysqli_query($conn,"UPDATE anggota SET profile_img = '$desu' WHERE user = '$ui'");
        header("Location: profile.php");
    }
}
?>