<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Inscription'; ?>
<!-- CONTENT CAPTURE -->
<?php ob_start(); ?>
<h1>Inscription</h1>
<form role="form" method="post" action="?action=signin">
    <div class="form-group row">
        <label for="lastname" class="col-sm-2 col-lg-6 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
        </div>
    </div>
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-lg-6 col-form-label">Prénom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-lg-6 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Adresse mail">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-lg-6 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Mot de passe">
        </div>
    </div>
    </div>
    <div class="form-group row">
        <label for="confirmPassword" class="col-sm-2 col-lg-6 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-lg-6">
            <input type="submit" value="S'inscrire" name="submit" class="btn btn-primary" />
            <a class="btn btn-secondary" href="?action=login" role="button">Vous avez déjà un compte ?</a>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

 <!-- Load content  -->
<?php require('template.php'); ?>