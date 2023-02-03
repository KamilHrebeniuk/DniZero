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
    <script src="js/login.js"></script>
    <link rel="stylesheet" type="text/css" href="css/basics.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>

<div id="login-container">
    <label for="login" class="header">E-mail:</label>
    <input type="text" class="form-control" id="login">
    <button type="button" class="btn default-button" id="login-button" onclick="login()">
        <img src="images/login.png" id="login-icon"/>
    </button>
    <div class="alert-info" style="
    float: left;
    margin-top: 20px;
    font-size: 12px;
    line-height: 16px;
    padding: 2px;">
        Pierwotna wersja strony została wykorzystana podczas Dni Zero 2019. Po zakończeniu wydarzenia, baza użytkowników została wykasowana. By przetestować system można wejść za pomocą loginu "konto@demo.pl". Ze względu na charakter wydarzenia, strona została stworzona wyłącznie w wersji mobilnej. Prawdopodobnie nie jesteś pierwszą osobą testującą system. Z tego powodu użytkownik może być już zapisany na maksymalną ilość przysługujących mu warsztatów.
    </div>
    <div id="error">
        Nie znaleziono podanego adresu email
    </div>
</div>

</body>
</html>