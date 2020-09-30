<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <?php 
    $index_uri = "http://" . $_SERVER['HTTP_HOST'] . '/projet-web-equipe-2/LAMP/';
    ?>
    <?php $actionHome = $index_uri . '?action=home' ?>
</head>

<body>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo $actionHome ?>">MyHobbies</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $actionHome ?>">Accueil<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="?action=contactus">ContactUs<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>


        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">

                <?php if (!isset($_SESSION['id']) || $_SESSION['id'] == 0) {
                    $actionLogin = $index_uri . '?action=login';
                    $actionSignin = $index_uri . '?action=signin';
                    ?>
                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo $actionLogin ?> ">Connexion</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo $actionSignin ?> ">S'inscire</a>
                </li>
            </ul>
        </div>
    </nav>
                <?php } else if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
                    $actionDisconnection =  $index_uri . '?action=disconnection';
                    $actionProfile = $index_uri . '?action=profile';
                    $actionContributions =  $index_uri . '?action=viewContributions';
                    ?>
                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo $actionDisconnection ?> ">Deconnexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo $actionProfile ?> ">Mon profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo $actionContributions ?> ">Mes contributions</a>
                </li>
                    <?php // if admin, add extra button
                    if (isset($_SESSION['status']) and $_SESSION['status'] == 1) {
                        $actionAdmin = $index_uri . '?action=admin'; ?> 
                <li class="nav-item">
                    <a class="nav-link" href=" <?php echo $actionAdmin ?> ">Page Admin</a>
                </li>
            </ul>
        </div>
    </nav> <?php
                    } else { ?>
            </ul>
        </div>
    </nav> <?php
                    }
                };
                ?>
                <!-- CONTENT -->
                <?= $content ?>
</body>

</html>