<?php

class Conseilleur extends Person{
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