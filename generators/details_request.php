<?php
require_once "../connect.php";


try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO `DZ_details` (`ID`, `Name`, `Place`, `Day`, `Time`, `ShortDesc`, `LongDesc`) VALUES(:id, :name, :place, :day, :time, :shortdesc, :longdesc)");
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':place', $_POST['place']);
    $stmt->bindParam(':day', $_POST['day']);
    $stmt->bindParam(':time', $_POST['time']);
    $stmt->bindParam(':shortdesc', $_POST['shortdesc']);
    $stmt->bindParam(':longdesc', $_POST['longdesc']);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO `DZ_localizations` (`ID`, `Localization`) VALUES(:id, :localization)");
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->bindParam(':localization', $_POST['localization']);
    $stmt->execute();
    foreach($_POST['icon'] as $icondesc) {
        $stmt = $conn->prepare("INSERT INTO `DZ_icons` (`AttractionID`, `Description`) VALUES(:icon, :icondesc)");
        $stmt->bindParam(':icon', $_POST['id']);
        $stmt->bindParam(':icondesc', $icondesc);
        $stmt->execute();
    }


} catch (PDOException $e) {
    echo $e->getMessage();
}