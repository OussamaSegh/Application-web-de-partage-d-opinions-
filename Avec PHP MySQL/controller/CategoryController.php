<?php
/*
-- Author : SEGHAIER Oussama 
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "model/Category.php");
class CategoryController
{
    //ATTRIBUTS
    private $category;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->category = new Category();
    }

    /**
     *List all the available categories in the database
     *If the category is not instantiated, an admin could do CRUD operations on it
     */
    public function listCategories()
    {
        // load category list, which will be called in the view
        $this->category->listCategories();
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/homeView.php");
        //$this->redirection("view/homeViewAdmin.php", "view/homeView.php");
    }

    /**
     *Function to go to the page to create a category with a form
     */
    public function createCategoryForm(){
        checkAdmin();
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/createCategoryView.php");
    }

    /**
     *Function to go to the page to modify a category
     */
    public function modifyCategoryForm(){
        checkAdmin();
        if (isset($_GET['classID'])){
            $classID = ($_GET['classID']);
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/modifyCategoryView.php");
    }

    /**
     *Function to create a category
     */
    public function createCategory(){
        // check that the user is admin
        checkAdmin();
        if (
            //Check the fields are not empty
            (!empty($_POST['name'])) && 
            (!empty($_POST['description'])) && 
            (!empty($_POST['imgURL']))
            ) {
            $name = (string) strip_tags($_POST['name']);
            $description = (string) strip_tags($_POST['description']);
            $imgURL = (string) strip_tags($_POST['imgURL']);
            $date = date('Y-m-d-h-m-s');
            $this->category = new Category();
            $this->category->setName($name);
            $this->category->setDescription($description);
            $this->category->setImgURL($imgURL);
            $this->category->setDate($date);
            $this->category->createCategory();
            changeLocation("?action=home");
        } else {
            changeLocation("view/failureView.php");
        }
    }

    /**
     *Function to go modify a category
     */
    public function modifyCategory()
    {
        // check that the user is admin
        checkAdmin();
        //check the fields
        if (
            (!empty($_POST['name'])) && 
            (!empty($_POST['description'])) && 
            (!empty($_POST['imgURL'])) &&
            (isset($_POST['classID']))
            ) {
            $name = (string) strip_tags($_POST['name']);
            $description = (string) strip_tags($_POST['description']);
            $imgURL = (string) strip_tags($_POST['imgURL']);
            $classID = (string) ($_POST['classID']);
            $this->category->setName($name);
            $this->category->setDescription($description);
            $this->category->setImgURL($imgURL);
            $this->category->setClassID($classID);
            $this->category->modifyCategory();
            changeLocation("?action=home");
        } else {
            changeLocation("view/failureView.php");
        }
    }
    /**
     *Function delete a category
     */
    public function deleteCategory(){
        checkAdmin();
        if (isset($_GET['classID'])){
            $this->category->setClassID($_GET['classID']);
            $this->category->deleteCategory();
            changeLocation("?action=home");
        } else {
            changeLocation("view/failureView.php");
        }
    }

}
