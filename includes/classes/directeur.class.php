<?php

class Directeur extends Person{
    public $password;

    function setPassword($password)
    {
        $this->password = $password;
    }

    function getPassword()
    {
        return $this->password;
    }
}

?>