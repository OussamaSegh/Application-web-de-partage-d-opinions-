<?php
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Modification'; ?>

<!-- CONTENT -->
<?php ob_start(); ?>

<h1>Modification d'un item</h1>

<!-- Alert is update is successful -->
<?php if(isset($_GET["modified"]) and $_GET["modified"] == "true"){ ?>
<div class="alert alert-success" role="alert">
    Modifications enregistrées.
</div>
<?php }?>

<form method="post" action="?action=modifyItem&modified=true&itemID=<?= $itemID?>">
  <div class="form-group">
    <label for="name">Nom de l'item</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->item->getName() ?>" required>
  </div>

  <div class="form-group">
    <label for="imgURL">Lien de la photo</label>
    <input type="text" class="form-control" id="imgURL" name="imgURL" value="<?php echo $this->item->getimgURL() ?>" required>
  </div>

  <div class="form-group">
    <label for="Description">Description</label>
    <input type="text" class="form-control" id="Description" name="Description" value="<?php echo $this->item->getDescription() ?>" required> 
  </div>

  <button type="submit" class="btn btn-primary">Enregistrer</button>
  <button type="reset" class="btn btn-secondary">Annuler</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>