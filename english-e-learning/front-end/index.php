<?php
require_once "dbconnect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>BEK Oefeningen</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <script src="js/jquery-3.6.0.min.js"></script> -->
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BEK - Oefen Engelse Grammatica</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Voeg de Bootstrap CSS toe voor styling en layout -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    
        <div class="container mt-5" id="video">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe src="./assets/english-Elearning.mp4" frameborder="1"></iframe>
            </div>
        </div>




    <div class="container mt-5" id="lists">
    <h2>Beschikbare Woordenlijsten</h2>
    <div class="list-group">
        <?php
        $stmt = $pdo->query("SELECT id, list_name FROM wordlists");
        while ($row = $stmt->fetch()) {
            echo '<a href="wordlist.php?id=' . $row['id'] . '" class="list-group-item list-group-item-action">' . htmlspecialchars($row['list_name']) . '</a>';
        }
        ?>
        </div>
    </div>



    <!-- Inlog Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Inloggen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="login-form" action="/english-e-learning/back-end/api/inlog.php" method="POST">
                    <div class="form-group">
                            <label for="username">Gebruikersnaam</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                        <button type="submit" class="btn btn-primary">Inloggen</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Gebruiker Aanmaken</button>
                </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Registratie Modal -->
     <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Gebruiker Aanmaken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="register-form">
                        <div class="form-group">
                            <label for="new_username">Gebruikersnaam</label>
                            <input type="text" class="form-control" id="new_username" required>
                        </div>
                        <div class="form-group">
                            <label for="new_email">E-mailadres</label>
                            <input type="email" class="form-control" id="new_email" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Wachtwoord</label>
                            <input type="password" class="form-control" id="new_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registreren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Voeg de Bootstrap JS en afhankelijke Popper.js toe -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
