<form action="details_request.php" method="post">
    ID:
    <input name="id" type="text">
    <br><br>
    Nazwa:
    <input name="name" type="text">
    <br><br>
    Miejsce:
    <input name="place" type="text">
    <br><br>
    Dzień:
    <select name="day" size="3">
        <option value="0">Piątek</option>
        <option value="1">Sobota</option>
        <option value="2">Niedziela</option>
    </select>
    <br><br>
    Godzina:
    <input name="time" type="text">
    <br><br>
    Krótki opis:
    <textarea name="shortdesc"></textarea>
    <br><br>
    Szczegółowy opis:
    <textarea name="longdesc"></textarea>
    <br><br>
    Lokalizacja:
    <textarea name="localization"></textarea>
    <br><br>
    Ikony:
    <select name="icon[]" size="4" multiple>
        <option value="Wejście za okazaniem ID">Wejście za okazaniem ID</option>
        <option value="Zakaz wnoszenia alkoholu">Zakaz wnoszenia alkoholu</option>
        <option value="Elegancki Dresscode">Elegancki Dresscode</option>
    </select>
    <br><br>
    <input type="submit">
</form>