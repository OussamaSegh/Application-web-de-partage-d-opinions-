<?php

/*
-- Author : SEGHAIER Oussama 
*/
/**
 * This class interacts with DB.
 */

class Comment
{

    // ATTRIBUTES FOR SINGLE ITEM
    private $commentID;
    private $itemID;
    private $userID;
    private $content;
    private $grade;
    private $parentID;
    private $isBanned;
    private $date;

    // ATTRIBUTES FOR MULTIPLE COMMENTS
    private $commentList;

    // GETTERS
    public function getCommentList(){
        return $this->commentList;
    }

    public function getCommentID(){
        return $this->commentID;
    }

    public function getItemID(){
        return $this->itemID;
    }

    public function getUserID(){
        return $this->userID;
    }

    public function getContent(){
        return $this->content;
    }

    public function getGrade(){
        return $this->grade;
    }

    public function getParentID(){
        return $this->parentID;
    }

    public function getIsBanned(){
        return $this->isBanned;
    }

    public function getDate(){
        return $this->date;
    }

    //SETTERS

    public function setUserID($userID){
        $this->userID = $userID;
    }

    public function setItemID($itemID){
        $this->itemID = $itemID;
    }

    public function setGrade($grade){
        $this->grade = $grade;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function setCommentID($commentID){
        $this->commentID = $commentID;
    }

    public function setParentID($parentID){
        $this->parentID = $parentID;
    }

    //FUNCTIONS

    /**
     * Get comments from the User based on its ID.
     * Join Items table to get the name of the commented item.
     */
    public function listCommentsByUserId($userID)
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
        $this->commentList = $data;
    }

    /**
     * Get comments for the item based on itemID
     */
    public function listCommentsByItemId($itemID)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT commentID, itemID, content, grade, isBanned, date, u.email, parentID, c.userID
                                    FROM Comments as c
                                    LEFT JOIN Users as u ON u.userID = c.userID
                                    WHERE itemID = :itemID');
        $query->bindValue(':itemID', $itemID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->commentList = $data;
    }

    /**
     * Get comments for the item and user based on itemID and userID (including revisions)
     */
    public function commentsByItemIDAndUserID($itemID, $userID)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT commentID, itemID, content, grade, isBanned, date
                                    FROM Comments WHERE itemID = :itemID and userID = :userID');
        $query->bindValue(':itemID', $itemID, PDO::PARAM_INT);
        $query->bindValue(':userID', $userID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->commentList = $data;
    }

    /**
     * Add a new comment to the database (not a revision)
     */    
    public function createComment()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO Comments (commentID, itemID, userID, content, grade, parentID, isBanned, date)
                VALUES (DEFAULT, :itemID, :userID, :content, :grade, DEFAULT, DEFAULT, DEFAULT)');
        $query->bindValue(':itemID', $this->itemID, PDO::PARAM_INT);
        $query->bindValue(':userID', $this->userID, PDO::PARAM_INT);
        $query->bindValue(':content', $this->content, PDO::PARAM_STR);
        $query->bindValue(':grade', $this->grade, PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }

    /**
     * Get the author of a comment from the database
     */    
    public function getAuthor()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT userID FROM Comments WHERE commentID = :commentID');
        $query->bindValue(':commentID', $this->commentID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->userID = $data['userID'];
    }

    /**
     * Add a new revision (comment with set parentID)
     */  
        public function reviseComment()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO Comments (commentID, itemID, userID, content, grade, parentID, isBanned, date)
                VALUES (DEFAULT, :itemID, :userID, :content, DEFAULT, :parentID, DEFAULT, DEFAULT)');
        $query->bindValue(':parentID', $this->parentID, PDO::PARAM_INT);
        $query->bindValue(':itemID', $this->itemID, PDO::PARAM_INT);
        $query->bindValue(':userID', $this->userID, PDO::PARAM_INT);
        $query->bindValue(':content', $this->content, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }
}
