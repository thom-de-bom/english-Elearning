<?php
session_start();
session_unset();
session_destroy();

header('Location: /english-e-learning/front-end/index.php'); // Redirect terug naar de homepage
exit();
?>
