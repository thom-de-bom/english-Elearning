<?php
require_once "../db/dbconnect.php"; // Zorg ervoor dat dit het juiste pad is naar je database connectiescript

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['listName'])) {
    $listName = $_POST['listName'];
    $word1Array = $_POST['word1'];
    $word2Array = $_POST['word2'];

    // Eerst de lijstnaam opslaan en de ID ophalen
    $insertListSQL = "INSERT INTO wordlists (list_name) VALUES (?)";
    $stmt = $pdo->prepare($insertListSQL);
    $stmt->execute([$listName]);
    $listId = $pdo->lastInsertId(); // Haal de ID op van de nieuw aangemaakte lijst

    // Nu elk paar woorden opslaan met de verkregen listId
    $insertWordsSQL = "INSERT INTO words (list_id, word1, word2) VALUES (?, ?, ?)";
    foreach ($word1Array as $index => $word1) {
        // Zorg ervoor dat er voor elk woord1 een overeenkomstig woord2 is
        if (!empty($word1) && !empty($word2Array[$index])) {
            $word2 = $word2Array[$index];
            $stmt = $pdo->prepare($insertWordsSQL);
            $stmt->execute([$listId, $word1, $word2]);
        }
    }

    // Omleiden of bevestiging tonen na succesvol opslaan
    echo "Woordenlijst succesvol opgeslagen!";
    // Optioneel: Omleiden naar een andere pagina
    // header('Location: index.php');
    exit;
} else {
    echo "Onjuiste verzoekmethode of ontbrekende gegevens.";
}
?>
