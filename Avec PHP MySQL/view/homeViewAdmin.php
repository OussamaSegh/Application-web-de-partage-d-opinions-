
<?php
/*
-- Author : SEGHAIER Oussama 
*/

$title = 'Mon blog'; ?>

<?php $actionupdate = '?action=home' ?>
<?php $actiondelete = '?action=home' ?>

 <!-- changer l'action -->

<?php ob_start(); ?>

<section class="my-3">
    <div>
    <a href="?action=createCategoryForm" class="btn btn-success"> Create Category </a></div>


    <div class="py-3">

        <h1 class="text-center">Categories</h1>
    </div>
    <?php
            $categoryList = $this->category->getCategoryList();
            echo "<div class='container-fluid'>
            <div class='row'>";
            foreach ($categoryList as $category) {
                $nb_items = 0;
                if($nb_items == 0)
                {
                $button_update = "<a href=".$actionupdate." class='btn btn-warning'> Update </a>";  
                $button_delete = "<a href=".$actiondelete." class='btn btn-danger'> Delete </a>";    
                };
                
                echo "<div class='col-lg-6 col-md-4'>
                <div class='card align-items-center'>
                <a href=?action=viewItemsByCategory&categoryId=" . $category['classID'] . ">
                    <img class='card-img-top' src=" . $category['imgURL'] . " >
                    </a>
                    <div class='card-block text-center'>
                        <h3>" . $category['name'] . "</h3>
                        <p class='card-text'>". $category['Description']."</p>
                    <br/>
                    </div>". $button_update . "<br/>" .$button_delete ."</div> <br/>
            </div>";
            }
            ?>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>