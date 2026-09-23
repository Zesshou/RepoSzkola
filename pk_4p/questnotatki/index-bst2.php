<?php

$conn = mysqli_connect('localhost', 'root', '', 'quest_notatki');

if (!$conn) {
    die("Błąd połączenia.");
}

/*
 * Saving from JavaScript when an accordion is closed
 */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"], $_POST["tresc"])) {
    $id = (int) $_POST["id"];
    $tresc = $_POST["tresc"];

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE notatki SET tresc = ? WHERE id = ?"
    );

    mysqli_stmt_bind_param($stmt, "si", $tresc, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Content-Type: application/json");
    echo json_encode(["success" => true]);
    exit;
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
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>




        </form>

    <script>
document.querySelectorAll('.accordion-collapse').forEach(function (accordion) {
    accordion.addEventListener('hide.bs.collapse', function () {
        const textarea = accordion.querySelector('textarea');

        if (!textarea) {
            return;
        }

        // Extract the note ID from the textarea name:
        // notatka1 -> 1, notatka2 -> 2, etc.
        const id = textarea.name.replace('notatka', '');

        const formData = new FormData();
        formData.append('id', id);
        formData.append('tresc', textarea.value);

        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (!data.success) {
                console.error('Nie udało się zapisać notatki.');
            }
        })
        .catch(function (error) {
            console.error('Błąd zapisu:', error);
        });
    });
});
</script>



</body>
</html>