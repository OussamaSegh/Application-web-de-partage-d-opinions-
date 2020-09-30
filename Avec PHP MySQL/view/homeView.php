<?php
/*
-- Author : SEGHAIER Oussama 

*/

$title = 'Mon blog'; ?>

<?php ob_start(); ?>
<section class="my-3">
    <div class="py-3">

        <h1 class="text-center">Categories</h1>
    </div>
    <?php
            $categoryList = $this->category->getCategoryList();
            echo "<div class='container-fluid'>
            <div class='row'>";
            foreach ($categoryList as $category) {
                echo "<div class='col-lg-6 col-md-4'>
                <div class='card align-items-center'>
                <a href=?action=viewItemsByCategory&categoryId=" . $category['classID'] . ">
                    <img class='card-img-top' src=" . $category['imgURL'] . " >
                    </a>
                    <div class='card-block text-center'>
                        <h3>" . $category['name'] . "</h3>";
                if (isset($_SESSION['status']) and $_SESSION['status'] == 1 && $category['instantiated']== 0){
                    echo "<a class='btn btn-primary mr-3' href='?action=modifyCategoryForm&classID=" . $category['classID'] ."role='button'>Modifier</a>";
                    echo "<a class='btn btn-danger' href='?action=deleteCategory&classID=" . $category['classID'] ."role='button'>Supprimer</a>";
                }
                    echo "</div>
                </div>
            </div>";
            }
            ?>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>