<?php
// dbconnect.php
$host = 'localhost'; // of uw database server
$db   = 'bek_db'; // de naam van uw database
$user = 'root'; // de database gebruiker
$pass = ''; // het wachtwoord van de database gebruiker
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function validateGrammar($input) {
    // Dit is een dummy functie, de logica voor de validatie moet nog geïmplementeerd worden
    // U zou hier een API kunnen aanroepen of een algoritme kunnen implementeren om de grammatica te controleren.
    return true; // Stel dat alle invoer voor nu correct is
}

function saveResponse($userId, $exerciseId, $response, $isCorrect) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user_responses (user_id, exercise_id, response, is_correct) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $exerciseId, $response, $isCorrect]);
    return $pdo->lastInsertId(); // Geeft het ID van de ingevoerde respons terug
}
?>
