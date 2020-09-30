<?php
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Déconnexion réussie!'; ?>

<!-- CAPTURE BODY -->
<?php ob_start(); ?>
<h1> Vous vous êtes bien déconnecté ! </h1>
<p><a href="?action=home">Cliquez ici</a> pour revenir à la page d'acceuil</p>
<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");