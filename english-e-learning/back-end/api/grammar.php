<?php
// grammar.php
require_once "../db/dbconnect.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId']; // Zorg ervoor dat dit overeenkomt met een ingelogde gebruiker
    $exerciseId = $_POST['exerciseId']; // Het ID van de huidige oefening
    $response = $_POST['response']; // De invoer van de gebruiker

    // Voer de validatie uit
    $isCorrect = validateGrammar($response);

    // Sla het antwoord op
    $responseId = saveResponse($userId, $exerciseId, $response, $isCorrect);

    // Stuur het resultaat terug naar de front-end
    echo json_encode([
        'responseId' => $responseId,
        'isCorrect' => $isCorrect
    ]);
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
