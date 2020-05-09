<?php

session_start();
require './php/init.php';
if(!isset($_SESSION["log-pro"])){
    header("Location: login.php");
    exit;
}

$ui = $_SESSION["ui"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addproduct.css">
    <title>ADD PRODUCT</title>
</head>
<body>
    <div class="back-to">back</div>
    <div class="infoerr">
        <li class="err-info"></li>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="uploadproduct">
        <div class="upper-img">
            <div class="no-img">
                <img class="img-preview">
                <input type="file" class="pileh" name="pileh">
                <span>Product Image</span>
            </div>
        </div>
        
        <div class="content">
            <div class="asiappp">
            <div class="left-con">
                <div class="bdn-judul">
                    <input type="text" name="title" class="judul" placeholder="Title">
                    <div class="digit"><span class="chartit">0</span>/50</div>
                </div>
                <div class="bdn-desk">
                    <textarea class="deskripsi" name="deskc" placeholder="Description"></textarea>
                    <div class="digit"><span class="chardesc">0</span>/300</div>
                </div>
            </div>
            <div class="right-con">
                <input type="number" name="cost" class="harga" placeholder="Cost">
                <div class="wikwik">
                <select name="typ" class="tipe">
                    <option value="MOBILE LEGENDS">MOBILE LEGENDS</option>
                    <option value="PUBG">PUBG</option>
                    <option value="FREE FIRE">FREE FIRE</option>
                    <option value="CODM">CODM</option>
                </select>
                <select name="pro-type" class="tipe">
                    <option value="COURSE">COURSE</option>
                    <option value="PRODUCT">PRODUCT</option>
                </select>
                </div>
                <div class="data"><input type="file" name="data" class="datas"></div>
                <button name="addpro" class="sbm-pro">SUBMIT PRODUCT</button>
            </div>
        </div>
        </div>
    </div>
    </form>
</body>
</html>
<script src="./js/add.js"></script>
<?php

if(isset($_POST["addpro"])){
    addproduct();
    echo $validatename;
}

?>