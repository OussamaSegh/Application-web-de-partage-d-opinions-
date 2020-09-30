<?php
    session_start();
    // set your own document root
    $_SERVER["DOCUMENT_ROOT"] = "D:/xampp/htdocs/projet-web-equipe-2/LAMP/";

    require_once($_SERVER["DOCUMENT_ROOT"] . "controller/Router.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "utils/functions.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "utils/checkers.php");
    $myResource = new Router();
    $myResource->routeRequest();
?>