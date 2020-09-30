<?php
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Profil'; ?>

<!-- CONTENT -->
<?php ob_start(); ?>

<h2>Informations du compte</h2>
<form role="form" method="post" action="?action=updateProfile">
    <div class="form-group row">
        <label for="lastname" class="col-sm-2 col-lg-6 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" value=<?php echo $this->user->getLastName() ?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-lg-6 col-form-label">Prénom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" value=<?php echo $this->user->getFirstName() ?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-lg-6 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $this->user->getEmail() ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-lg-6">
            <input type="submit" value="Enregistrer" name="submit" class="btn btn-primary" />
            <input type="reset" value="Annuler" name="cancel" class="btn btn-secondary" />
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>