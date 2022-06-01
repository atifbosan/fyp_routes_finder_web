<?php

class DbConnect
{

    private $con;

    public function connect()
    {
        include_once dirname(__FILE__) . './Config.php';
        $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            echo "failed to connect database" . mysqli_connect_errno();
        }

        return $this->con;
    }
}
