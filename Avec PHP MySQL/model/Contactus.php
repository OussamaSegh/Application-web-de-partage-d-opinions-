<?php
/*
-- Author : SEGHAIER Oussama 
*/
class Contactus {

    //ATTRIBUTS
	private $first_name;
    private $last_name;
	private $email_contact;
    private $comment;
    private $commentsList;

    
    //CONSTRUCTOR
    public function __construct()
    {
    }

    //GETTERS
    public function getCommentsList(){
        return $this->commentsList;
    }

    public function setFirstName($name){
        $this->first_name = $name;
    }

    //SETTERS
    public function setLastName($name){
        $this->last_name = $name;
    }

    public function setMail($mail){
        $this->email_contact = $mail;
    }

    public function setMessage($message){
        $this->comment = $message;
    }

    //FUNCTIONS

    //return all the comments
    public function commentsList()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('SELECT * FROM contactus');
        $query->execute();
        $data = $query->fetchAll();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
        $this->categoryList = $data;
    }

    //add a contact us form to the contactus Database
    public function createContactUs()
    {
        $pdo = DBConfig::openConnection();
        $query = $pdo->prepare('INSERT INTO contactus (firstname,lastname,email,comments)
                VALUES (:first_name,:last_name, :mail, :comment)');
        $query->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $query->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $query->bindValue(':mail', $this->email_contact, PDO::PARAM_STR);
        $query->bindValue(':comment', $this->comment, PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
        DBConfig::closeConnection($pdo);
    }
}