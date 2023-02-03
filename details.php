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
    <script src="js/register.js"></script>
    <link rel="stylesheet" type="text/css" href="css/basics.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
    <link rel="stylesheet" type="text/css" href="css/details.css">
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

$name = "";
$place = "";
$day = "";
$time = "";
$longdesc = "";
$registration = -1;
$path = "";


try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `DZ_details` WHERE `ID` = :id");
    $stmt->bindParam(':id', $_GET['attraction']);
    $stmt->execute();

    foreach ($stmt as $row) {
        $id = $row['ID'];
        $name = $row['Name'];
        $place = $row['Place'];
        $day = $row['Day'];
        $time = $row['Time'];
        $longdesc = $row['LongDesc'];
        $registration = $row['Registration'];
    }

    $path = strtolower(str_replace(' ', '', $name));

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<div id="main-container">
    <div id="header-container">
        <img src="images/menu.png" id="menu-button-container" onclick="openNav()"/>
        <div id="main-title">
            Szczegóły
        </div>
    </div>

    <div id="event-container">
        <div class="event">
            <div class="header">
                <div class="place">
                    <?php echo $place . ' ' . $time;?>
                </div>
            </div>
            <div class="main-container">
                <div class="image-ratio">
                    <img class="image" src="images/places/<?php echo $path ?>.png"/>
                    <div class="darkness">

                    </div>
                    <div class="title">
                        <?php echo $name;?>
                    </div>
                </div>
                <div class="description">
                    <?php echo $longdesc;?>
                </div>
            </div>
        </div>
        <div id="icon-container">
            <?php
                $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                $conn->exec("set names utf8");
                $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $stmt = $conn->prepare("SELECT `Localization` FROM `DZ_localizations` WHERE `ID` = :id");
                    $stmt->bindParam(':id', $_GET['attraction']);
                    $stmt->execute();

                    foreach ($stmt as $row) {
                        echo'
                            <a href="' . $row['Localization'] . '">
                                <div class="icon">
                                    <div class="icon-inside">
                                        <img class="icon-image" src="images/icons/map.png"/>
                                        <div class="icon-title">
                                            Lokalizacja
                                        </div>
                                    </div>
                                </div>
                            </a>';
                    }

                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                try {

                $stmt = $conn->prepare("SELECT * FROM `DZ_icons` WHERE `AttractionID` = :id");
                $stmt->bindParam(':id', $_GET['attraction']);
                $stmt->execute();

                foreach ($stmt as $row) {
                    $path = strtolower(str_replace(' ', '', $row['Description']));
                    echo'
                    <div class="icon">
                        <div class="icon-inside">
                            <img class="icon-image" src="images/icons/' . $path . '.png"/>
                            <div class="icon-title">
                                ' . $row['Description'] . '
                            </div>
                        </div>
                    </div>';
                }

                } catch (PDOException $e) {
                echo $e->getMessage();
                }

    /***************ZAPISY WARSZTATY ***********************/

                if ($registration === 1){
                    $stmt = $conn->prepare("SELECT `WorkshopID` FROM `DZ_registed_workshops` WHERE `Name` = :name");
                    $stmt->bindParam(':name', $_SESSION['Name']);
                    $stmt->execute();



                    echo'
                    <div class="day-header">
                        Tura I
                    </div>
                    <div class="timetable-container">
                        <div class="timetable">
                    ';

                    try {
                        $stmt = $conn->prepare("SELECT `ID`, `Name`, `Available`, `Taken` FROM `DZ_workshops` WHERE `Turn` = 0");
                        $stmt->execute();

                        $first = true;
                        foreach($stmt as $row) {
                            if(!$first) echo'<hr class="line">';
                            $first = false;
                            if($row['Available'] > $row['Taken']) {
                                echo '
                                <div class="point" onclick="register_workshop(' . $row['ID'] . ')">' .
                                    $row['Name'] . ' ' . $row['Taken'] . '/' . $row['Available'] .
                                    '</div>';
                            }
                            else{
                                echo '
                                <div class="point" onclick="alert(\'Brak miejsc\')">' .
                                    $row['Name'] . ' ' . $row['Taken'] . '/' . $row['Available'] .
                                    '</div>';
                            }
                        }

                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }


                    echo'
                        </div>
                    </div>
                    <div class="day-header">
                        Tura II
                    </div>
                    <div class="timetable-container">
                        <div class="timetable">
                    ';

                    try {
                        $stmt = $conn->prepare("SELECT `ID`, `Name`, `Available`, `Taken` FROM `DZ_workshops` WHERE `Turn` = 1");
                        $stmt->execute();

                        $first = true;
                        foreach($stmt as $row) {
                            if(!$first) echo'<hr class="line">';
                            $first = false;
                            if($row['Available'] > $row['Taken']) {
                                echo '
                                <div class="point" onclick="register_workshop(' . $row['ID'] . ')">' .
                                    $row['Name'] . ' ' . $row['Taken'] . '/' . $row['Available'] .
                                    '</div>';
                            }
                            else{
                                echo '
                                <div class="point" onclick="alert(\'Brak miejsc\')">' .
                                    $row['Name'] . ' ' . $row['Taken'] . '/' . $row['Available'] .
                                    '</div>';
                            }
                        }

                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }

    /***************ZAPISY GRA MIEJSKA ***********************/
            if ($registration === 2){
                echo'
                    <div class="day-header">
                        Zgłoś drużynę!
                    </div>
                    <form action="" method="post">
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj nazwę drużyny
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #1
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #2
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #3
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #4
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #5
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #6
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #7
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #8
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #9
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container">
                            <div class="register-content">
                                <div class="register-title">
                                    Podaj członka #10
                                </div>
                                <input class="register-input" type="text">
                            </div>
                        </div>
                        <div class="register-container" style="margin-top: 46px; margin-bottom: 46px;">
                            <div class="register-content">
                                <div id="register-submit" onclick="register_day_game()">
                                    Zgłoś drużynę!
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    ';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>