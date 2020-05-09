<?php
session_start();
require './php/init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: login.php");
    exit;
}

$ui = $_SESSION["ui"];
$actual_link = "$_SERVER[REQUEST_URI]";
$su = substr($actual_link,23);

if($su === "" && substr($actual_link,22,1) === "?"){
    echo "<script>document.location.href = './home.php';</script>";
    exit;
}else if(substr($actual_link,22) === ""){
    echo "<script>document.location.href = './home.php';</script>";
    exit;
}


$sah = mysqli_query($conn,"SELECT * FROM anggota WHERE id = '$su'");
$siah = mysqli_fetch_assoc($sah);
$siauser = $siah["user"];

$jualan = mysqli_query($conn,"SELECT * FROM product WHERE username = '$siauser' AND jenis = 'product'");
$jual = mysqli_query($conn,"SELECT * FROM product WHERE username = '$siauser' AND jenis = 'course'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE | <?= strtoupper($siah["user"]); ?></title>
    <link rel="stylesheet" href="provv.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="profile-img">
                <div class="trobos">
                    <img src="<?= $siah["profile_img"]; ?>">
                </div>
            </div>
            <div class="profile-text">
                <span><?= $siah["user"]; ?></span>
                <p><?= $siah["deskripsi"]; ?></p>
            </div>
            <div class="profile-medsos">
                <p><?= $siah["phone"]; ?></p>
                <p><?= $siah["email"]; ?></p>
            </div>
        </div>

        <section class="action-box">
            <div class="custom-btn">
                <button name="product" class="cbtn">PRODUCT</button>
                <button name="course">COURSE</button>
                <a href="home.php">BACK</a>
            </div>

            <div class="box">
                <div class="sclll"></div>

                <div class="product tot act-tot">
                    <?php while($jj = mysqli_fetch_assoc($jualan)) : ?>
                        <div class="h-box">
                            <div class="hleft">
                                <img src="<?= $jj["image"]; ?>" class="wek1">
                                <div class="hdesc">
                                    <span><?= substr_replace(strtoupper($jj["title"]),"...",31); ?></span>
                                    <p>PRODUCT</p>
                                    <p>TYPE : <?= $jj["game"]; ?></p>
                                    <?php if($jj["buyer"] !== ""): ?>
                                        <p>BUYER: <?= $jj["buyer"]; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hright">
                                <div class="rtop">
                                    <span>+</span>
                                    <h3>Rp. <?= $jj["harga"]; ?></h3>
                                </div>
                                <div class="rbot">
                                    <div class="waktu"><?= $jj["waktu"]; ?></div>
                                    <div class="tanggal"><?= $jj["tanggal"] ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    </div>


                <div class="product tot">
                    <?php while($jj = mysqli_fetch_assoc($jual)) : ?>
                        <div class="h-box">
                            <div class="hleft">
                                <img src="<?= $jj["image"]; ?>" class="wek1">
                                <div class="hdesc">
                                    <span><?= substr_replace(strtoupper($jj["title"]),"...",31); ?></span>
                                    <p>PRODUCT</p>
                                    <p>TYPE : <?= $jj["game"]; ?></p>
                                    <?php if($jj["buyer"] !== ""): ?>
                                        <p>BUYER: <?= $jj["buyer"]; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hright">
                                <div class="rtop">
                                    <span>+</span>
                                    <h3>Rp. <?= $jj["harga"]; ?></h3>
                                </div>
                                <div class="rbot">
                                    <div class="waktu"><?= $jj["waktu"]; ?></div>
                                    <div class="tanggal"><?= $jj["tanggal"] ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
<script src="./js/provv.js"></script>