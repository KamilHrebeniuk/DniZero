<?php
session_start();
require_once ("connect.php");
$_SESSION['ID'] = -1;
$_SESSION['Name'] = -1;

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT `ID`, `Name` FROM `DZ_accounts` WHERE `Email` = :email");
    $stmt->bindParam(':email', htmlspecialchars($_POST['login']));
    $stmt->execute();

    foreach($stmt as $row) {
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Name'] = $row['Name'];
    }

    if($_SESSION['ID'] != -1){
        echo "Zalogowano";
    }

} catch (PDOException $e) {
    echo "Error";
}