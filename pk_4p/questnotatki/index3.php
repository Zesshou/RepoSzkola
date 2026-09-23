<?php
$conn = mysqli_connect('localhost', 'root', '', 'quest_notatki');

if (!$conn) {
    die("Błąd połączenia.");
}

mysqli_set_charset($conn, 'utf8mb4');

if (isset($_POST['ajax']) && $_POST['ajax'] === '1') {
    header('Content-Type: application/json; charset=utf-8');

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $tresc = $_POST['tresc'] ?? '';

    if ($id === false || $id < 1 || $id > 5) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Nieprawidłowe ID notatki.']);
        exit;
    }

    $zapytanie = mysqli_prepare($conn, 'UPDATE notatki SET tresc = ? WHERE id = ?');
    mysqli_stmt_bind_param($zapytanie, 'si', $tresc, $id);

    if (!mysqli_stmt_execute($zapytanie)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Nie udało się zapisać notatki.']);
        exit;
    }

    echo json_encode(['success' => true]);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wariant 3 (not as easy)</title>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>
  <script>
  $( function() {
        $( "#accordion" ).accordion({
            collapsible: true,
            beforeActivate: function(event, ui) {
                if (!ui.oldPanel.length) {
                    return;
                }

                const panel = ui.oldPanel;
                const id = panel.data('note-id');
                const tresc = panel.find('textarea').val();

                $.ajax({
                    url: window.location.href,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        ajax: '1',
                        id: id,
                        tresc: tresc
                    }
                }).done(function(odpowiedz) {
                    if (odpowiedz.success) {
                        $('#save-status').text('Zapisano.');
                    }
                }).fail(function() {
                    $('#save-status').text('Błąd zapisu.');
                });
            }
        });
  } );
  </script>
</head>
<body>
        <h1>Moje notatki</h1>

<div id="accordion">
  <h3>Notatka 1</h3>
    <div data-note-id="1">
    <textarea name="notatka1"><?= htmlspecialchars($notatki[1] ?? "") ?></textarea>
  </div>
  <h3>Notatka 2</h3>
    <div data-note-id="2">
    <textarea name="notatka2"><?= htmlspecialchars($notatki[2] ?? "") ?></textarea>
  </div>
  <h3>Notatka 3</h3>
    <div data-note-id="3">
     <textarea name="notatka3"><?= htmlspecialchars($notatki[3] ?? "") ?></textarea>
  </div>
  <h3>Notatka 4</h3>
    <div data-note-id="4">
    <textarea name="notatka4"><?= htmlspecialchars($notatki[4] ?? "") ?></textarea>
  </div>
  <h3>Notatka 5</h3>
    <div data-note-id="5">
    <textarea name="notatka5"><?= htmlspecialchars($notatki[5] ?? "") ?></textarea>
  </div>
</div>
<p id="save-status" aria-live="polite"></p>


    </body>
</html>