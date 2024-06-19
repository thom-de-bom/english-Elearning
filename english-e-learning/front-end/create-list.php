<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h2>Maak een nieuwe woordenlijst</h2>
    <form id="wordListForm" action="\english-e-learning\back-end\api\words.php" method="POST">

        <div class="form-group">
            <label for="listName">Naam van woordenlijst:</label>
            <input type="text" class="form-control" id="listName" name="listName" required>
        </div>

        <div id="wordPairs">
            <div class="form-row align-items-center mb-2">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Woord 1" name="word1[]">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Woord 2" name="word2[]">
                </div>
            </div>
        </div>

        <button type="button" id="addPair" class="btn btn-secondary">Voeg woordpaar toe</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Functie om extra woordparen toe te voegen
    $("#addPair").click(function() {
        var pairHtml = `<div class="form-row align-items-center mb-2">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Woord 1" name="word1[]">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Woord 2" name="word2[]">
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger removePair">Verwijder</button>
                            </div>
                        </div>`;
        $("#wordPairs").append(pairHtml);
    });

    // Functie om woordparen te verwijderen
    $(document).on('click', '.removePair', function() {
        $(this).closest('.form-row').remove();
    });

    // AJAX-verzending van het formulier
    $("#wordListForm").submit(function(e) {
        e.preventDefault(); // Voorkom het standaard verzendgedrag

        var formData = $(this).serialize(); // Verzamel de formuliergegevens

        $.ajax({
            type: "POST",
            url: $(this).attr('action'), // De URL naar de words.php zoals gedefinieerd in het 'action' attribuut van het form
            data: formData,
            success: function(response) {
                alert("Woordenlijst succesvol opgeslagen!");
                // Optioneel: redirect naar een andere pagina
                window.location.href = "/english-e-learning/front-end/index.php";
            },
            error: function() {
                alert("Er was een probleem met het opslaan van de woordenlijst.");
            }
        });
    });
});
</script>

   <!-- Voeg de Bootstrap JS en afhankelijke Popper.js toe -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>