<?php

session_start();
$_SESSION = [];
session_destroy();
session_unset();

$_SESSION["ui"];

header("Location: ../home.php");

?>