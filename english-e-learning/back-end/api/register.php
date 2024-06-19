<?php
// Voeg de database connectiebestand toe
require_once "../db/dbconnect.php";

// Controleer of het een POST verzoek is
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['new_username'] ?? '';
    $email = $_POST['new_email'] ?? '';
    $password = $_POST['new_password'] ?? '';

    // Sanitatie en validatie van de input zou hier moeten gebeuren

    // Controleer of de gebruikersnaam of e-mail al bestaat
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        echo json_encode(['success' => false, 'message' => 'Gebruikersnaam of e-mail bestaat al']);
    } else {
        // Wachtwoord hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Nieuwe gebruiker invoeren in de database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $result = $stmt->execute([$username, $email, $hashedPassword]);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Registratie mislukt']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Onjuiste verzoekmethode.']);
}
?>
