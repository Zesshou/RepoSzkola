<?php

$conn = mysqli_connect('localhost', 'root', '', 'quest_notatki');

if (!$conn) {
    die("Błąd połączenia.");
}



if (isset($_POST["zapisz1"]))
    {
        $notatka1 = $_POST["notatka1"];
        mysqli_query($conn, "UPDATE notatki SET tresc='$notatka1' WHERE id=1");

    }

if (isset($_POST["zapisz2"]))
    {
        $notatka2 = $_POST["notatka2"];
        mysqli_query($conn, "UPDATE notatki SET tresc='$notatka2' WHERE id=2");
    }

if (isset($_POST["zapisz3"]))
    {
        $notatka3 = $_POST["notatka3"];
        mysqli_query($conn, "UPDATE notatki SET tresc='$notatka3' WHERE id=3");
    }

if (isset($_POST["zapisz4"]))
    {
        $notatka4 = $_POST["notatka4"];
        mysqli_query($conn, "UPDATE notatki SET tresc='$notatka4' WHERE id=4");
    }

if (isset($_POST["zapisz5"]))
    {
        $notatka5 = $_POST["notatka5"];
        mysqli_query($conn, "UPDATE notatki SET tresc='$notatka5' WHERE id=5");
    }

    $wynik = mysqli_query($conn, "SELECT * FROM notatki");
    $notatki = [];
    while ($wiersz = mysqli_fetch_assoc($wynik)) {
        $notatki[$wiersz["id"]] = $wiersz["tresc"];
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wariant 1 (easy)</title>
</head>
<body>
        <h1>Moje notatki</h1>

        <form method="POST">
            <h2>Notatka 1</h2>
           <textarea name="notatka1"><?= htmlspecialchars($notatki[1] ?? "") ?></textarea>
            <br><input type="submit" name="zapisz1" value="Zapisz">
            <h2>Notatka 2</h2>
            <textarea name="notatka2"><?= htmlspecialchars($notatki[2] ?? "") ?></textarea>
            <input type="submit" name="zapisz2" value="Zapisz">
            <h2>Notatka 3</h2>
            <textarea name="notatka3"><?= htmlspecialchars($notatki[3] ?? "") ?></textarea>
            <input type="submit" name="zapisz3" value="Zapisz">
            <h2>Notatka 4</h2>
            <textarea name="notatka4"><?= htmlspecialchars($notatki[4] ?? "") ?></textarea>
            <input type="submit" name="zapisz4" value="Zapisz">
            <h2>Notatka 5</h2>
            <textarea name="notatka5"><?= htmlspecialchars($notatki[5] ?? "") ?></textarea>
            <input type="submit" name="zapisz5" value="Zapisz">
        </form>

        
</body>
</html>