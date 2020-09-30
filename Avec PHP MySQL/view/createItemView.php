<?php
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Créer un nouvel item'; ?>
<?php ob_start(); ?>
<h1>Création d'un item </h1>

<form role="form" method="post" action="?action=createItem">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-lg-6 col-form-label">Nom </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-lg-6 col-form-label">Description </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
        </div>
    </div>
    <div class="form-group row">
        <label for="imgURL" class="col-sm-2 col-lg-6 col-form-label">Image : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="imgURL" name="imgURL" placeholder="URL de l'image">
        </div>
    </div>
    <div>
        <input type="hidden" id="classID" name="classID" value="<?= $classID ?>">
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-lg-6">
            <input type="submit" value="Créer" name="submit" class="btn btn-primary" />
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<!-- Load content  -->
<?php require('template.php'); ?>