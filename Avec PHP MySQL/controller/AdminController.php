<?php
/*
-- Author : SEGHAIER Oussama 
*/
require_once($_SERVER["DOCUMENT_ROOT"] . "model/Admin.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "model/Category.php");

/**
 * This class manages Admin data and views.
 * Access right management :
 * There is a checkAdmin() at the beginning of each method.
 * 
 * FOR TESTING : createFakeAdmin() creates an admin in DB, go to ...../LAMP/?action=createFakeAdmin
 * email : admin@admin.com
 * password : pwd
 */
class AdminController extends UserController
{
    //ATTRIBUT
    private $admin;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->admin = new Admin();
    }

    //GETTER
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * List the users registered on the website. 
     * Calls adminView.
     */
    public function listUsers()
    {
        // check that the user is admin
        $sid = checkUser();
        $this->admin = new Admin($sid);
        // load user list, which will be called in the view
        $this->admin->listUsers();
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/adminView.php");
    }

    /**
     * View user contributions on the website.
     * Uses UserId for the match.
     */
    public function viewUser(){
        $sid = checkUser();
        $this->admin = new Admin($sid);
        if (isset($_GET['userId'])) {
            $userId = (int) ($_GET['userId']);
            $this->admin->listUserItems($userId);
            $this->admin->listUserComments($userId);
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/userView.php");
        } else {
            $this->listUsers();
        }
    }


    /**
     * Creates a fake admin in database.
     * email : admin@admin.com 
     * password : pwd
     * ONLY FOR TESTING (no way to connect as admin otherwise because of password hashing)
     * 
     */
    public function createFakeAdmin()
    {
        // basic info
        $this->admin->setLastName("admin");
        $this->admin->setFirstName("admin");
        $this->admin->setEmail("admin@admin.com");
        $this->admin->setStatus(1);
        // hash password
        $this->admin->setPasswordHash(password_hash("pwd", PASSWORD_BCRYPT));

        // insert admin in database
        $this->admin->signinAdmin();

        // welcome
        $lastname = $this->admin->getLastName();

        // return the signin success page
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/signinSuccessView.php");
    }

    public function deleteUser()
    {
        $sid = checkUser();
        $this->admin = new Admin($sid);
        if (isset($_GET['userEmail'])) {
            $userEmail = (string) ($_GET['userEmail']);
            $this->admin->deleteUser($userEmail);
            $this->listUsers();
        } else {
            $this->listUsers();
        }
    }
    
    /**
     *Method which permits to ban a user
     */
    public function banUser()
    {
        $sid = checkUser();
        $this->admin = new Admin($sid);
        if (isset($_GET['userEmail'])) {
            $userEmail = (string) ($_GET['userEmail']);
            $this->admin->banUser($userEmail);
            $this->listUsers();
        } else {
            $this->listUsers();
        }
    }
    /**
     *Method which permits to unban a user
     */
    public function unbanUser()
    {
        $sid = checkUser();
        $this->admin = new Admin($sid);
        if (isset($_GET['userEmail'])) {
            $userEmail = (string) ($_GET['userEmail']);
            $this->admin->unbanUser($userEmail);
            $this->listUsers();
        } else {
            $this->listUsers();
        }
    }

}
