<?php
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Inscription réussie!'; ?>

<!-- CAPTURE BODY -->
<?php ob_start(); ?>

<h1> Inscription réussie ! </h1>
<p>Bienvenue sur notre site <?php echo $this->user->getLastName(); ?> </p>
<p><a href="?action=home">Cliquez ici</a> pour revenir à la page d'acceuil</p>
<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");
