<?php
/*
-- Author : SEGHAIER Oussama 
*/
// TODO : mettre les vérifications dans le controlleur.

// this page is accessible only if user not connected
if (
    isset($_SESSION['id']) or
    isset($_SESSION['email']) or
    isset($_SESSION['status'])
) {
    changeLocation("index.php");
}

// check if the message is set, otherwise redirect to main page
if (isset($_GET['message'])) {
    $message = $_GET['message'];
} else {
    changeLocation("index.php");
}
?>


<?php $title = 'Erreur'; ?>

<!-- CAPTURE BODY -->
<?php ob_start(); ?>

<h1> Erreur de connexion </h1>
<p>
    <?php
    switch ($message) {
        case "already_logged_in":
            echo '<br> Vous êtes déjà connecté. </br>
                Veuillez vous déconnecter si vous souhaitez créer un nouveau compte.';
            break;

        case "password_mismatch":
            echo "Email ou mot de passe incorrect.";
            break;

        case "wrong_inputs":
            echo "Vous n'avez pas rempli correctement les champs.";
            break;

        case "account_banned":
            echo "Votre compte est bloqué, vous ne pouvez pas vous connecter.";
            break;   
    }
    ?>
</p>

<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");