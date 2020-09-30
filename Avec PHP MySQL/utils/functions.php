<?php

/*
-- Author : SEGHAIER Oussama 
*/


function erreur($err = '')
{
   $mess = ($err != '') ? $err : 'Une erreur inconnue s\'est produite';
   exit('<p>' . $mess . '</p>
   <p>Cliquez <a href="home.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
}

function changeLocation($page)
{
   $host  = $_SERVER['HTTP_HOST'];
   $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   header("Location: http://$host$uri/$page");
   exit;
}
