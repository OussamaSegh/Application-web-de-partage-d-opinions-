<?php 
/*
-- Author : SEGHAIER Oussama 
*/
$title = "Page d'administration"; ?>

<!-- TODO : 
- mettre les infos utilisateurs dans un tableau

- faire en sorte que la page se reload quand on a appuyé sur le bouton delete/ban
 -->
<!-- CAPTURE BODY -->
<?php ob_start(); ?>

<h2> Page d'administration </h2>
<section>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Bloqué</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $userList = $this->admin->getUserList();
            foreach ($userList as $user) {
                $userId = $user['userID'];
                $email = $user['email']; ?>
                <tr>
                    <th scope="row"> <?php echo $user['userID'] ?> </td>
                    <td> <?php echo $user['banned'] ?> </td>
                    <td> <?php echo $user['last_name'] ?> </td>
                    <td> <?php echo $user['first_name'] ?> </td>
                    <td> <?php echo $user['email'] ?> </td>
                    <td><a href='?action=deleteUser&userEmail=$email'>Supprimer</a></td>
            <?php
                    if (isset($user['banned']) and $user['banned']==0) { ?>
                        <td><a href='?action=banUser&userEmail=<?php echo $email ?>'>Bloquer</a></td>
                    <?php } else { ?>
                        <td><a href='?action=unbanUser&userEmail=<?php echo $email ?>'>Débloquer</a></td>
                    <?php } ?>
                    <td><a href='?action=viewUser&userId=<?php echo $userId ?>'>Voir les contributions</a></td>
                    <tr>
            <?php } ?>
        </tbody>
    </table>
</section>
        </br>
<a class="btn btn-primary" href="?action=createCategoryForm" role="button">Ajouter une categorie</a>

<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");
