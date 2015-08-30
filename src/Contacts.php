<?php

/////Declaring the Contact class/////////
class Contact
    {
        private $name;
        private $phone_number;
        private $address;


        ////////constructor for Contact class///////////
        function __construct($name, $phone_number, $address)
        {
            $this->name = $name;
            $this->phone_number = $phone_number;
            $this->address = $address;
        }


        ///////Getters and Setters for Contact properties///////
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setPhoneNumber($new_phone_number)
        {
            $this->phone_number = (float) $new_phone_number;
        }

        function getPhoneNumber()
        {
            return $this->phone_number;
        }

        function setAddress($new_address)
        {
            $this->address = (string) $new_address;
        }

        function getAddress()
        {
            return $this->address;
        }


        //////////Save function for user input contacts
        function save()
        {
            array_push($_SESSION['list_of_contacts'], $this);
        }
        //////////returns all Contacts in the global session variable
        static function getAll()
        {
            return $_SESSION['list_of_contacts'];
        }


        //////////clears session by replacing it with a blank array, essenctially deleting all contacts.
        static function deleteAll()
        {
            $_SESSION['list_of_contacts'] = array();
        }
    }
?>
