<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Connexion'; ?>

<!-- CONTENT -->
<?php ob_start(); ?>
<form role="form" method="post" action="?action=login">
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-lg-6 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-lg-6 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-lg-6">
            <input type="submit" value="Connexion" name="submit" class="btn btn-primary" />
            <a class="btn btn-secondary" href="?action=signin" role="button">Pas encore de compte ?</a>
        </div>
    </div>
</form>'
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>