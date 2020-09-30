<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Réviser un commentaire'; ?>
<!-- CONTENT CAPTURE -->
<?php ob_start(); ?>
<h1>Révision de de votre commentaire</h1>
<?php 
if ( isset($_GET['commentID']) && isset($_GET['itemID']) ) {
    $commentID = (int) $_GET['commentID'];
    $itemID = (int) $_GET['itemID'];
}

echo '<form role="form" method="post" action="?action=reviseComment&commentID='.$commentID.'&itemID='.$itemID.'">' ; 
?>
    <div class="form-group row">
        <label for="content" class="col-sm-2 col-lg-6 col-form-label">Révision de votre commentaire</label>
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