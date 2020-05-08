<?php

session_start();
require './php/init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: home.php");
    exit;
}

$ui = $_SESSION["ui"];
$actual_link = "$_SERVER[REQUEST_URI]";
$su = substr($actual_link,22);

if($su === "" && substr($actual_link,22,1) === "?"){
    echo "<script>document.location.href = './home.php';</script>";
    exit;
}else if(substr($actual_link,22) === ""){
    echo "<script>document.location.href = './home.php';</script>";
    exit;
}

$jay = mysqli_query($conn,"SELECT * FROM product WHERE id_item = '$su'");
$jelas = mysqli_fetch_assoc($jay);

$filename = substr($jelas["data"],7);
$filepath = $jelas["data"];

if(isset($_POST["back"])){
    header("Location: home.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>CART</title>
</head>
<body>
    <div class="okeok">
        <div class="success-form">
            <h1>MANTAP GANNN!!</h1>
            <p>JIKA SUDAH PERGI, JANGAN HARAP IA KEMBALI SEBAB BARANG SIAPA YANG MENINGGALKAN, IA JUGA AKAN DITINGGALKAN</p>
        </div>
    </div>
    <div class="h-box">
        <div class="hleft">
            <img src="<?= $jelas["image"]; ?>" class="wek1">
            <div class="hdesc">
                <span><?= $jelas["title"]; ?></span>
                <p><?= $jelas["jenis"]; ?></p>
                <p>TYPE : <?= $jelas["game"]; ?></p>
                <?php if($jelas["buyer"] !== ""): ?>
                    <p>BUYER: <?= $jelas["buyer"]; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="hright">
            <div class="rtop">
                <h3>Rp. <?= $jelas["harga"]; ?></h3>
            </div>
            <div class="rbot">
                <div class="waktu"><?= $jelas["waktu"]; ?></div>
                <div class="tanggal"><?= $jelas["tanggal"] ?></div>
            </div>
        </div>
    </div>

    <form class="buy-back" action="" method="POST">
        <button name="back" class="back">BACK</button>
        <button name="buy" class="buy">BUY</button>
    </form>
</body>
</html>
<script>
function suc(){
    const sf = document.querySelector(".okeok");
    sf.style.transform = "translateY(0)";
    document.location.href = "./php/tc.php?toor=<?= $jelas["id_item"]; ?>";
}
</script>
<?php
$_SESSION["success"]  = true;
if(isset($_POST["buy"])){
    $_SESSION["success"] = true;
    echo "<script>alert('YOUR TRANSACTION CODE: $d1$d2$d3$d4$d5$d6$d7$d8');
    var el = document.createElement('a');
        el.style.display = 'none';
        document.body.appendChild(el);
        el.setAttribute('href','$filepath');
        el.setAttribute('download','$filename');
        el.click();
        document.body.removeChild(el);
        </script>";
    echo "<script>suc();</script>";
}
?>