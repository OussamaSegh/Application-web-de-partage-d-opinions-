<?php
/*
-- Author : SEGHAIER Oussama 
*/
require_once($_SERVER["DOCUMENT_ROOT"] . "config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "model/Item.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "model/Comment.php");


/**
 * This class manages items data and views.
 */
class ContributionController
{

    // ATTRIBUTS
    private $item;
    private $comment;
    private $category;

    // CONSTRUCTOR
    public function __construct()
    {
        $this->item = new Item();
        $this->comment = new Comment();
        $this->category = new Category();

    }

    // METHODS
    /**
     *Function to see all the items in a category
     */
    public function viewItemsByCategory()
    {
        if (isset($_GET["categoryId"])) {
            $categoryID = $_GET["categoryId"];
            $this->item->setCategory($categoryID);
            $this->item->listItemsByCategory($categoryID);
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/itemView.php");
        } else {
            changeLocation("?action=home");
        }
    }

    /**
     * Get comments based on UserID. 
     */
    public function viewContributionsByUser()
    {
        $userId = checkUser();
        $this->comment->listCommentsByUserId($userId);
        $this->item->listItemsByUser($userId);
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/contributionsView.php");
    }
    /**
     *Function search an item in a category
     */
    public function searchItem()
    {
        if (isset($_POST['title']) && (!empty($_POST['title'])) && isset($_POST['classID'])) {
            $categoryID = $_POST['classID'];
            $this->item->setCategory($categoryID);
            $title = htmlspecialchars($_POST['title']);
            $this->item->searchItem($title, $categoryID);
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/itemView.php");
        }
    }

    /**
     * Display item info.
     * Called when someone clicks "go" on the item.
     */
    public function viewDetailedItem()
    {
        if (isset($_GET['itemID'])) {
            $itemID = (int) $_GET['itemID'];
            $this->item->getItemInfo($itemID);
            $this->item->setItemID($itemID);
            $this->comment->listCommentsByItemId($itemID);
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/itemDetailedView.php");
        } else {
            changeLocation("?action=home");
        }
    }


    /**
     *Function to go to the page to create an item with a form
     */
    public function createItemForm()
    {
        checkUser();
        if (isset($_GET['classID'])){
            $classID = ($_GET['classID']);
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/createItemView.php");
    }

    /**
     *Function to create an item
     */
    public function createItem()
    {
        // check that the user is connected 
        $userId = checkUser();

        //Check the fields
        if(isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['description']) && !empty($_POST['description']) &&
        isset($_POST['imgURL']) && !empty($_POST['imgURL']) &&
        isset($_POST['classID']) && !empty($_POST['classID'])
        ) {
            $name = (string) strip_tags($_POST['name']);
            $description = (string) strip_tags($_POST['description']);
            $imgURL = (string) strip_tags($_POST['imgURL']);
            $this->item = new Item();
            $this->item->setName($name);
            $this->item->setDescription($description);
            $this->item->setImgURL($imgURL);
            $this->item->setCategory($_POST['classID']);
            $this->item->setUserID($userId);
            $this->item->createItem();
            $this->category->instantiateCategory($_POST['classID']);
            changeLocation("view/successView.php");
        } else {
            changeLocation("view/failureView.php");
        }
    }

    /**
     * Modify item info. Checks that the user is allowed to do so
     */
    public function modifyItem()
    {
        // check that the user is connected 
        $sid = checkUser();

        // get the item to modify
        $itemID = checkItem();
        $this->item->getItemInfo($itemID);

        // check that the user is allowed to modify the item
        // or if it is an admin
        if ($this->item->getUserID() == $sid) {
        } elseif (isset($_SESSION["status"]) and $_SESSION["status"] == 1) {
        } else {
            changeLocation("?action=home");
        }

        // if POST treat information :
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) and isset($_POST['imgURL']) and isset($_POST['Description'])) {
                $name = (string) strip_tags($_POST['name']);
                $imgURL = (string) strip_tags($_POST['imgURL']);
                $Description = (string) strip_tags($_POST['Description']);
                $this->item->setName($name);
                $this->item->setImgURL($imgURL);
                $this->item->setDescription($Description);
                // update info in DB
                $this->item->modifyItem($itemID);
                // update info for the view
                $this->item->getItemInfo($itemID);
            }
        }

        // display page
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/modifyItemView.php");
    }

    /**
     * Deletes item based on its ID.
     * Activated from the "Mes contributions" page.
     */
    public function deleteItem()
    {
        $userId = checkUser();
        $itemId = checkItem();
        // check user can delete this item
        $this->item->getItemInfo($itemId);
        if ($userId == $this->item->getUserID()) {
            $this->item->deleteItem($itemId);
            $this->viewContributionsByUser();
        } else {
            changeLocation("?action=home");
        }
    }
    /**
     *Function to go to the page to comment an item with a form
     */
    public function createCommentForm()
    {
        $userID = checkUser();
        $itemID = checkItem();
        //check if it is his first comment on this item
        $this->comment->commentsByItemIDAndUserID($itemID, $userID);
        if (sizeof($this->comment->getCommentList()) == 0) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/createCommentView.php");
        } else {
            changeLocation("?action=home");
        }
    }
    /**
     *Function to go to the page to create a comment on an item
     */
    public function createComment()
    {
        //check that a user is logged in
        $userID = checkUser();
        $itemID = checkItem();
        if (
            //Check the fields are not empty
            (!empty($_POST['grade'])) &&
            (!empty($_POST['content']))
        ) {
            $grade = (int) strip_tags($_POST['grade']);
            $content = (string) strip_tags($_POST['content']);
            $this->comment = new Comment();
            $this->comment->setUserID($userID);
            $this->comment->setItemID($itemID);
            $this->comment->setGrade($grade);
            $this->comment->setContent($content);
            $this->comment->createComment();
            changeLocation("?action=home");
        } else {
            changeLocation("view/failureView.php");
        }
    }
    /**
     *Function to go to the page to revise a comment with a form
     */
    public function reviseCommentForm()
    {
        $userID = checkUser();
        $commentID = checkComment();
        //check if the user is the owner comment on this item
        $this->comment->setCommentID($commentID);
        $this->comment->getAuthor();
        if ($this->comment->getUserID() == $_SESSION['id']) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/reviseCommentView.php");
        } else {
            changeLocation("?action=home");
        }
    }
    /**
     *Function to revise a comment
     */
    public function reviseComment()
    {
        //check that a user is logged in
        $userID = checkUser();
        $itemID = checkItem();
        $commentID = checkComment();
        if (
            //Check the fields are not empty
            (!empty($_POST['content']))
        ) {
            $content = (string) strip_tags($_POST['content']);
            $this->comment = new Comment();
            $this->comment->setUserID($userID);
            $this->comment->setItemID($itemID);
            $this->comment->setContent($content);
            $this->comment->setParentID($commentID);
            $this->comment->reviseComment();
            changeLocation("?action=home");
        } else {
            changeLocation("view/failureView.php");
        }
    }
}
