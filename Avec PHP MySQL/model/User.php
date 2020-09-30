<?php
/*
-- Author : SEGHAIER Oussama 
*/


require_once($_SERVER["DOCUMENT_ROOT"] . "config.php");

/**
 * This class interacts with DB.
 * 
 * FOR TESTING : createFakeUser() creates a user in DB, go to ...../User/action?createFakeUser
 * email : user@user.com
 * password : pwd
 */
class User
{
    //ATTRIBUTS
    protected $last_name;
    protected $first_name;
    protected $email;
    protected $password_hash;
    protected $status;
    protected $banned;
    protected $myItems = array();
    protected $myComments = array();

    //CONSTRUCTOR
    public function __construct()
    {
        $this->status = 2;
        $this->banned = 0;
    }

    //GETTERS : GETS INFO FROM THE DATABASE
    public function getLastName()
    {
        return $this->last_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password_hash;
    }

    public function getMyItems(){
        return $this->myItems;
    }

    public function getMyComments(){
        return $this->myComments;
    }
    //SETTERS : SETS INFO FOR THE OBJECT
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPasswordHash($password_hash)
    {
        $this->password_hash = $password_hash;
    }

    /**
     * Main getter. Retrieves user info from DB based on a session ID. 
     * Fills the attributes of the object.
     * Has to be called before all other getters, otherwise the object attributes are empty.
     * 
     * @param $sid : the user session ID.
     */
    public function getUserInfo($userID)
    {
        // retrieves info from DB
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT first_name, last_name, email, password_hash, status FROM Users WHERE userID = :userID');
        $query->bindValue(':userID', $userID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        // update attributes
        $this->last_name = $data['last_name'];
        $this->first_name = $data['first_name'];
        $this->email = $data['email'];
        $this->password_hash = $data['password_hash'];
        $this->status = $data['status'];
    }


    /**
     * Get items from the User based on its ID.
     */
    public function getItems($userID)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT itemID, name, imgURL, category, Description, note 
                                    FROM Items 
                                    WHERE userID = :userID');
        $query->bindValue(':userID', $userID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->myItems = $data;
    }


    /**
     * Get comments from the User based on its ID.
     * Join Items table to get the name of the commented item.
     */
    public function getComments($userID)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT c.commentID, c.itemID, c.content, c.grade, c.isBanned, c.date, i.name
                                    FROM Comments as c
                                    LEFT JOIN Items as i ON i.itemID = c.itemID
                                    WHERE c.userID = :userID');
        $query->bindValue(':userID', $userID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->myComments = $data;
    }


    

    //FUNCTION IN DATABASE

    //login to the website
    public static function login()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT password_hash, email, status, userID, banned, first_name FROM Users WHERE email = :email');
        $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        return $data;
    }

    //Check if email already exists
    public static function checkEmail($email)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT COUNT(*) AS nbr FROM Users WHERE email=:email');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $email_free = ($query->fetchColumn() == 0) ? 1 : 0;
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        return $email_free;
    }

    //signin
    public function signin()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO Users (status, first_name, last_name, email, password_hash, banned)
                VALUES (:status, :firstname, :lastname, :email, :password_hash, :banned)');
        $query->bindValue(':status', $this->status, PDO::PARAM_INT);
        $query->bindValue(':firstname', $this->first_name, PDO::PARAM_STR);
        $query->bindValue(':lastname', $this->last_name, PDO::PARAM_STR);
        $query->bindValue(':email', $this->email, PDO::PARAM_STR);
        $query->bindValue(':password_hash', $this->password_hash, PDO::PARAM_STR);
        $query->bindValue(':banned', $this->banned, PDO::PARAM_BOOL);
        $query->execute();
        // get the session id
        $sid = $pdo->lastInsertId();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        return $sid;
    }


    // update profile based on session ID
    public function updateUserInfo($sid){
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('UPDATE Users SET last_name=:last_name, first_name=:first_name, email=:email WHERE userID=:sid');
        $query->bindValue(':sid', $sid, PDO::PARAM_INT);
        $query->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $query->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $query->bindValue(':email', $this->email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }

    //OTHER FUNCTIONS

    public function addComment($item, $comment)
    {
        $this->myItems[$item]->addComment($comment);
    }

    public function reviseComment($item, $newComment)
    {
        $this->myItems[$item]->setChild($newComment);
    }

    public function addItem()
    {
    }

}
