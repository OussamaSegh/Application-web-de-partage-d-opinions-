<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = 'Contributions'; ?>

<!-- CONTENT -->
<?php ob_start(); ?>

<!-- TODO : instanciate a user instead, to have all its info -->
<!-- TODO : action on the items and on the comments (delete) -->
<h2>Contributions de l'utilisateur </h2>

<section>
    <!-- Items -->
    <h3> ITEMS </h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Notation</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $userItems = $this->admin->getUserItems();
            foreach ($userItems as $item) {
                $itemId = $item['itemID'];
                echo
                "<tr>
                    <th scope='row'>" . $item['itemID'] . "</th>
                    <td>" . $item['name'] . "</td>
                    <td>" . $item['Description'] . "</td>
                    <td>" . $item['category'] . "</td>
                    <td>" . $item['note'] . "</td>
                    <td><a href='?action=deleteItem&itemId=$itemId'>Supprimer</a></td>"
                    ;
                    echo "<tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Comments  -->
    <h3> COMMENTS </h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ItemID</th>
                <th scope="col">Contenu</th>
                <th scope="col">Note</th>
                <th scope="col">Banni</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $userComments = $this->admin->getUserComments();
            foreach ($userComments as $comment) {
                $commentId = $comment['commentID'];
                echo
                "<tr>
                    <th scope='row'>" . $comment['commentID'] . "</th>
                    <td>" . $comment['itemID'] . "</td>
                    <td>" . $comment['content'] . "</td>
                    <td>" . $comment['grade'] . "</td>
                    <td>" . $comment['isBanned'] . "</td>
                    <td>" . $comment['date'] . "</td>
                    <td><a href='?action=deleteComment&commentId=$commentId'>Supprimer</a></td>
                    <td><a href='?action=banComment&commentId=$commentId'>Bloquer</a></td>"
                    ;
                    echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<?php $content = ob_get_clean(); ?>

 <!-- Load content  -->
<?php require('template.php'); ?>