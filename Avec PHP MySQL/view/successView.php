<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Echec'; ?>

<!-- CAPTURE BODY -->
<?php ob_start(); ?>
<h1> Votre action est un succès ! </h1>
<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");