<?php
require_once "../db/dbconnect.php";

// Controleer of het een POST verzoek is
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitatie en validatie van de input zou hier moeten gebeuren

    // Query om de gebruiker op te zoeken
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Start de sessie en zet de gebruikers-ID
        session_start();
        $_SESSION['user_id'] = $user['id'];

        header('Location: /english-e-learning/front-end/index.php'); // Redirect terug naar de homepage
    } else {
        echo json_encode(['success' => false, 'message' => 'Verkeerde gebruikersnaam of wachtwoord']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Onjuiste verzoekmethode.']);
}
?>
