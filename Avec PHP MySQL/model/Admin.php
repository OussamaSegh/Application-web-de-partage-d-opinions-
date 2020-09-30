<?php
/*
-- Author : SEGHAIER Oussama 
*/

/**
 * This class interacts with DB.
 * 
 * FOR TESTING : createFakeAdmin() creates an admin in DB, go to ...../LAMP/?action=createFakeUser
 * email : admin@admin.com
 * password : pwd
 */

class Admin extends User
{

    // ATTRIBUTES
    private $userList = null;
    private $userItems = null;
    private $userComments = null;

    // CONSTRUCTOR
    public function __construct()
    {
    }

    // GETTERS
    public function getUserList()
    {
        return $this->userList;
    }

    public function getUserItems()
    {
        return $this->userItems;
    }

    public function getUserComments()
    {
        return $this->userComments;
    }

    // SETTERS
    /**
     * @param : int status
     */
    public function setStatus($status){
        $this->status = $status;
    }

    //FUNCTIONS

    /**
     * list all the users
     */
    public function listUsers()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT userID, banned, first_name, last_name, email FROM Users');
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->userList = $data;
    }

    /**
     * list all the item of a selected user
     */
    public function listUserItems($userId)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT itemID, name, imgURL, category, Description, note FROM Items WHERE userID = :userId');
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->userItems = $data;
    }

    /**
     * list all the comments of an selected user
     */
    public function listUserComments($userId)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT commentID, itemID, content, grade, isBanned, date FROM Comments WHERE userID = :userId');
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->userComments = $data;
    }


    /*
    *See all comments associated to a user
    */
    public function watchComments()
    {
    }

    /*
    *delete a user of the bdd
    */
    public function deleteUser($userEmail)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('DELETE FROM Users WHERE email=:userEmail');
        $query->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
        $query->execute();
        $query->closeCursor();
        DBConfig::closeConnection($pdo);
    }

    /*
    *ban a user
    */
    public function banUser($userEmail)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('UPDATE Users SET banned = 1 WHERE email=:userEmail');
        $query->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
        $query->execute();
        $query->closeCursor();
        DBConfig::closeConnection($pdo);
    }

    /*
    *unban a user
    */
    public function unbanUser($userEmail)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('UPDATE Users SET banned = 0 WHERE email=:userEmail');
        $query->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
        $query->execute();
        $query->closeCursor();
        DBConfig::closeConnection($pdo);
    }

    /*
    *create an admin
    *TEST ONLY
    */
    public function signinAdmin()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO Users (status, first_name, last_name, email, password_hash)
                    VALUES (:status, :first_name, :last_name, :email, :password_hash)');
        $query->bindValue(':status', $this->status, PDO::PARAM_INT);
        $query->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $query->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $query->bindValue(':email', $this->email, PDO::PARAM_STR);
        $query->bindValue(':password_hash', $this->password_hash, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }
    

}
