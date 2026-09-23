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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Accordion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
<body>
        <h1>Moje notatki</h1>

        <form method="POST">

    <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Notatka 1
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
    
      <textarea name="notatka1"><?= htmlspecialchars($notatki[1] ?? "") ?></textarea>
            <br><input type="submit" name="zapisz1" value="Zapisz">
    
    </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Notatka 2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <textarea name="notatka2"><?= htmlspecialchars($notatki[2] ?? "") ?></textarea>
            <br><input type="submit" name="zapisz2" value="Zapisz">
    </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Notatka 3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <textarea name="notatka3"><?= htmlspecialchars($notatki[3] ?? "") ?></textarea>
            <br><input type="submit" name="zapisz3" value="Zapisz">
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        Notatka 4
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <textarea name="notatka4"><?= htmlspecialchars($notatki[4] ?? "") ?></textarea>
            <br><input type="submit" name="zapisz4" value="Zapisz">
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFour">
        Notatka 5
      </button>
    </h2>
    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <textarea name="notatka5"><?= htmlspecialchars($notatki[5] ?? "") ?></textarea>
            <br><input type="submit" name="zapisz5" value="Zapisz">
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>




        </form>

</body>
</html>