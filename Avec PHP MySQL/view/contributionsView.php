
<?php
//-- Author : SEGHAIER Oussama 

$title = 'Mes contributions'; ?>

<?php ob_start(); ?>

<?php $itemList = $this->item->getItemList(); ?>
<?php $commentList = $this->comment->getCommentList(); ?>
<section class="container">
    <h1>Items</h1>
    <div class="row">
        <?php foreach ($itemList as $item) : ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $item['imgURL'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item['name'] ?></h5>
                    <p class="card-text"><?php echo $item['Description'] ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Catégorie : <?php echo $item['category'] ?></li>
                    <li class="list-group-item">Note : <?php echo $item['note'] ?></li>
                </ul>
                <div class="card-body">
                    <a href="?action=deleteItem&itemID=<?php echo $item['itemID']?>" 
                        onclick="return confirm('Etes-vous sûr de vouloir supprimer <?php echo $item['name']?>?')" 
                        class="card-link">Supprimer</a>
                    <a href="?action=modifyItem&itemID=<?php echo $item['itemID']?>" class="card-link">Modifier</a>
                    <a href="#" class="card-link">Commenter</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>.checked {color: orange;}
</style>
    <h1>Commentaires</h1>
    <div class="row">
        <?php foreach ($commentList as $comment) : ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $comment['name'] ?></h5>
                    <p class="card-text"><?php echo $comment['content'] ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Date : <?php echo $comment['date'] ?></li>
                    <li class="list-group-item">Note : 
                        <?php for($i=1;$i<=5;$i++){
                                if($i<=$comment['grade']){
                                    echo '<span class="fa fa-star checked"></span>';
                                }else{
                                    echo '<span class="fa fa-star"></span>';
                                }
                    }?></li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Reviser ce commentaire</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>





<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");
