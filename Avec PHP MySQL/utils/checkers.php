<?php
/*
-- Author : SEGHAIER Oussama 
*/


/**
 * Functions to check access rights.
 */

require_once($_SERVER["DOCUMENT_ROOT"] . "utils/functions.php");

/**
 * check if the person is User and returns its it.
 * go to home page otherwise.
 */
function checkUser()
{
    if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
        return (int) $_SESSION['id'];
    } else {
        changeLocation("?action=home");
    }
}

/**
 * Check that the user is allowed to go on admin page.
 * Instanciate the admin object if yes.
 * Use it at the beginning of all admin methods.
 */
function checkAdmin()
{
    if (isset($_SESSION['id']) and $_SESSION['status'] == 1) {
        return (int) $_SESSION['id'];
    } else {
        changeLocation("?action=home");
    }
}

/**
 * Check that the itemID field is set.
 * Go to home page otherwise.
 */
function checkItem(){
    if(isset($_GET['itemID']) and $_GET['itemID']>0){
        return (int) $_GET['itemID'];
    } else {
        changeLocation("?action=home");
    }
}

/**
 * Check that the commentID field is set.
 * Go to home page otherwise.
 */
function checkComment(){
    if(isset($_GET['commentID']) and $_GET['commentID']>0){
        return (int) $_GET['commentID'];
    } else {
        changeLocation("?action=home");
    }
}
