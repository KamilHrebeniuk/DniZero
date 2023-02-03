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
    <link rel="stylesheet" type="text/css" href="css/leader.css">
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

$ID = "";
$name = "";
$telephone = "";
$path = "";


try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT DZ_leaders.ID AS ID, DZ_leaders.Name AS Name, DZ_leaders.Telephone AS Telephone FROM DZ_leaders, DZ_accounts WHERE DZ_leaders.ID = DZ_accounts.Leader AND DZ_accounts.ID = :id");
    $stmt->bindParam(':id', $_SESSION['ID']);
    $stmt->execute();

    foreach ($stmt as $row) {
        $ID = $row['ID'];
        $name = $row['Name'];
        $telephone = $row['Telephone'];
    }

    $path = strtolower(str_replace(' ', '', $name));

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<div id="header-container">
    <img src="images/menu.png" id="menu-button-container" onclick="openNav()"/>
    <div id="main-title">
        Mój opiekun
    </div>
</div>

<div class="leader-container">
    <div class="leader">
        <div class="image-ratio">
            <img class="image" src="images/leaders/<?php echo $path ?>.png"/>
        </div>
        <div class="description-container">
            <div class="point">
                <div class="title">
                    Imię i Nazwisko
                </div>
                <div class="content">
                    <?php echo $name ?>
                </div>
            </div>
            <hr class="line">
            <a href="tel:+48 602 833 093">
                <div class="point">
                    <div class="title">
                        Numer telefonu
                    </div>
                    <div class="content">
                        +48 <?php echo $telephone ?>
                    </div>
                </div>
            </a>
            <hr class="line">
                <div class="point">
                    <div class="title">
                        Numer grupy
                    </div>
                    <div class="content">
                        <?php echo $ID ?>
                    </div>
                </div>
        </div>
    </div>
</div>

</body>
</html>