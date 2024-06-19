$(document).ready(function() {
    // Verwijder de AJAX-aanroep voor het inlogformulier,
    // aangezien het inlogproces nu rechtstreeks via het formulier zelf wordt afgehandeld.

    // Afhandeling voor de uitlogknop, die nu direct linkt naar uw PHP-script voor uitloggen.
    // Let op: dit deel kan ook verwijderd worden als het uitloggen direct via een link gebeurt,
    // maar ik laat het staan voor het geval u nog steeds JavaScript-gebaseerde logica wilt gebruiken.
    $(document).on('click', '#logoutButton', function() {
        window.location.href = "/english-e-learning/back-end/api/logout.php";
    });
});