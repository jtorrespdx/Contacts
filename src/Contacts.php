<?php
class Contacts
{
    private $name;
    private $phone_number;
    private $address;

    function __construct($name, $phone_number, $address)
    {
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->address = $address;
    }

    function setName($new_Name)
    {
        $this->name = (string) $new_Name;
    }

    function getName()
    {
        return $this->name;
    }

    function setPhone_number($new_Phone_number)
    {
        $this->phone_number = (float) $new_Phone_number;
    }

    function getPhone_number()
    {
        return $this->phone_number;
    }

    function setAddress($new_Address)
    {
        $this->address = (string) $new_Adress;
    }

    function getAdress()
    {
        return $this->address;
    }

    function save()
    {
        array_push($_SESSION['list_of_contacts']), $this;
    }

    static function getAll()
    {
        return $_SESSION['list_of_contacts'];
    }

    static function deleteAll()
    {
        $_SESSION['list_of_contaacts'] = array();
    }
}
?>
