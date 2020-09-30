<?php
//-- Author : SEGHAIER Oussama 

$title = 'Ecrire un commentaire'; ?>
<!-- CONTENT CAPTURE -->
<?php ob_start(); ?>
<h1>Ecriture d'un commentaire</h1>
<?php 
if (isset($_GET['itemID'])) {
    $itemID = (int) $_GET['itemID'];
}
echo '<form role="form" method="post" action="?action=createComment&itemID='.$itemID.'">' ; 
?>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-lg-6 col-form-label">Note (de 1 à 5) </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="grade" name="grade" min="0" max="5">
        </div>
    </div>
    <div class="form-group row">
        <label for="content" class="col-sm-2 col-lg-6 col-form-label">Commentaire</label>
        <div class="col-sm-10">
            <textarea name="content" id = "content" placeholder="commentaire"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 col-lg-6">
            <input type="submit" value="Ecrire" name="submit" class="btn btn-primary" />
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

 <!-- Load content  -->
<?php require('template.php'); ?>