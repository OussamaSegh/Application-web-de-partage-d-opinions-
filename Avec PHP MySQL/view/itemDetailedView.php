<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Item'; ?>

<?php ob_start(); ?>

<h1><?php $this->item->getName() ?></h1>

<!-- get the comment list -->
<?php $commentList = $this->comment->getCommentList() ?>

<div class="container">
    <div class="row">
        <!-- ITEM DISPLAY -->
        <div class="col">
            <div class="card" style="width: 18rem;">
                <?php echo '<img src = "' . $this->item->getimgURL() . '" class="card-img-top">'; ?>
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $this->item->getName() ?> </h5>
                    <p class="card-text"> <?php echo $this->item->getDescription() ?> </p>
                    <br />
                </div>
            </div>
            <?php echo '<a href="?action=createCommentForm&itemID='.$this->item->getItemID(). '" class="btn btn-primary"> Commenter </a>'; 

            // MY COMMENT ONLY ! DISPLAY AND REVISION BUTTON UNDER (THE OTHER COMMENTS ARE DISAPLYED LATER)
            foreach ($commentList as $comment_parent) :
                if (isset($_SESSION['id'])){
                    if ($comment_parent['userID'] == $_SESSION['id']){
                        if ($comment_parent['parentID'] == NULL) { //Le commentaire initial de l'utilisateur ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5> Vos commentaires : </h5>
                                    <?php 
                                    for($i=1;$i<=5;$i++){
                                        if($i<=$comment_parent['grade']){
                                            echo '<span class="fa fa-star checked"></span>';
                                        } else {
                                            echo '<span class="fa fa-star"></span>';
                                        }
                                    } ?>
                                    </h5>
                                    <p class="card-text"> <?php echo $comment_parent['content'] ?> </p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><?php echo 'Ecrit le : '.$comment_parent['date'] ?></li>
                                        <li class="list-group-item"><?php echo 'Par : '.$comment_parent['email'] ?></li>
                                    </ul>
                                </div>
                                <?php foreach ($commentList as $comment_child) :
                                    if ($comment_child['parentID'] == $comment_parent['commentID']) { //revisions du commentaire parent ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-text"> <?php echo $comment_child['content'] ?> </p>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><?php echo 'Revisé le : '. $comment_child['date'] ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php 
                                    } 
                                endforeach; ?>
                            </div>
                            <?php echo '<a href="?action=reviseCommentForm&itemID='.$this->item->getItemID().'&commentID='.$comment_parent['commentID']. '" class="btn btn-primary"> Réviser mon commentaire </a>';
                        }
                    }
                }
            endforeach; ?>
        </div>

        <!-- COMMENTS DISPLAY -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>.checked {color: orange;}</style>
        <div class="col">
            <?php 
            foreach ($commentList as $comment_parent) : 
                if ($comment_parent['parentID'] == NULL){ // Les commentaires parents?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="list-group-item">Note : 
                            <?php 
                            for($i=1;$i<=5;$i++){
                                if($i<=$comment_parent['grade']){
                                    echo '<span class="fa fa-star checked"></span>';
                                } else {
                                    echo '<span class="fa fa-star"></span>';
                                }
                            } ?>
                            </h5>
                            <p class="card-text"> <?php echo $comment_parent['content'] ?> </p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo 'Ecrit le : '.$comment_parent['date'] ?></li>
                                <li class="list-group-item"><?php echo 'Par : '.$comment_parent['email'] ?></li>
                            </ul>
                        </div>
                        <?php foreach ($commentList as $comment_child) :
                            if ($comment_child['parentID'] == $comment_parent['commentID']) { //revisions du commentaire parent ?>
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"> <?php echo $comment_child['content'] ?> </p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><?php echo 'Revisé le : '.$comment_child['date'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php 
                            } 
                        endforeach; ?>
                    </div>
                <?php 
                } 
            endforeach; 
            ?>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>