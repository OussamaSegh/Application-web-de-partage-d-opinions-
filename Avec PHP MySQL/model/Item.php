<?php
/*
-- Author : SEGHAIER Oussama 
*/

/**
 * This class interacts with DB.
 */

class Item
{
    // ATTRIBUTES FOR SINGLE ITEM
    private $itemID;
    private $classID;
    private $name;
    private $imgURL;
    private $category;
    private $Description;
    private $userID;
    private $note;

    // ATTRIBUTES FOR MULTIPLE ITEMS
    private $itemList;

    // GETTERS
    public function getitemID(){
        return $this->itemID;
    }
    public function getClassID(){
        return $this->classID;
    }

    public function getName(){
        return $this->name;
    }

    public function getimgURL(){
        return $this->imgURL;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getDescription(){
        return $this->Description;
    }

    public function getUserID(){
        return $this->userID;
    }

    public function getNote(){
        return $this->note;
    }

    public function getItemList(){
        return $this->itemList;
    }

    // SETTERS
    public function setItemID($itemID){
        $this->itemID = $itemID;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function setImgURL($imgURL){
        $this->imgURL = $imgURL;
    }

    public function setDescription($Description){
        $this->Description = $Description;
    }

    public function setCategory($categoryID){
        $this->classID = $categoryID;
    }

    public function setUserID($userID){
        $this->userID = $userID;
    }

    // FUNCTIONS
    /**
     * Filter based on category ID.
     * Used after clicking on a category on the main page.
     */
    public function listItemsByCategory($categoryID)
    {

        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT itemID, classID, name, imgURL, category, Description, userID, note 
                                        FROM Items 
                                        WHERE classID = :categoryID');
        $query->bindValue(':categoryID', $categoryID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->itemList = $data;
    }

    /**
     * Get items from the User based on user ID.
     */
    public function listItemsByUser($userID)
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
        $this->itemList = $data;
    }

    /**
     * Make a search in the database
     */
    public function searchItem($title,$categoryID){
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT itemID, name, imgURL, classID, Description FROM Items WHERE (name LIKE "%'.$title.'%" AND classID = :categoryID) ORDER BY name DESC');
        $query->bindValue(':categoryID', $categoryID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->itemList = $data;
    }

    /**
     * Get one item info based on its ID.
     */
    public function getItemInfo($itemID)
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT classID, name, imgURL, category, Description, userID, note
                                    FROM Items 
                                    WHERE itemID = :itemID');
        $query->bindValue(':itemID', $itemID, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        // update attributes
        $this->classID = $data['classID'];
        $this->name = $data['name'];
        $this->imgURL = $data['imgURL'];
        $this->category = $data['category'];
        $this->Description = $data['Description'];
        $this->userID = $data['userID'];
        $this->note = $data['note'];
    }


    
    /**
     * Modifies item in DB based on its ID.
     * The new values should be set as attributes.
     */
    public function modifyItem($itemID){
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('UPDATE Items 
                                SET name=:name, imgURL=:imgURL, Description=:Description 
                                WHERE itemID=:itemID');
        $query->bindValue(':itemID', $itemID, PDO::PARAM_INT);
        $query->bindValue(':name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':imgURL', $this->imgURL, PDO::PARAM_STR);
        $query->bindValue(':Description', $this->Description, PDO::PARAM_STR);
        $query->execute();
        $result = $query->rowCount();
        return $result;
    }

    /**
     * Deletes item in DB based on its ID.
     */
    public function deleteItem($itemID){
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('DELETE FROM Items WHERE itemID=:itemID');
        $query->bindValue(':itemID', $itemID, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
        DBConfig::closeConnection($pdo);
    }
    /*
    *Create item in the database
    */
    public function createItem()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO Items (classID, name, imgURL, Description, userID, note)
                VALUES (:classID, :name, :imgURL, :Description, :userID, :note)');
        $query->bindValue(':classID', $this->classID, PDO::PARAM_STR);
        $query->bindValue(':name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':imgURL', $this->imgURL, PDO::PARAM_STR);
        $query->bindValue(':Description', $this->Description, PDO::PARAM_STR);
        $query->bindValue(':userID', $this->userID, PDO::PARAM_STR);
        $query->bindValue(':note', $this->note, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }
}
