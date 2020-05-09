<?php 

session_start();
require './php/init.php';

if(!isset($_SESSION["log-pro"]) && !isset($_SESSION["buying"])){
    header("Location: ./login.php");
    exit;
}

$_SESSION["buying"] = false;
$ui = $_SESSION["ui"];
$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$las = substr_replace($actual_link,"",0,36);

if($las === "" && substr($actual_link,35,1) === "/"){
    echo "<script>document.location.href = '../home.php';</script>";
    exit;
}else if($las === "" && substr($actual_link,35,1) === ""){
    echo "<script>document.location.href = './home.php';</script>";
    exit;
}

$qq = mysqli_query($conn,"SELECT * FROM product WHERE id_item = '$las'");
$slurr = mysqli_fetch_assoc($qq);
$seller = $slurr["username"];

$lahlah = mysqli_query($conn,"SELECT * FROM anggota WHERE user = '$seller'");
$ll = mysqli_fetch_assoc($lahlah);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCT DETAIL</title>
    <link rel="stylesheet" href="prodetail.css">
</head>
<body>
    <div class="azu"></div>
    <div class="imgside">
        <img src="<?= $slurr["image"] ?>" alt="">
    </div>
    <div class="con-side">
        <h3 class="tit"><?= $slurr["title"]; ?></h3>
        <div class="isi">
            <?php if($slurr["deskripsi"] !== ""): ?>
                <div class="ldesu">
                    <p><?= $slurr["deskripsi"]; ?></p>
                </div>
                <div class="rdesu">
                    <ul>
                        <li><span>SELLER INFORMATION:</span></li>
                        <?php if($seller !== $ui): ?>
                            <li><a href="provv.php?<?= $ll['id']; ?>"><?= ucwords($slurr["username"]); ?></a></li>
                        <?php elseif($seller === $ui): ?>
                            <li><a href="profile.php"><?= ucwords($slurr["username"]); ?></a></li>
                        <?php endif; ?>
                        <li><p><?= $ll["phone"]; ?></p></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="rdesu">
                    <ul>
                        <li><span>SELLER INFORMATION:</span></li>
                        <?php if($seller !== $ui): ?>
                            <li><a href="profile.php?<?= $ll['id']; ?>"><?= ucwords($slurr["username"]); ?></a></li>
                        <?php elseif($seller === $ui): ?>
                            <li><a href="profile.php"><?= ucwords($slurr["username"]); ?></a></li>
                        <?php endif; ?>
                        <li><p><?= $ll["phone"]; ?></p></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="lao">
            <h1>Rp. <?= $slurr["harga"]; ?></h1>
            <a href="home.php">BACK</a>
        </div>
        <?php if($seller !== $ui): ?>
            <a href="cart.php?<?= $las; ?>" class="by">BUY NOW</a>
        <?php elseif($seller === $ui): ?>
            <h2>THIS IS YOUR <?= $slurr["jenis"]; ?></h2>
        <?php endif; ?>
    </div>
</body>
</html>