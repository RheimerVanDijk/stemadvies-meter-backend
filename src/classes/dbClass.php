<?php

class db
{
    public function connect()
    {
        $dns = 'mysql:host=127.0.0.1:8889;dbname=stemwijzer';
        $user = 'root';
        $pass = 'root';

        return new PDO($dns, $user, $pass);
    }
}
