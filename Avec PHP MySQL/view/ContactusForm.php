<?php
/*
-- Author : SEGHAIER Oussama 

*/
$title = 'Nous Contacter formulaire'; ?>
<!-- CONTENT CAPTURE -->
<?php ob_start(); ?>
<h1>Nous Contacter : </h1>
<form role="form" method="post" action="?action=contactusSendMessage">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-lg-6 col-form-label">Prénom </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom">
        </div>
    </div>
	<div class="form-group row">
        <label for="name" class="col-sm-2 col-lg-6 col-form-label">Nom </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom">
        </div>
    </div>
    <div class="form-group row">
        <label for="mail" class="col-sm-2 col-lg-6 col-form-label">email</label>
        <div class="col-sm-10">
            <input type="mail" class="form-control" id="email_contact" name="email_contact" placeholder="Votre email">
        </div>
    </div>
    <div class="form-group row">
        <label for="imgURL" class="col-sm-2 col-lg-6 col-form-label">Message </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="comment" name="comment" placeholder="Écrivez votre message ici ..">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-lg-6">
            <input type="submit" value="Envoyer" name="submit" class="btn btn-primary" />
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

 <!-- Load content  -->
<?php require('template.php'); ?>