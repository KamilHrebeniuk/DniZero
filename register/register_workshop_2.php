<?php
session_start();
require_once ("../connect.php");

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT DZ_workshops.Name AS Name FROM DZ_workshops, DZ_registed_workshops WHERE DZ_workshops.ID = DZ_registed_workshops.WorkshopID AND DZ_registed_workshops.Name = :name AND DZ_workshops.ID > 10");
    $stmt->bindParam(':name', $_SESSION['Name']);
    $stmt->execute();

    $my_workshop = "";
    foreach($stmt as $row) {
        $my_workshop = $row['Name'];
    }

    if($my_workshop === ""){
        $stmt = $conn->prepare("INSERT INTO `DZ_registed_workshops` (WorkshopID, Name) VALUES (:id, :name)");
        $stmt->bindParam(':id', $_POST['target']);
        $stmt->bindParam(':name', $_SESSION['Name']);
        $stmt->execute();
        $stmt = $conn->prepare("SELECT `Taken` FROM `DZ_workshops` WHERE `ID` = :id");
        $stmt->bindParam(':id', $_POST['target']);
        $stmt->execute();
        $taken = 0;
        foreach($stmt as $row) {
            $taken = $row['Taken'];
        }
        $taken++;
        $stmt = $conn->prepare("UPDATE `DZ_workshops` SET `Taken` = :taken WHERE `ID` = :id");
        $stmt->bindParam(':taken', $taken);
        $stmt->bindParam(':id', $_POST['target']);
        $stmt->execute();

        echo "Zapisano poprawnie!";
    }
    else{
        echo "Zapisano już na: " . $my_workshop;
    }



} catch (PDOException $e) {
    echo "Błąd";
}