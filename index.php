<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dni Zero 2019</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="js/index.js"></script>
  <link rel="stylesheet" type="text/css" href="css/basics.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>

<?php
session_start();
if(isset($_SESSION['ID'])){
    if($_SESSION['ID'] < 0 || $_SESSION['ID'] > 400){
        header("Location: http://dnizero.pl/login.php");
        die();
    }
}
else{
    header("Location: http://dnizero.pl/login.php");
    die();
}

require_once ("navigation.php");
require_once ("connect.php");
?>

<div id="main-container">
    <div id="header-container">
        <img src="images/menu.png" id="menu-button-container" onclick="openNav()"/>
        <div id="main-title">
            Aktualności
        </div>
    </div>

    <!--
        <div class="my_alert urgent">
            Uwaga! Mamy fuckup!
        </div>-->

    <div class="category-header">
        Obecnie
    </div>

    <?php
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $conn->prepare("SELECT `ID`, `Time`, `Name`, `Place`, `ShortDesc` FROM `DZ_details` WHERE `Time` > :my_hour AND `Day` = 0 LIMIT 1");

        $time =  date("H:i");
        $stmt->bindParam(':my_hour', $time);
        $stmt->execute();
        foreach($stmt as $row) {
            $path = strtolower(str_replace(' ', '', $row['Name']));
            echo
                '<div id="event-container">
                <a href="details.php?attraction=' . $row['ID'] . '">
                    <div class="event">
                        <div class="header">
                            <div class="place">'
                . $row['Place'] . ' ' . $row['Time'] .
                '</div>
                        </div>
                        <div class="main-container">
                            <div class="image-ratio">
                                <img class="image" src="images/places/' . $path . '"/>
                                <div class="darkness">
        
                                </div>
                                <div class="title">'
                . $row['Name'] .
                '</div>
                                </div>
                            <div class="description">'
                . $row['ShortDesc'] .
                '</div>
                        </div>
                    </div>
                </a>
            </div>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <div class="category-header">
        Wkrótce
    </div>

    <?php
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $conn->prepare("SELECT `ID`, `Time`, `Name`, `Place`, `ShortDesc` FROM `DZ_details` WHERE `ID` <> (SELECT `ID` FROM `DZ_details` WHERE `Time` > :my_hour1 AND `Day` = 0 ORDER BY `ID` LIMIT 1) AND `Time` > :my_hour2 AND `Day` = 0 LIMIT 1");
    //    $stmt = $conn->prepare("SELECT `ID`, `Time`, `Name`, `Place`, `ShortDesc` FROM `DZ_details` WHERE `Time` > :my_hour AND `Day` = 0 LIMIT 1");

        $time =  date("H:i");

        $stmt->bindParam(':my_hour1', $time);
        $stmt->bindParam(':my_hour2', $time);
        $stmt->execute();
        foreach($stmt as $row) {
            $path = strtolower(str_replace(' ', '', $row['Name']));
            echo
                '<div id="event-container">
                <a href="details.php?attraction=' . $row['ID'] . '">
                    <div class="event">
                        <div class="header">
                            <div class="place">'
                . $row['Place'] . ' ' . $row['Time'] .
                '</div>
                        </div>
                        <div class="main-container">
                            <div class="image-ratio">
                                <img class="image" src="images/places/' . $path . '"/>
                                <div class="darkness">
        
                                </div>
                                <div class="title">'
                . $row['Name'] .
                '</div>
                                </div>
                            <div class="description">'
                . $row['ShortDesc'] .
                '</div>
                        </div>
                    </div>
                </a>
            </div>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

</div>

</body>
</html>