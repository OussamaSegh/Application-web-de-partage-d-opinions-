<?php
/*
-- Author : SEGHAIER Oussama 
*/
class Category {
    //ATTRIBUTS
    private $classID;
    private $instantiated;
	private $name;
    private $imgURL;
    private $description;
    private $date;

    private $categoryList;


    //CONSTRUCTOR
    public function __construct()
    {
        $this->date = date('Y-m-d-h-m-s');
    }

    //GETTERS
    public function getCategoryList(){
        return $this->categoryList;
    }

    public function getClassID(){
        return $this->classID;
    }

    //SETTERS
    public function setInstantiated($instantiated){
        $this->instantiated = $instantiated;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setImgURL($imgURL){
        $this->imgURL = $imgURL;
    }  
    public function setDate($date){
        $this->date = $date;
    }
    public function setClassID($classID){
        $this->classID = $classID;
    }
    //FUNCTIONS
    /*
    *search in the database all the categories
    */
    public function listCategories()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT instantiated, name, imgURL, classID, Description FROM Categories');
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->categoryList = $data;
    }

    /*
    *add a category to the catagory Database
    */
    public function createCategory()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO Categories (instantiated, Name, Description, imgURL, date_memory)
                VALUES (:instantiated,:Name, :Description, :imgURL, :date)');
        $query->bindValue(':instantiated', $this->instantiated, PDO::PARAM_STR);
        $query->bindValue(':Name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':Description', $this->description, PDO::PARAM_STR);
        $query->bindValue(':imgURL', $this->imgURL, PDO::PARAM_STR);
        $query->bindValue(':date', $this->date, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }

    /*
    *put the "instantiate" column to 1 when an item is created in the selected category
    */
    public function instantiateCategory($classID){
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('UPDATE Categories SET instantiated=:instantiated WHERE classID=:classID');
        $query->bindValue(':classID', $classID, PDO::PARAM_STR);
        $query->bindValue(':instantiated', 1, PDO::PARAM_BOOL);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }

    /*
    *modify the category in the database if the category don't have any items
    */
    
    public function modifyCategory()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('UPDATE Categories SET Name=:Name, Description=:Description, imgURL=:imgURL WHERE classID=:classID');
        $query->bindValue(':classID', $this->classID, PDO::PARAM_STR);
        $query->bindValue(':Name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':Description', $this->description, PDO::PARAM_STR);
        $query->bindValue(':imgURL', $this->imgURL, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }

    /*
    *delete the category in the database if the category don't have any items
    */
    public function deleteCategory()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('DELETE FROM categories WHERE classID=:classID');
        $query->bindValue(':classID', $this->classID, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }
}