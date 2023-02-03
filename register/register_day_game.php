<?php
session_start();
require_once ("../connect.php");

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO `DZ_registed_day_runs` (Name, Person1, Person2, Person3, Person4, Person5, Person6, Person7, Person8, Person9, Person10) VALUES (:name, :person1, :person2, :person3, :person4, :person5, :person6, :person7, :person8, :person9, :person10)");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':person1', $_POST['person1']);
    $stmt->bindParam(':person2', $_POST['person2']);
    $stmt->bindParam(':person3', $_POST['person3']);
    $stmt->bindParam(':person4', $_POST['person4']);
    $stmt->bindParam(':person5', $_POST['person5']);
    $stmt->bindParam(':person6', $_POST['person6']);
    $stmt->bindParam(':person7', $_POST['person7']);
    $stmt->bindParam(':person8', $_POST['person8']);
    $stmt->bindParam(':person9', $_POST['person9']);
    $stmt->bindParam(':person10', $_POST['person10']);
    $stmt->execute();

    echo "Zapisano";

} catch (PDOException $e) {
    echo "Błąd";
}