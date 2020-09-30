<?php
/*
-- Author : SEGHAIER Oussama 

*/

$title = 'Message Envoyée!'; ?>

<!-- CAPTURE BODY -->
<?php ob_start(); ?>

<h1> Votre message nous a bien été transmis ! </h1>
<h2>Surveillez bien vos mail dans les prochaines jours</br>
nous vous enverrons une réponse rapidement </br>
à bientôt !
</h2>

<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");
