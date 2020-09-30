<?php

/*
-- Author : SEGHAIER Oussama 
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "model/User.php");

/**
 * This class manages user data and views.
 * 
 * FOR TESTING : createFakeUser() creates a user in DB, go to ...../User/action?createFakeUser
 * email : user@user.com
 * password : pwd
 */
class UserController
{

    //ATTRIBUTS
    private $user;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->user = new User();
    }

    //FUNCTIONS

    /**
     * Creates a fake user. To make testing easier.
     */
    public function createFakeUser(){
        $email = 'user@user.com';
        $lastname = 'fakeLastName';
        $firstname = 'fakeFirstName';
        $password = 'pwd';
        $status = 2;

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $this->user->setLastName($lastname);
        $this->user->setFirstName($firstname);
        $this->user->setEmail($email);
        $this->user->setPasswordHash($password_hash);

        // OPE : save info in DB
        $sid = $this->user->signin();

        // OPE : save session info
        $_SESSION['id'] = $sid;
        $_SESSION['status'] = 2;

        // OPE : redirect to success page
        changeLocation("?action=signinSuccess");
    }
    /**
     *function to login
     */
    public function login()
    {
        if ((isset($_SESSION['id']))) {
            changeLocation("view/loginFailureView.php?message=already_logged_in");
        }
        //case login or password empty
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['email']) || empty($_POST['password'])) {
                changeLocation("view/loginFailureView.php?message=wrong_inputs");
            } else {
                //login
                $data = User::login();
                //check if user is banned
                if ($data['banned']==1){
                    changeLocation("view/loginFailureView.php?message=account_banned");
                }
                //check the users id
                else if (password_verify($_POST['password'], $data['password_hash'])) {
                    //update the session variables
                    $_SESSION['id'] = $data['userID'];
                    $_SESSION['status'] = $data['status'];
                    $this->user = new User($_SESSION['id']);
                    changeLocation("view/loginSuccessView.php");
                }
                //case password or email is not good
                else {
                    changeLocation("view/loginFailureView.php?message=password_mismatch");
                }
            }
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/loginView.php");
    }

    /**
     * Displays the sign in form and checks input from user.
     * If all checks are validated, it updates the $user variable and calls $user->signin()
     * to update the DB.
     * 
     */
    public function signin()
    {
        // CHECK : if user already connected
        if (isset($_SESSION['id'])) {
            changeLocation("view/signinFailureView.php?message=already_logged_in");
        }
        // CHECK : if the form was filled in
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // CHECK : if inputs are set
            if (
                isset($_POST['email']) and
                isset($_POST['lastname']) and
                isset($_POST['firstname']) and
                isset($_POST['password']) and
                isset($_POST['confirmPassword'])
            ) {
                // OPE : cast posted variables and add status
                $email = (string) strip_tags($_POST['email']);
                $lastname = (string) strip_tags($_POST['lastname']);
                $firstname = (string) strip_tags($_POST['firstname']);
                $password = (string) strip_tags($_POST['password']);
                $confirmPassword = (string) strip_tags($_POST['confirmPassword']);
                $status = (int) 2;
            } else {
                changeLocation("view/signinFailureView.php?message=wrong_inputs");
            }

            // CHECK : if email already exists
            $email_free = $this->user->checkEmail($email);
            if (!$email_free) changeLocation("view/signinFailureView.php?message=email_not_free");

            // CHECK : if passwork matches password confirmation
            if ($password != $confirmPassword) changeLocation("view/signinFailureView.php?message=password_mismatch");

            // OPE : hash the password with BCRYPT
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // OPE : change user object data
            $this->user->setLastName($lastname);
            $this->user->setFirstName($firstname);
            $this->user->setEmail($email);
            $this->user->setPasswordHash($password_hash);

            // OPE : update database with user object data, get session id
            $sid = $this->user->signin();

            // OPE : save session info
            $_SESSION['id'] = $sid;
            $_SESSION['status'] = 2;

            // OPE : redirect to success page
            changeLocation("?action=signinSuccess");
        }

        // CHECK : if it is the first time on this page
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/signinView.php");
    }
    /**
     *display a page which indicate that signin is a success
     */
    public function signinSuccess()
    {
        // CHECK : if the user id is set
        if (isset($_SESSION['id'])) {
            $sid = (int) $_SESSION['id'];
            $this->user = new User();
            $this->user->getUserInfo($sid);
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/signinSuccessView.php");
        } else {
            changeLocation("?action=home");
        }
    }

    /**
     * Displays user info on the profile view page.
     * Retrieves info from the DB with getUserInfo() from User.
     */
    public function profile()
    {
        if (isset($_SESSION['id'])) {
            $sid = (int) $_SESSION['id'];
            $this->user = new User();
            $this->user->getUserInfo($sid);
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/profileView.php");
        } else {
            changeLocation("?action=home");
        }
    }


    public function updateProfile()
    {
        // CHECK : if the user is connected
        if (isset($_SESSION['id'])) {
            $sid = (int) $_SESSION['id'];
        } else {
            changeLocation("?action=home");
        }

        // CHECK : if the form is filled and the user is connected
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // CHECK : if user inputs are correct
            if (
                isset($_POST['email']) and strlen($_POST['email']) > 0 and
                isset($_POST['lastname']) and strlen($_POST['lastname']) > 0 and
                isset($_POST['firstname']) and strlen($_POST['firstname']) > 0
            ) {
                // OPE : cast posted variables and add status
                $email = (string) strip_tags($_POST['email']);
                $lastname = (string) strip_tags($_POST['lastname']);
                $firstname = (string) strip_tags($_POST['firstname']);
            }
            // OPE : update attributes
            $this->user = new User();
            $this->user->setLastName($lastname);
            $this->user->setFirstName($firstname);
            $this->user->setEmail($email);

            // OPE : update database
            $result = $this->user->updateUserInfo($sid);

            // OPE : retrieve info from DB
            $this->user->getUserInfo($sid);
        }
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/profileView.php");
    }

    /**
     *Function to disconnect the user
     */
    public function disconnect()
    {
        if (isset($_SESSION['id'])) {
            $destroyed = session_destroy();
        }
        if ($destroyed) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "view/disconnectionView.php");
        } else {
            changeLocation("index.php");
        }
    }
}
