<?php $title = 'Items'?>
/*
-- Author : SEGHAIER Oussama 
*/
<?php ob_start(); ?>
<section class="my-3">
    <div class="py-3">
        <h1 class="text-center">Items</h1>
    </div>
    <?php $itemList = $this->item->getItemList(); ?>
    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0 mb-4" method="post" action="?action=searchItem">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input type="hidden" id="classID" name="classID" value="<?= $this->item->getClassID()?>">
        <input class="form-control form-control-sm ml-3 w-75" name="title" type="text" placeholder="Rechercher un item" aria-label="Rechercher">
    </form>
    <?php 
    if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
        echo "<div>
        <a href='?action=createItemForm&classID=" . $this->item->getClassID() . "' class='btn btn-primary'> Ajouter un nouvel Item </a>
    </div>";
    }
    ?>
    <div class="row">
        <?php foreach ($itemList as $item) : ?>
            <div class="col-lg-4 col-lg-offset-1">
                <div class="card">
                    <?php echo '<img src = "' . $item['imgURL'] . '" class="card-img-top">'; ?>
                    <div class="card-body">
                        <h5 class="card-title"> <?= $item['name'] ?> </h5>
                        <p class="card-text"> <?= $item['Description'] ?> </p>
                        <?php echo '<a href="?action=viewDetailedItem&itemID=' . $item['itemID'] . '" class="btn btn-primary"> Voir cet item </a>'; ?>
                        <br />
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>