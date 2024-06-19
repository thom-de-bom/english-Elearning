<?php
include "dbconnect.php";
if (!isset($_GET['id'])) {
    header('Location: index.php'); // Redirect als er geen ID is
    exit;
}
$listId = $_GET['id'];

// Haal de lijstnaam en woorden op
$stmt = $pdo->prepare("SELECT list_name FROM wordlists WHERE id = ?");
$stmt->execute([$listId]);
$listName = $stmt->fetchColumn();

$wordsStmt = $pdo->prepare("SELECT id, word1, word2 FROM words WHERE list_id = ?");
$wordsStmt->execute([$listId]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Woordenlijst Oefening</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- Navigatiebalk -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">BEK</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create-list.php">Woordenlijsten Aanmaken</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a class="btn btn-primary" href="/english-e-learning/back-end/api/logout.php">Uitloggen</a>
                    <?php else: ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Inloggen</button>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    
<div class="container mt-5">
    <h2>Oefen: <?php echo htmlspecialchars($listName); ?></h2>
    <!-- Uitleg voor de gebruiker -->
    <p>Vertaal de volgende woorden naar het Nederlands en vul je antwoord in. Klik op 'Controleer Antwoorden' om je antwoorden te controleren.</p>
    <form id="wordTestForm">
        <?php while ($word = $wordsStmt->fetch()): ?>
            <div class="form-group">
                <label><?php echo htmlspecialchars($word['word1']); ?></label>
                <input type="text" class="form-control" name="answer[]" data-correct="<?php echo htmlspecialchars($word['word2']); ?>">
                <small class="form-text text-muted result"></small>
            </div>
        <?php endwhile; ?>
        <button type="button" id="checkAnswers" class="btn btn-primary">Controleer Antwoorden</button>
    </form>
    <!-- Knop om terug te gaan naar index, standaard verborgen -->
    <button type="button" id="backToIndex" class="btn btn-secondary mt-3" style="display:none;" onclick="window.location.href='index.php';">Terug naar overzicht</button>
</div>

<script>
$(document).ready(function() {
    $("#checkAnswers").click(function() {
        $('input[name="answer[]"]').each(function() {
            var correctAnswer = $(this).data('correct');
            var userAnswer = $(this).val();
            if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
                $(this).next('.result').text('Correct!').css('color', 'green');
            } else {
                $(this).next('.result').text('Fout, het juiste antwoord was: ' + correctAnswer).css('color', 'red');
            }
        });
        // Toon de knop om terug te gaan naar index na het controleren van antwoorden
        $("#backToIndex").show();
    });
});
</script>

</body>
</html>
