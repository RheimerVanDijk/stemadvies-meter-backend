<?php

class db
{
    public function connect()
    {
        $dns = 'mysql:host=127.0.0.1;dbname=stemwijzer';
        $user = 'root';
        $pass = '8269';

        return new PDO($dns, $user, $pass);
    }
}
