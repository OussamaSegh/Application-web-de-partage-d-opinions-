<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Connexion réussie!'; ?>

<!-- CAPTURE BODY -->
<?php ob_start(); ?>
<h1> Vous vous êtes bien connecté ! </h1>
<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");