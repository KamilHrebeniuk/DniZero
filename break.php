<?php
session_start();
$_SESSION['ID'] = -1;
header("Location: http://dnizero.pl/login.php");
die();