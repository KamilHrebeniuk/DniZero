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
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
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
            Harmonogram
        </div>
    </div>

    <div class="day-header">
        Piątek 27.09
    </div>

    <div class="timetable-container">
        <div class="timetable">

            <?php
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $stmt = $conn->prepare("SELECT `ID`, `Time`, `Name` FROM `DZ_details` WHERE `Day` = 0 ORDER BY `Time`");
                $stmt->execute();

                $first = true;
                foreach($stmt as $row) {
                    if(!$first) echo'<hr class="line">';
                    $first = false;
                    echo'
                    <a href="details.php?attraction=' . $row['ID'] . '">
                        <div class="point">' .
                            $row['Time'] . ' ' . $row['Name'] .
                       '</div>
                    </a>';
                }


            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
<!--
            <a href="details.php">
                <div class="point">
                    11:00 Oficjalne rozpoczęcie
                </div>
            </a>
            <hr class="line">
            <a href="details.php">
                <div class="point">
                    12:00 Zwiedzanie Wrocławia
                </div>
            </a>
            <hr class="line">
            <a href="details.php">
                <div class="point">
                    17:30 Rejs po Odrze
                </div>
            </a>
            <hr class="line">
            <a href="details.php">
                <div class="point">
                    20:00 Czas wolny
                </div>
            </a>
            <hr class="line">
            <a href="details.php">
                <div class="point">
                    21:00 Integracje w pubach
                </div>
            </a>-->
        </div>
    </div>

    <div class="day-header">
        Sobota 28.09
    </div>

    <div class="timetable-container">
        <div class="timetable">
            <?php
            try {
                $stmt = $conn->prepare("SELECT `ID`, `Time`, `Name` FROM `DZ_details` WHERE `Day` = 1 ORDER BY `Time`");
                $stmt->execute();

                $first = true;
                foreach($stmt as $row) {
                    if(!$first) echo'<hr class="line">';
                    $first = false;
                    echo'
                    <a href="details.php?attraction=' . $row['ID'] . '">
                        <div class="point">' .
                        $row['Time'] . ' ' . $row['Name'] .
                        '</div>
                    </a>';
                }


            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>

    <div class="day-header">
        Niedziela 29.09
    </div>

    <div class="timetable-container">
        <div class="timetable">
            <?php
            try {
                $stmt = $conn->prepare("SELECT `ID`, `Time`, `Name` FROM `DZ_details` WHERE `Day` = 2 ORDER BY `Time`");
                $stmt->execute();

                $first = true;
                foreach($stmt as $row) {
                    if(!$first) echo'<hr class="line">';
                    $first = false;
                    echo'
                    <a href="details.php?attraction=' . $row['ID'] . '">
                        <div class="point">' .
                        $row['Time'] . ' ' . $row['Name'] .
                        '</div>
                    </a>';
                }


            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>


</div>

</body>
</html>