<?php

/*
-- Author : SEGHAIER Oussama 
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "controller/UserController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "controller/ContactusController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "controller/AdminController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "controller/CategoryController.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "controller/ContributionController.php");


class Router
{
    // ATTRIBUTS
    private $UserController;
    private $AdminController;
    private $CategoryController;
    private $ContributionController;
    private $ContactusController;

    //CONSTRUCTOR 
    public function __construct()
    {
        $this->UserController = new UserController();
        $this->AdminController = new AdminController();
        $this->CategoryController = new CategoryController();
        $this->ContributionController = new ContributionController();
        $this->ContactusController = new ContactusController();
    }

    // ROUTER
    public function routeRequest()
    {
        if (isset($_GET['action'])) {
            $action = (string) $_GET['action'];
            switch ($action) {
                case "home":
                    $this->CategoryController->listCategories();
                    break;
                case "contactus":
                    $this->ContactusController->createContactusForm();
                    break;
                case "contactusSendMessage":
                    $this->ContactusController->contactusSendMessage();
                    break; 
                case "createFakeUser":
                    $this->UserController->createFakeUser();
                    break;
                case "login":
                    $this->UserController->login();
                    break;
                case "signin":
                    $this->UserController->signin();
                    break;
                case "profile":
                    $this->UserController->profile();
                    break;
                case "signinSuccess":
                    $this->UserController->signinSuccess();
                    break;
                case "updateProfile":
                    $this->UserController->updateProfile();
                    break;
                case "disconnection":
                    $this->UserController->disconnect();
                    break;
                case "createFakeAdmin":
                    $this->AdminController->createFakeAdmin();
                    break;
                case "admin":
                    $this->AdminController->listUsers();
                    break;
                case "deleteUser":
                    $this->AdminController->deleteUser();
                    break;
                case "banUser":
                    $this->AdminController->banUser();
                    break;
                case "unbanUser":
                    $this->AdminController->unbanUser();
                    break;
                case "viewUser":
                    $this->AdminController->viewUser();
                    break;
                case "viewItemsByCategory":
                    $this->ContributionController->viewItemsByCategory();
                    break;
                case "viewContributions":
                    $this->ContributionController->viewContributionsByUser();
                    break;
                case "createCategoryForm":
                    $this->CategoryController->createCategoryForm();
                    break;
                case "modifyCategoryForm":
                    $this->CategoryController->modifyCategoryForm();
                    break;
                case "createCategory":
                    $this->CategoryController->createCategory();
                    break;
                case "modifyCategory":
                    $this->CategoryController->modifyCategory();
                    break;
                case "deleteCategory":
                    $this->CategoryController->deleteCategory();
                    break;
                case "createItemForm":
                    $this->ContributionController->createItemForm();
                    break;
                case "createItem":
                    $this->ContributionController->createItem();
                    break;
                case "deleteItem":
                    $this->ContributionController->deleteItem();
                    break;
                case "viewDetailedItem":
                    $this->ContributionController->viewDetailedItem();
                    break;
                case "modifyItem":
                    $this->ContributionController->modifyItem();
                    break;
                case "searchItem":
                    $this->ContributionController->searchItem();
                    break;
                case "createCommentForm":
                    $this->ContributionController->createCommentForm();
                    break;
                case "createComment":
                    $this->ContributionController->createComment();
                    break;
                case "reviseCommentForm":
                    $this->ContributionController->reviseCommentForm();
                    break;
                case "reviseComment":
                    $this->ContributionController->reviseComment();
                    break;
                default:
                    $this->CategoryController->listCategories();
            }
        } else {
            $this->CategoryController->listCategories();
        }
    }
}
