<?php

/*
-- Author : SEGHAIER Oussama 
*/

require_once($_SERVER["DOCUMENT_ROOT"] . "config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "model/Contactus.php");
class ContactusController{

    //ATTRIBUTS
    private $contactus;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->contactus = new Contactus();
    }

    public function createContactusForm()
    {
        require_once($_SERVER["DOCUMENT_ROOT"] . "view/ContactusForm.php");
    }


    /**
     *Function to contact us
     */
    public function contactusSendMessage(){
        // check that the user is admin
        if (
            //Check the fields are not empty
            (!empty($_POST['first_name'])) && 
            (!empty($_POST['last_name'])) &&
            (!empty($_POST['email_contact'])) && 
            (!empty($_POST['comment']))
            ) {
            $first_name = (string) strip_tags($_POST['first_name']);
            $last_name = (string) strip_tags($_POST['last_name']);
            $email_contact = (string) strip_tags($_POST['email_contact']);
            $comment = (string) strip_tags($_POST['comment']);

            $this->contactus = new Contactus();
            
            $this->contactus->setFirstName($first_name);
            
            $this->contactus->setLastName($last_name);
            echo "helloe";
            $this->contactus->setMail($email_contact);
            $this->contactus->setMessage($comment);
            
            $this->contactus-> createContactUs();
            
            changeLocation("view/ContactUsSentSuccessView.php");
        } else {
            changeLocation("view/failureView.php");
        }
    }



}